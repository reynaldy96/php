<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sentinel;
use Activation;
use App\Model\User;
use App\Mail\Register;
use Mail;

use Brian2694\Toastr\Facades\Toastr;
class RegistrationController extends Controller
{
    public function register()
    {
        if ($user = Sentinel::check())
        {
            return redirect('/');
        }
        else
        {
            return view('auth.register');
        }
    }

    public function postRegister(Request $request)
    {  
    	$user = Sentinel::register($request->all());
		$activation = Activation::create($user);
        $role = Sentinel::findRoleBySlug('member');
		$role->users()->attach($user);
    
        Mail::send(new Register($user, $activation->code));
        $notification = Toastr::success('Register Berhasil','Success');
        return Redirect('/')->with($notification);
    }

    private function sendEmail($user, $code)
    {
        Mail::send('auth.verify', [
            'user'=> $user,
            'code' => $code
        ], function ($message) use ($user){
            $message->to($user->email);
            $message->subject("Hello $user->first_name, activate your account.");
        });
    }
}