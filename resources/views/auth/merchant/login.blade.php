@extends('auth.auth-master')
@section('content')
@include('elements.alert')
<div class="row">
    <div class="col-md-5 p-0 card-left"></div>
    <div class="col-md-7 p-0 card-right">
        <div class="card tab2-card">
            <div class="card-body">
                    <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="top-profile-tab" data-toggle="tab" href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="true"><span class="icon-user mr-2"></span>Login</a>
                        </li>
                    </ul>
                    @if(session('flash_notification'))
                        <div class="flash-message">
                            @include('flash::message')
                        </div>
                    @endif

                    <form class="form-horizontal" method="post"  action="{{ action('AuthController@userAuth') }}" id="validateForm">
                        @csrf
                        <div class="form-group">
                            <input required="" name="login[email]" type="email"  value="seller@andit.com" class="form-control @error('email') border-danger @enderror" placeholder="Email" id="exampleInputEmail1">
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        </div>
                        <div class="form-group">
                            <input required="" name="login[password]" type="password" class="form-control @error('password') border-danger @enderror" placeholder="Password">
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        </div>
                        <div class="form-terms">
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" class="custom-control-input" name="remember_me" id="customControlAutosizing">
                                <label class="custom-control-label" for="customControlAutosizing">Remember me</label>
                                <a href="{{url('merchant/forgot_password')}}" class="btn btn-default forgot-pass">Lost your password</a>
                            </div>
                        </div>
                        <button class="btn btn-info mt-4" type="submit">Login</button>
                    </form> 
                </div>
            </div>
        </div>
    </div>
<a href="{{url('/')}}" class="btn btn-secondary back-btn"><i data-feather="arrow-left"></i>Back To Home</a>
@endsection