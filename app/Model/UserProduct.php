<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserProduct extends Model
{
    protected $guarded = [];

    protected $table = 'user_product';

    public function User()
    {
        return $this->belongsTo('App\Model\User');
    }
}
