<?php

namespace App\Model;
use Sentinel;
use Illuminate\Database\Eloquent\Model;

class NotificationQaMessage extends Model
{
    protected $guarded = [];

    protected $table = 'member_notification_message';

    public function topic()
    {
        return $this->belongsTo(QaTopic::class);
    }

    public function sender()
    {
        return $this->hasOne(User::class, 'id', 'sender_id')->withTrashed();
    }
}
