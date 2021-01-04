@extends('admin.layout.master')

@section('content')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>List Coupons
                            <small>Multikart Admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Coupons</li>
                        <li class="breadcrumb-item active">List Coupons</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Coupon codes</h5>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ action('Admin\CouponCodeController@create') }}" class="btn btn-secondary pull-right">+ Add New Coupon</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body table-responsive">
                        @include('flash::message')
                        <table class="table table-borderd" id="showInDataTable">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Code</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Discount Type</th>
                                    <th class="text-center">Discount Amount</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($coupon_codes as $index=>$coupon_code)
                                    <tr>
                                        <td>{{ $coupon_code->title }}</td>
                                        <td>{{ $coupon_code->code }}</td>
                                        <td>{{ $coupon_code->valid_from }}</td>
                                        <td>{{ $coupon_code->valid_to }}</td>
                                        <td>{{ ($coupon_code->discount_type === 0) ? 'Fixed' : 'Percent' }}</td>
                                        <td class="text-center">{{ $coupon_code->discount_amount }}</td>
                                        <td>{{ ($coupon_code->status === 1) ? 'Active' : 'Inactive'  }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-success btn-xs" href="{{ action('Admin\CouponCodeController@edit',$coupon_code->id) }}"><i class="fa fa-edit"></i></a>
                                            <form action="{{ action('Admin\CouponCodeController@destroy',$coupon_code->id) }}" method="post" id="deleteButton{{$coupon_code->id}}" style="display: inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-primary btn-xs" name="remove_slider_group" type="submit" onclick="makeDeleteRequest(event, '{{ $coupon_code->id  }}')"><i class="fa fa-trash-o"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('div.alert').delay(3000).fadeOut(350);
        });
    </script>
@endpush
