@extends('layouts.loginscreen')

@section('content')
<div class="wrapper login-area">
    	<div class="container">
            <div class="login-form">
                <div class="logo-div">
                    <img class="img-responsive" alt="logo" src="{{ URL::asset('public/assets/images/logo-white.png') }}" />
                </div>
                
                <form class="form-signin" role="form" method="POST" action="{{ url('/password/reset') }}">
                    {!! csrf_field() !!}
                    <input type="hidden" name="token" value="{{ $token }}">
                    <h2>Reset Password</h2>
                    <input type="email" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="Email Address">
                    
                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                    
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                    @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                    
                    <button class="signin-btn" type="submit">Update Password</button>
                    
                </form>                
            </div>
        </div>
    </div>
@endsection
