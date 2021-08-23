<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sentinel;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;

use Brian2694\Toastr\Facades\Toastr;
class LoginController extends Controller
{
    public function login() {
        if ($user = Sentinel::check())
        {
            return redirect('/');
        }
        else
        {
            return view('auth.login');
        }
    }
    
    public function postLogin(Request $request) {
    try{
        $rememberMe = false;
    if(isset($request->remember_me))
        $rememberMe = true;
    if(Sentinel::authenticate($request->all(), $rememberMe)){
        $slug = Sentinel::getUser()->roles()->first()->slug;
                if ($slug == 'master'){
                    $notification = Toastr::success('Login Berhasil, Anda Berhasil Masuk sebagai Admin','Success');
                    return Redirect()->route('dashboard_admin')->with($notification);
                }elseif ($slug == 'member'){
                    $notification = Toastr::success('Login Berhasil','Success');
                    return Redirect()->route('jual')->with($notification); 
                }elseif ($slug == 'toko'){
                    $notification = Toastr::success('Login Berhasil','Success');
                    return Redirect()->route('toko')->with($notification); 
                }else{
                    $notification = Toastr::error('Login Gagal, Email atau Password yang anda masukan salah','Error');
                    return Redirect()->route('login')->with($notification); 
                }
            }
        }catch(ThrottlingException $e){
                $delay = $e->getDelay();
                $notification = Toastr::error('Anda di baned selama $delas detik. harap coba lagi nanti !!!','Error');
                    return Redirect()->route('login')->with($notification); 
        }catch (NotActivatedException $e){
                $notification = Toastr::error('Akun anda tidak aktif','Error');
                return Redirect()->route('login')->with($notification); 
        }
    }
    
    public function logout() 
    {
        Sentinel::logout();
        return redirect('login');
    }

    public function postlogout() 
    {
        Sentinel::logout();
        return redirect('login');
    }
}
