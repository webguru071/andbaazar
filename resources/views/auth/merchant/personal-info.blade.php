@extends('auth.auth-master')
@section('content')
@include('elements.alert') 
@push('css')
<style>
    .padding{
        padding: 12px!important;
    }
</style>
@endpush
<div class="row">
<div class="col-md-5 p-0 card-left">
</div>
    {{-- <div class="col-md-5 p-0 card-left">
        <div class="card bg-primary padding">
            {{-- <div class="svg-icon"> --}}
                {{-- <a href="{{url('/')}}"><img src="{{asset('frontend')}}/assets/images/icon/logo.png" class="img-fluid blur-up lazyload" alt="image"></a> --}}
            {{-- </div> 
            <div class="single-item">
                <div>
                    <div>
                        <h3>Welcome to Andbaazar</h3>
                        <p> Became a seller on Andbaazar all you need is to register."                         ,
                              List your catalog and start selling your products.</p>
                    </div>
                </div>
                <div>
                    <div>
                        <h3>Welcome to Andbaazar</h3>
                        <p>This a largest  multivendor ecommerce site.You can bye or sell anything. 
                            It allows you to create an online marketplace.
                           Independent vendors can sell their products through a single storefront. 
                           An online vendor is the one who sells in on the internet marketplace.</p>
                    </div>
                </div>
                <div>
                    <div>
                        <h3>Welcome to Andbaazar</h3>
                        <p>You can connect to your friend and chat with them by using our site.
                            online store with all the tools you need to build, manage, and grow your business. 
                            Ecwid store in minutes with shipping, tax, payment, advertising options ready.
                             Payment Gateway Support. Free Social Network App. 
                             Seamless Upgrades. Always Free Plan. Lightning Fast.
                            Connect your products to people where they shop</p>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- <div class="col-md-7 p-0 card-right"> --}}
        {{-- <div class="text-right">
            {{-- <span class=""> {{  $seller->verification_token }}</span>
        </div> --}}
        <div class="col-md-7 p-0 card-right">
        <div class="card tab2-card">
            <div class="card-body">
                <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="contact-top-tab" data-toggle="tab" href="#top-contact" role="tab" aria-controls="top-contact" aria-selected="false"><span class="icon-unlock mr-2"></span>Login Information</a> 
                    </li>
                </ul>
                    
                    @if (\Session::has('error'))
                        <div class="alert alert-danger">
                                <p class="text-muted font-weight-bold">{!! \Session::get('error') !!}</p>
                        </div>
                    @endif

                      
                    <form class="form-horizontal auth-form" action="{{ route('savePersonalInfo') }}" method="post" enctype="multipart/form-data" id="validateForm">
                        @csrf 
                            <div class="form-group">
                                <input required="" name="verification_token"  type="hidden" value="{{ $seller->verification_token }}"  class="form-control" placeholder="varification Code" id="exampleInputEmail12">
                                <input type="hidden" name="type" value="sellers">
                                <input type="hidden" name="first_name" value="{{ $seller->first_name }}">
                                <input type="hidden" name="last_name" value="{{ $seller->last_name }}">
                                <input type="hidden" name="token" value="{{ $seller->remember_token }}">
                            </div>
                            <div class="form-group">
                                <input required="" name="email" autocomplete="off" value="{{ old('email') }}" type="email" class="form-control @error('email') border-danger @enderror" placeholder="Email" id="exampleInputEmail12" autocomplete="off">
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                <input type="hidden" name="type" value="sellers">
                            </div>
                            <div class="form-group">
                                <select name="gender" placeholder="Gender" class="form-control px-10 @error('gender') border-danger @enderror" id=""  required autocomplete="off" style="height: 51px;">                                         
                                    <option value="Male" selected>Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div> 
                            <div class="form-group">
                                <input required="" name="password" type="password" class="form-control @error('password') border-danger @enderror" placeholder="Password" autocomplete="off">
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            </div>
                            <div class="form-group">
                                <input required="" name="password_confirmation" type="password" class="form-control @error('password_confirmation') border-danger @enderror" placeholder="Confirm Password" autocomplete="off">
                                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            </div>
                            <div class="form-terms">
                                <div class="custom-control custom-checkbox mr-sm-2"> 
                                    <input type="checkbox" name="agreed" class="custom-control-input" id="customControlAutosizing1"> 
                                    <label class="custom-control-label" for="customControlAutosizing1"><span>I agree all statements in <a href="{{ url('merchant/terms-condition') }}" target="_blank"  class="pull-right">Terms &amp; Conditions</a></span></label>
                                    <br>
                                    <span class="text-danger">{{ $errors->first('agreed') }}</span>
                                </div>
                            </div>
                            <div class="form-button mt-4 float-right">
                                <button class="btn btn-success" type="submit">Register</button>
                            </div> 
                        </form>
                   </div>
               </div>
          </div>
      </div> 
@endsection

<script></script>