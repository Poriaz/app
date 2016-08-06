@extends('layouts.loginscreen')

@section('content')
<div class="wrapper sign-up-area">
    	<div class="container-fluid">
            <div class="row">
            	<div class="col-md-6">
                	<div class="login-form">
                        <div class="logo-div">
                            <img class="img-responsive" alt="logo" src="{{ URL::asset('public/assets/images/logo-white.png') }}" />
                        </div>
                        <form class="form-signin" role="form" method="POST" action="{{ url('/register') }}">
                             {!! csrf_field() !!}
                            <h3>Sign Up now.<br />Its<span> FREE!</span></h3>
                            <label class="sr-only" for="Name">Name</label>
                            <input id="Name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name">
                            @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            <label class="sr-only" for="inputEmail">Email</label>
                             <input id="inputEmail" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                             @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            <label class="sr-only" for="inputPassword">Password</label>
                            <input id="inputPassword" type="password" class="form-control" name="password" placeholder="Password">
                            @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            <label class="sr-only" for="inputPasswordc">Confirm Password</label>
                             <input id="inputPasswordc" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                             @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            <div class="checkbox">
                            <label>
                            <input type="checkbox" value="1">
                            I accept Bizhub’s's Privacy Policy and Terms and Conditions. 
                            </label>
                            </div>
                             <button class="signin-btn" type="submit">Sign Up Now!</button>                            
                        </form>                
                	</div>
                </div>
                <div class="col-md-6 image-area">
                	<h1>FIND YOUR PERFECT BUSSINESS ASSOCIATES ACROSS THE WORLD HERE</h1>
                </div>
            </div>
        </div>
    </div>
@endsection
