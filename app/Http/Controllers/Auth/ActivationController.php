<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sentinel;
use Activation;
use App\Model\User;

class ActivationController extends Controller
{
    public function activate($email, $activationCode)
    {
        $user = User::whereEmail($email)->first();

        $sentinelUser = Sentinel::findById($user->id);

        if(Activation::complete($sentinelUser, $activationCode))
        {
            return redirect('/login');
        }else{

        }
    }
}
