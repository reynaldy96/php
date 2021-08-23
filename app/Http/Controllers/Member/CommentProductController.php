<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests\NotificationCreateRequest;
use App\Http\Requests\NotificationReplyRequest;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Model\NotificationQaTopic;
use Sentinel;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Carbon\Carbon;
class CommentProductController extends Controller
{
    public function store(Request $request)
    {
        $topic = NotificationQaTopic::create([
            'subject' => $request->input('subject'),
            'product_id' => $request->input('product_id'),
            'creator_id' => Sentinel::getUser()->id,
            'receiver_id' => $request->input('recipient'),
        ]);

        $topic->messages()->create([
            'sender_id' => Sentinel::getUser()->id,
            'product_id' => $request->input('product_id'),
            'star_raiting' => $request->input('star_raiting'),
            'first_name' => $request->input('first_name'),
            'content' => $request->input('content'),
        ]);

        $notification = Toastr::success('Anda Berhasil Menambahkan Komentar','Success');

        return Redirect()->back()->with($notification);
    }

    public function showMessages(NotificationQaTopic $topic)
    {
        $this->checkAccessRights($topic);

        foreach ($topic->messages as $message) {
            if ($message->sender_id !== Sentinel::getUser()->id && $message->read_at === null) {
                $message->read_at = Carbon::now();
                $message->save();
            }
        }

        $unreads = $this->unreadTopics();

        return view('Pages.Member.Notification.Show', compact('topic', 'unreads'));
    }

    public function showInbox()
    {
        $topics = NotificationQaTopic::where('receiver_id', Sentinel::getUser()->id)
            ->orderBy('created_at', 'DESC')
            ->get();

        $unreads = $this->unreadTopics();

        return view('Pages.Member.Notification.Index', compact('topics', 'unreads'));
    }

    public function replyToTopic(NotificationReplyRequest $request, NotificationQaTopic $topic)
    {
        $this->checkAccessRights($topic);

        $topic->messages()->create([
            'sender_id' => Sentinel::getUser()->id,
            'content'   => $request->input('content'),
        ]);

        $notification = Toastr::success('Anda Berhasil Membalas Komentar','Success');

        return Redirect()->back()->with($notification);
    }

    public function showReply(NotificationQaTopic $topic)
    {
        $this->checkAccessRights($topic);

        $receiverOrCreator = $topic->receiverOrCreator();

        if ($receiverOrCreator === null || $receiverOrCreator->trashed()) {
            abort(404);
        }

        $unreads = $this->unreadTopics();

        return view('Pages.Member.Notification.Reply', compact('topic', 'unreads'));
    }

    public function unreadTopics(): array
    {
        $topics = NotificationQaTopic::where(function ($query) {
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

    private function checkAccessRights(NotificationQaTopic $topic)
    {
        $user = Sentinel::getUser();

        if ($topic->creator_id !== $user->id && $topic->receiver_id !== $user->id) {
            return abort(401);
        }
    }
}
