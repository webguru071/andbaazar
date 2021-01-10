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
                        <li class="breadcrumb-item active">Rejected customers</li>
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
                        <h5> Rejected Customers List</h5>
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
                                <th>Rejected At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rejected_customers as $index=>$customer)
                                <tr>
                                    <td><img class="img-fluid" src="{{ (!is_null($customer->customerDetails['picture'])) ? $merchant->customerDetails['picture'] : 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxEPDhANDQ8PEA4NEA8ODw0PDQ8QEA8QFREWFhURExUYHSggGBolGxMTITEhJSkrLi4uFx8zODMtNygtLisBCgoKDQ0NDw0NDisZHxkrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrK//AABEIAOEA4QMBIgACEQEDEQH/xAAaAAEAAwEBAQAAAAAAAAAAAAAAAgQFAQMH/8QAMhABAQABAgIHBwMEAwAAAAAAAAECAxEEIQUxQVFhgbESIjJxcpHBQlKhktHw8TNigv/EABUBAQEAAAAAAAAAAAAAAAAAAAAB/8QAFBEBAAAAAAAAAAAAAAAAAAAAAP/aAAwDAQACEQMRAD8A+qAKgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADy1eIxx67z7pzoPUZ2pxuV+HafzXjdbK/qy+9gNcZE1cv3Zf1VLHic5+r77UGqKOHHX9Unzl2XZZec5zvgOgAAAAAAAAAAAAAAAAAAAOW7Te8pO11Q6Q1Ocw7JzvzBHieKuXLHlj39tVgUAAAAE9LVuN3xvl2VABraGtM5vPOdz0ZnBZ7ZydmXKtNAAAAAAAAAAAAAAAAAAAY+rn7WVy72pr3bDL6b6MkABQAAAAAB3DLay91lbLFbMQdAAAAAAAAAAAAAAAAAB5cR8GX01lNfVm+OU75fRkAAKAAAAAUAa2jfcx+nH0ZLX0Z7uP0z0QTAAAAAAAAAAAAAAAAABW47UuOM2u292t8mY0ukJ7k+qelZ2wA65soOO7ADiQCIkAju0uB1blLLd9qztmh0dj7tvfl+IgtgAAAAAAAAAAAAAAAAA8eKx3wy+W/25sts2bza9V5M3iuH9jba7y7+QPABQAAAAAAanCY7YY+M3+6lwvD+3vbdpNvNpSbTadU5IOgAAAAAAAAAAAAAAAAAK3HY74b/tsv4WXMpvNr1XkDGE9bSuF2vle+IKAAAAAJ6On7WUxnne6Av8FhthP+3NYck25TsdQAAAAAAAAAAAAAAAAAAAAU+kZyxvjYorvSN5Yz51SAAUAAFvo7ry+U9VRa6PvvWd8/KDQAAAAAAAAAAAAAAAAAABzKyc7dp30HVPX43blhPO/iGtxsnLDn43qUbd+feCWedyu+V3qIKAAAADuOVl3l2vfHAFzR429Wc38Z1/ZdlYy5ocb2Zz/1PzEF4Rwzlm8u88EgAAAAAAAAAABDU1JjN8r/AHqlqcbb8M2nfedBoPLU18cevKfKc6zc9XK9eVvnyQBc1OO/bPO/2Vc9S5c8raiAAKAAAAAAAAAAO45WXeWy+C1p8dZ8U38ZyqoINTT4nHLt2vdeT2YqWGpZ1Wz5UGwM7T43KfFtlPtV3R1pn1ec7YD0AAAAQ1c5jjcr2fymo9I5fDj5/wCfyCrqalyu9/14IgoAAAAAAAAAAAAAAAAAAAAO45WXecrHAGrw+r7eO/b1WeL1Z3AZbZ7funp/laKAAAz+kPjn0z1oAqgKAAAAAAAAAAAAAAAAAAAAAAPbgv8Akx8/StQEAAH/2Q==' }}" style="height: 50px"></td>
                                    <td>{{ $customer->first_name . " " .$customer->last_name}}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->customerDetails['gender'] }}</td>
                                    <td>{{ $customer->updated_at->format('Y-m-d') }}</td>
                                    <td>
                                        <form action="{{ action('Admin\CustomerController@approve_customer',$customer->id) }}" id="approveButton{{ $customer->id }}" method="post" style="display: inline">
                                            @csrf
                                            <button class="btn btn-success btn-xs" name="remove_slider_group" type="submit" onclick="makeApproveRequest(event, '{{ $customer->id  }}')">Accept</button>
                                        </form>
                                        <form action="{{ action('Admin\CustomerController@destroy',$customer->id) }}" id="deleteButton{{ $customer->id }}" method="post" style="display: inline">
                                            @csrf
                                            <button class="btn btn-primary btn-xs" name="remove_slider_group" type="submit" onclick="makeDeleteRequest(event, '{{ $customer->id  }}')">Delete</button>
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
    {{--  Page Content Start --}}
@endsection

@push('js')
    <script>
        $('div.alert').delay(3000).fadeOut(350);
    </script>
@endpush
