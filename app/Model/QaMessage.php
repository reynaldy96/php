<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class QaMessage extends Model
{
    protected $guarded = [];

    protected $table = 'qa_messages';

    public function topic()
    {
        return $this->belongsTo(QaTopic::class);
    }

    public function sender()
    {
        return $this->hasOne(User::class, 'id', 'sender_id')->withTrashed();
    }
    
}
