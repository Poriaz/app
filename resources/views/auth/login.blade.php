@extends('layouts.loginscreen')

@section('content')
	<div class="wrapper login-area">
    	<div class="container">
            <div class="login-form">
                <div class="logo-div">
                    <img class="img-responsive" alt="logo" src="{{ URL::asset('public/assets/images/logo-white.png') }}" />
                </div>
                 <form class="form-signin" role="form" method="POST" action="{{ url('/login') }}">
                        {!! csrf_field() !!}
                    <h2>Log In</h2>
                    
                    <input id="inputEmail" type="email" class="form-control" name="email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                     @endif
                    <label class="sr-only" for="inputPassword">Password</label>
                    <input id="inputPassword" type="password" class="form-control" name="password">
                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                     <div class="checkbox">
                    <label>
                    <input type="checkbox" name="remember">
                    Remember me
                    </label>
                    </div>
                    <a class="forgoten-text" href="{{ url('/password/reset') }}">Forgotten your password?</a>
                    <button class="signin-btn" type="submit">Sign In</button>
                    <p>OR</p>
                	<a class="signin-btn" href="{{ url('/register') }}">Sign Up Now!</a>
                </form>                
            </div>
        </div>
    </div>

@endsection
