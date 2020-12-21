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

                <form class="form-horizontal" method="post" action="{{ action('AuthController@userAuth') }}">
                    @csrf
                    <div class="form-group">
                        <label for="userName">Email or Phone No :</label>
                        <input required name="userName" type="text" class="form-control" placeholder="xxxxx@xxx.xxx / xxxxxxxxxx" id="userName" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="password">Password :</label>
                        <input required name="password" type="password" class="form-control" placeholder="Password" id="password" autocomplete="off">
                    </div>
                    <div class="form-terms">
                        <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" class="custom-control-input" name="remember_me" id="customControlAutosizing">
                            <label class="custom-control-label" for="customControlAutosizing">Remember me</label>
                        </div>
                    </div>
                    <div class="form-button text-right">
                        <button class="btn btn-primary" style="border-radius:5px" type="submit">Login</button>
                    </div>
                </form>
                <p class="text-left">
                    <i class="fa fa-key text-danger"></i>
                    <a href="#" class="">Lost your password</a> <br/>
                    <i class="fa fa-user-o text-danger"></i>
                    <a href="/" class="">Create an account</a>
                </p>
            </div>
        </div>
    </div>
</div> 
@endsection