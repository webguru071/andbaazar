@extends('auth.auth-master')
@section('content')
@include('elements.alert')
<div class="row">
    <div class="col-md-5 p-0 card-left">
    </div>
    <div class="col-md-7 p-0 card-right p">
        <div class="card tab2-card pt-5 pb-5">
            <div class="card-body">
                <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="contact-top-tab" data-toggle="tab" href="#top-contact" role="tab" aria-controls="top-contact" aria-selected="false"><span class="icon-unlock mr-2"></span>Please select your business area</a> 
                    </li>
                </ul>
                    
                    @if (\Session::has('error'))
                        <div class="alert alert-danger">
                                <p class="text-muted font-weight-bold">{!! \Session::get('error') !!}</p>
                        </div>
                    @endif

                      
                    <form class="form-horizontal auth-form px-3" action="{{ route('postToken') }}" method="post" enctype="multipart/form-data" id="validateForm">
                        @csrf 
                        <div class="custom-control custom-checkbox mr-sm-2"> 
                            <input type="checkbox" name="agreed" class="custom-control-input" id="ecommerce"> 
                            <label class="custom-control-label d-flex justify-content-between" for="ecommerce" title="Ecommerce is bigest platform in the world">
                                <span>E-commerce</span>
                                <small><a href="#">see more</a></small>
                            </label>
                        </div> 
                        <hr>
                        <div class="custom-control custom-checkbox mr-sm-2"> 
                            <input type="checkbox" name="agreed" class="custom-control-input" id="auction"> 
                            <label class="custom-control-label d-flex justify-content-between" for="auction">
                                <span>Auction</span>
                                <small><a href="#">see more</a></small>
                            </label>
                        </div> 
                        <hr>
                        <div class="custom-control custom-checkbox mr-sm-2"> 
                            <input type="checkbox" name="agreed" class="custom-control-input" id="sme"> 
                            <label class="custom-control-label d-flex justify-content-between" for="sme">
                                <span>SME</span>
                                 <small><a href="#">see more</a></small>
                            </label>
                        </div> 
                        <hr>
                        <div class="custom-control custom-checkbox mr-sm-2"> 
                            <input type="checkbox" name="agreed" class="custom-control-input" id="krishibazar"> 
                            <label class="custom-control-label d-flex justify-content-between" for="krishibazar">
                                <span>Krishibazar</span>
                                 <small><a href="#">see more</a></small>
                            </label>
                        </div> 
                    </form>
                </div>
        </div>
    </div>
</div> 

@endsection
