<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\QaTopicCreateRequest;
use App\Http\Requests\QaTopicReplyRequest;
use App\Model\QaTopic;
use App\Model\User;
use Sentinel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Users\UserInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;
use App\Model\Product;
use App\Model\UserProduct;
use App\Model\ProductsImages;
use App\Model\ProductsThumbnailImages;
use Storage;
use App\Model\Wilayah\Provinsi;
use App\Model\Wilayah\Kota;
use App\Model\Wilayah\Kabupaten;
use App\Model\Category\Category;
use App\Model\Category\SubCategory;
use App\Model\Category\BrandCategory;
use Response;
use App\Model\ProdukCategory\CategoryProduk;
use App\Model\ProdukCategory\SubCategoryProduk;
use App\Model\ProdukCategory\BrandCategoryProduk;

use App\Model\Kepemilikan\HandsProduk;
use App\Model\ProdukCod\CodProduk;
use App\Model\Cods;

use App\Model\WilayahProduk\ProvinsiProduk;
use App\Model\WilayahProduk\KabupatenProduk;
use App\Model\WilayahProduk\KotaProduk;

use Brian2694\Toastr\Facades\Toastr;
class MessengerController extends Controller
{
    public function index()
    {
        $topics = QaTopic::where(function ($query) {
            $query->where('creator_id', Sentinel::getUser()->id)
                ->orWhere('receiver_id', Sentinel::getUser()->id);
            })->orderBy('created_at', 'DESC')->get();

       
        $unreads = $this->unreadTopics();
        return view('Pages.Member.Pesan.index', compact('topics', 'unreads'));
    }

    public function createTopic($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $users = User::all()->except(Sentinel::getUser()->id);
        $unreads = $this->unreadTopics();

        return view('Pages.Member.Pesan.create', compact('users', 'unreads','product'));
    }

    public function storeTopic(QaTopicCreateRequest $request)
    {
        $topic = QaTopic::create([
            'subject'     => $request->input('subject'),
            'creator_id'  => Sentinel::getUser()->id,
            'receiver_id' => $request->input('recipient'),
        ]);

        $topic->messages()->create([
            'sender_id' => Sentinel::getUser()->id,
            'content'   => $request->input('content'),
        ]);

        return redirect()->route('messenger.index');
    }

    public function showMessages(QaTopic $topic)
    {
        $this->checkAccessRights($topic);

        foreach ($topic->messages as $message) {
            if ($message->sender_id !== Sentinel::getUser()->id && $message->read_at === null) {
                $message->read_at = Carbon::now();
                $message->save();
            }
        }

        $unreads = $this->unreadTopics();

        return view('Pages.Member.Pesan.show', compact('topic', 'unreads'));
    }

    public function destroyTopic(QaTopic $topic)
    {
        $this->checkAccessRights($topic);

        $topic->delete();

        return redirect()->route('messenger.index');
    }

    public function showInbox()
    {
        $topics = QaTopic::where('receiver_id', Sentinel::getUser()->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        $unreads = $this->unreadTopics();

        return view('Pages.Member.Pesan.index', compact('topics', 'unreads'));
    }

    public function showOutbox()
    {
        $topics = QaTopic::where('creator_id', Sentinel::getUser()->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        $unreads = $this->unreadTopics();

        return view('Pages.Member.Pesan.index', compact('topics', 'unreads'));
    }

    public function replyToTopic(QaTopicReplyRequest $request, QaTopic $topic)
    {
        $this->checkAccessRights($topic);

        $topic->messages()->create([
            'sender_id' => Sentinel::getUser()->id,
            'content'   => $request->input('content'),
        ]);

        return redirect()->route('messenger.index');
    }

    public function showReply(QaTopic $topic)
    {
        $this->checkAccessRights($topic);

        $receiverOrCreator = $topic->receiverOrCreator();

        if ($receiverOrCreator === null || $receiverOrCreator->trashed()) {
            abort(404);
        }

        $unreads = $this->unreadTopics();

        return view('Pages.Member.Pesan.reply', compact('topic', 'unreads'));
    }

    public function unreadTopics(): array
    {
        $topics = QaTopic::where(function ($query) {
            $query
                ->where('creator_id', Sentinel::getUser()->id)
                ->orWhere('receiver_id', Sentinel::getUser()->id);
        })
            ->with('messages')
            ->orderBy('created_at', 'DESC')
            ->get();

        $inboxUnreadCount  = 0;
        $outboxUnreadCount = 0;

        foreach ($topics as $topic) {
            foreach ($topic->messages as $message) {
                if ($message->sender_id !== Sentinel::getUser()->id
                    && $message->read_at === null
                ) {
                    if ($topic->creator_id !== Sentinel::getUser()->id) {
                        $inboxUnreadCount++;
                    } else {
                        $outboxUnreadCount++;
                    }
                }
            }
        }

        return [
            'inbox'  => $inboxUnreadCount,
            'outbox' => $outboxUnreadCount,
        ];
    }

    private function checkAccessRights(QaTopic $topic)
    {
        $user = Sentinel::getUser();

        if ($topic->creator_id !== $user->id && $topic->receiver_id !== $user->id) {
            return abort(401);
        }
    }
}
