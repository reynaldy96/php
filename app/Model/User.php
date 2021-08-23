<?php

namespace App\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Cartalyst\Sentinel\Users\EloquentUser;
use Carbon\Carbon;
use Illuminate\Support\Str;
class User extends EloquentUser 
{
    use Notifiable, SoftDeletes;

    protected $fillable = [
        'email',
        'password',
        'first_name',
        'permissions',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function byEmail($email)
    {
        return static::whereEmail($email)->first();
    }

    public function productuser($user)
    {
        $user = Sentinel::getUser();

        return $this->belongsTo('App\Model\Product');
    }

    public function getVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setVerifiedAtAttribute($value)
    {
        $this->attributes['verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function articles()
    {
        return $this->hasMany('App\Model\Product');
    }

    public function Product()
    {
        return $this->belongsTo('App\Model\Product');
    }

    public function orders()
    {
        return $this->hasMany('App\Model\Order');
    }

}

