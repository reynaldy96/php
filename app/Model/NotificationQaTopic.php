<?php

namespace App\Model;
use Sentinel;
use Illuminate\Database\Eloquent\Model;

class NotificationQaTopic extends Model
{
    protected $guarded = [];

    protected $table = 'member_notification';

    public function messages()
    {
        return $this->hasMany(NotificationQaMessage::class, 'member_notification_id')
            ->orderBy('created_at', 'desc');
    }

    public function hasUnreads()
    {
        return $this->messages()->whereNull('read_at')->where('sender_id', '!=', Sentinel::getUser()->id)->exists();
    }

    public function receiverOrCreator()
    {
        return $this->creator_id === Sentinel::getUser()->id
        ? User::withTrashed()->find($this->receiver_id)
        : Sentinel::getUser();
    }

    public static function unreadCount()
    {
        $topics = NotificationQaTopic::where(function ($query) {
            $query->where('creator_id', Sentinel::getUser()->id)
                    ->orWhere('receiver_id', Sentinel::getUser()->id);
        })->with('messages')->orderBy('created_at', 'DESC')->get();

        $unreadCount = 0;

        foreach ($topics as $topic) {
            foreach ($topic->messages as $message) {
                if ($message->sender_id !== Sentinel::getUser()->id && $message->read_at === null) {
                    $unreadCount++;
                }
            }
        }
        
        return $unreadCount;
    }
}
