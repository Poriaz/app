@extends('layouts.loginscreen')

@section('content')
	<div class="wrapper login-area">
    	<div class="container">
            <div class="login-form">
                <div class="logo-div">
                    <img class="img-responsive" alt="logo" src="{{ URL::asset('public/assets/images/logo-white.png') }}" />
                </div>
                 <form class="form-signin" role="form" method="POST" action="{{ url('/password/email') }}">
                        {!! csrf_field() !!}
                    <h2>Reset Password</h2>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <input id="inputEmail" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email Address">
                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                     @endif
                    
                    <button class="signin-btn" type="submit">Send Password Reset Link</button>
                   
                	
                </form>                
            </div>
        </div>
    </div>

@endsection
