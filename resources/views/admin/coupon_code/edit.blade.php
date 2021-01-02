@extends('admin.layout.master')

@section('content')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Edit Coupon
                            <small>{{ ucfirst(env('APP_NAME')) }} Admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="/"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item"><a href="/coupon-codes">Coupons </a></li>
                        <li class="breadcrumb-item active">Edit Coupon</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="card tab2-card">
            <div class="card-header">
                <h5>Discount Coupon Details</h5>
            </div>
            <div class="card-body">
                @include('flash::message')
                <ul class="nav nav-tabs tab-coupon" id="myTab" role="tablist">
                    <li class="nav-item"><a class="nav-link active show" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true" data-original-title="" title="">General</a></li>
                    <li class="nav-item"><a class="nav-link" id="restriction-tabs" data-toggle="tab" href="#restriction" role="tab" aria-controls="restriction" aria-selected="false" data-original-title="" title="">Restriction</a></li>
                    <li class="nav-item"><a class="nav-link" id="usage-tab" data-toggle="tab" href="#usage" role="tab" aria-controls="usage" aria-selected="false" data-original-title="" title="">Usage</a></li>
                </ul>
                <form class="needs-validation" novalidate="" action="{{ action('Admin\CouponCodeController@update',$coupon_code->id) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade active show" id="general" role="tabpanel" aria-labelledby="general-tab">
                            <div class="needs-validation">
                                <h4>General</h4>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label for="validationCustom0" class="col-xl-3 col-md-4">Coupon Title <span>*</span></label>
                                            <input name="title" class="form-control col-md-7" id="validationCustom0" type="text" required value="{{ $coupon_code->title }}">
                                        </div>
                                        <div class="form-group row">
                                            <label for="validationCustom1" class="col-xl-3 col-md-4">Coupon Code <span>*</span></label>
                                            <input name="code" class="form-control col-md-7" id="validationCustom1" type="text" required value="{{ $coupon_code->code }}" >
                                            <div class="valid-feedback">Please Provide a Valid Coupon Code.</div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-md-4">Start Date <span>*</span> </label>
                                            <input name="valid_from" class="datepicker-here form-control digits col-md-7" type="text" data-language="en" required value="{{ $coupon_code->valid_from }}">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-md-4">End Date <span>*</span> </label>
                                            <input name="valid_to" class="datepicker-here form-control digits col-md-7" type="text" data-language="en" required value="{{ $coupon_code->valid_to }}">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-md-4">Discount Type <span>*</span> </label>
                                            <select name="discount_type" class="custom-select col-md-7" required>
                                                <option value="">--Select--</option>
                                                <option value="0" {{ ($coupon_code->discount_type == 0) ? 'selected' : '' }}>Fixed</option>
                                                <option value="1" {{ ($coupon_code->discount_type == 1) ? 'selected' : '' }}>Percent</option>
                                            </select>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-md-4">Discount Amount <span>*</span> </label>
                                            <input name="discount_amount" class="form-control col-md-7" type="number" required value="{{ $coupon_code->discount_amount }}">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-md-4">Max Discount Amount</label>
                                            <input name="max_discount_amount" class="form-control col-md-7" type="number" value="{{ $coupon_code->max_discount_amount }}">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-md-4">Status</label>
                                            <div class="checkbox checkbox-primary col-md-7">
                                                <input name="status" id="checkbox-primary-2" type="checkbox" data-original-title="" title="" value="1" {{ ($coupon_code->status == 1) ? 'checked' : '' }}>
                                                <label for="checkbox-primary-2">Enable the Coupon</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="restriction" role="tabpanel" aria-labelledby="restriction-tabs">
                            <div class="needs-validation" novalidate="">
                                <h4>Restriction</h4>
                                <div class="form-group row">
                                    <label for="validationCustom4" class="col-xl-3 col-md-4">Minimum Spend</label>
                                    <input name="min_order_amount" class="form-control col-md-7" id="validationCustom4" type="number" value="{{ $coupon_code->min_order_amount }}">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="usage" role="tabpanel" aria-labelledby="usage-tab">
                            <div class="needs-validation" >
                                <h4>Usage Limits</h4>
                                <div class="form-group row">
                                    <label class="col-xl-3 col-md-4">Max Using Limit</label>
                                    <input name="max_using_limit" class="form-control col-md-7" type="number" value="{{ $coupon_code->max_using_limit }}">
                                </div>
                                <div class="form-group row">
                                    <label for="validationCustom7" class="col-xl-3 col-md-4">Per Customer</label>
                                    <input name="single_user_max_using_limit" class="form-control col-md-7" id="validationCustom7" type="number" value="{{ $coupon_code->single_user_max_using_limit }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pull-right">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
@endsection
