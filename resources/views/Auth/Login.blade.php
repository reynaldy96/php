@extends('layouts.Guest')

@section('content')

<section id="main" class="wrapper">
<div class="register-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-12 col-lg-6 col-xl-6 ml-auto mr-auto">
                <div class="login">
                    <div class="login-form-container">
                        <h5 class="card-title text-left">{{ __('Login') }}</h5>
                        <hr>
                        <div class="login-form">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                            <input type="text" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Username">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <br>
                            <input id="password" type="password" name="password" placeholder="Password" required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            <br>
                            <div class="button-box">
                                <div class="login-toggle-btn">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
        
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                                <br>
                                    <button type="submit" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();" class="default-btn btn-login floatright btn-block text-uppercase">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
