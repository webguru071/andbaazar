@extends('admin.layout.master')

@section('content')
    {{--  Page Bradecome Start --}}
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Customers
                            <small>ANDBazar Admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="/"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Active customers</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    {{--  Page Bradecome End --}}

    {{--  Page Content Start --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5> Active Customer List</h5>
                    </div>
                    <div class="card-body table-responsive">
                        @include('flash::message')
                        <table class="table table-borderd" id="showInDataTable">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Phone No</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Joined At</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($active_customers as $index=>$customer)
                                    <tr>
                                        <td><img class="img-fluid" src="{{ (!is_null($customer->customerDetails['picture'])) ? $customer->customerDetails['picture'] : asset('images/avatar-user.png') }}" style="height: 50px"></td>
                                        <td>{{ $customer->first_name . " " .$customer->last_name}}</td>
                                        <td>{{ $customer->phone }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->customerDetails['gender'] }}</td>
                                        <td>{{ $customer->created_at->format('Y-m-d') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--  Page Content Start --}}
@endsection

@push('js')
    <script>
        $('div.alert').delay(3000).fadeOut(350);
    </script>
@endpush
