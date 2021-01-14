@extends('admin.layout.master') @section('content') @push('css')
<style>
    .imagestyle {
        width: 249px;
        height: 244px;
        /* border-width: 1px;
        border-style: solid;
        border-color: #ccc;
        border-bottom: 0px;
        padding: 10px; */
    }
    .mt-10 {
        margin-top: 130px;
    }
    .modal-logo {
        margin-right: 12px;
        background: #ddd;
        padding: 10px;
    }

    @media (min-width: 768px) {
        .modal-xl {
            width: 90%;
            max-width: 1200px;
        }
    }

    .m-l-b {
        margin-left: -3px !important;
    }
</style>
@endpush @include('elements.alert') @component('admin.layout.inc.breadcrumb') @slot('pageTitle') Seller profile @endslot @slot('page')
<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
<li class="breadcrumb-item active" aria-current="page">Seller profile</li>
@endslot @endcomponent
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-active-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Approved</a>
                            <a class="nav-item nav-link" id="nav-requested-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Requested</a>
                            <a class="nav-item nav-link" id="nav-rejected-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Rejected</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-active-tab">
                            <div class="card-body order-datatable">
                                <table class="table table-borderd" id="dataTableNoPagingDesc">
                                    <thead>
                                        <tr>
                                            <th width="50">Sl</th>
                                            <th width="200">First Name</th>
                                            <th width="200">Last Name</th>
                                            <th width="200">Email</th>
                                            <th width="200">Phone</th>
                                            <th width="200">Description</th>
                                            <th width="80" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=0; @endphp @foreach($activesellers as $row)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $row->first_name }}</td>
                                            <td>{{ $row->last_name }}</td>
                                            <td>{{ $row->email }}</td>
                                            <td>{{ $row->phone }}</td>
                                            <td>{{ Baazar::short_text(strip_tags($row->description),100) }}</td>
                                            <td class="d-flex justify-content-between">
                                                <ul>
                                                    <li>
                                                        <a href="{{ url('/merchant/merchant/'.$row->id) }}" title="View" class="btn btn-sm btn-info" data-toggle="modal" data-target=".approved{{$row->id}}"><i class="fa fa-eye"></i>View</a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <div class="modal hide fade approved{{$row->id}}"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title f-w-600" id="exampleModalLabel">Seller Profile</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row p-3">
                                                            <div class="col-md-6 br-2">
                                                                <img src="{{ !empty($row->picture) ? asset($row->picture) : asset('/uploads/vendor_profile/user.png') }}" id="output" width="150" height="150" class="img" alt="" />
                                                                <div class="sort-info mt-4">
                                                                    <h3 class="display-6 pt-2">{{ $row->first_name.' '.$row->last_name}}</h3>
                                                                    <p class="">
                                                                        Email &nbsp;&nbsp;&nbsp;: {{ $row->email }} <br />
                                                                        Phone &nbsp;&nbsp;: {{ $row->phone }} <br />
                                                                        Gender &nbsp;: {{ $row->gender }}
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="float-left modal-logo">
                                                                    <img src="{{ !empty($row->shop->logo) ? asset($row->shop->logo) : asset('/images/avatar-shop.png') }}" class="" height="100" width="100" alt="Logo" />
                                                                </div>
                                                                <div>
                                                                    <h3 class="display-5 font-weight-bold">{{ $row->shop->name }}</h3>
                                                                    <p>{{ $row->shop->slogan }}</p>
                                                                </div>

                                                                <br />
                                                                <div class="d-inline-block mt-3">
                                                                    <p class="text-justify">{{ $row->shop->description }}</p>
                                                                    <h5>{{ $row->shop->name }}</h5>
                                                                    <h6>750 followers | 10 review</h6>
                                                                    <h6>{{ $row->shop->email }}</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-requested-tab">
                            <div class="card-body order-datatable">
                                <table class="table table-borderd" id="dataTableNoPagingDesc1">
                                    <thead>
                                        <tr>
                                            <th width="50">Sl</th>
                                            <th width="200">First Name</th>
                                            <th width="200">Last Name</th>
                                            <th width="200">Email</th>
                                            <th width="200">Phone</th>
                                            <th width="200">Description</th>
                                            <th width="80" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=0; @endphp @foreach($requestSellers as $row)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $row->first_name }}</td>
                                            <td>{{ $row->last_name }}</td>
                                            <td>{{ $row->email }}</td>
                                            <td>{{ $row->phone }}</td>
                                            <td>{{ Baazar::short_text(strip_tags($row->description),100) }}</td>
                                            <td class="d-flex justify-content-between">
                                                <ul>
                                                    <li>
                                                        <a href="{{ url('/merchant/merchant/'.$row->id) }}" title="Approve" class="btn btn-sm btn-info" data-toggle="modal" data-target=".requested{{$row->id}}">
                                                            <i class="fa fa-check"></i>View
                                                        </a>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <div class="modal fade requested{{$row->id}}" tabindex="-1" id="MyPopup" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title f-w-600" id="exampleModalLabel">Seller Profile</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row p-3">
                                                            <div class="col-md-6 br-2">
                                                                <img src="{{ !empty($row->picture) ? asset($row->picture) : asset('/uploads/vendor_profile/user.png') }}" id="output" width="150" height="150" class="img" alt="" />
                                                                <div class="sort-info mt-4">
                                                                    <h3 class="display-6 pt-2">{{ $row->first_name.' '.$row->last_name}}</h3>
                                                                    <p class="">
                                                                        Email &nbsp;&nbsp;&nbsp;: {{ $row->email }} <br />
                                                                        Phone &nbsp;&nbsp;: {{ $row->phone }} <br />
                                                                        Gender &nbsp;: {{ $row->gender }}
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="float-left modal-logo">
                                                                    <img src="{{ !empty($row->shop->logo) ? asset($row->shop->logo) : asset('/images/avatar-shop.png') }}" class="" height="100" width="100" alt="Logo" />
                                                                </div>
                                                                <div>
                                                                    <h3 class="display-5 font-weight-bold">{{!empty($row->shop->name) ? $row->shop->name : 'no shop'}}</h3>
                                                                    <p>{{!empty($row->shop->slogan) ? $row->shop->slogan : 'no slogan'}}</p>
                                                                </div>

                                                                <br />
                                                                <div class="d-inline-block mt-3">
                                                                    <p class="text-justify">{{ !empty($row->shop->description) ? $row->shop->description : 'no description'}}</p>
                                                                    <h5>{{!empty($row->shop->name) ? $row->shop->name : 'no shop'}}</h5>
                                                                    <h6>750 followers | 10 review</h6>
                                                                    <h6>{{!empty($row->shop->email) ? $row->shop->email : 'no email'}}</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ url('merchant/approvement/'.$row->id) }}" method="post" style="margin-top: -2px;" id="deleteButton({{ $row->id }})">
                                                            @csrf
                                                            <button type="submit" class="btn btn-info">Approve</button>
                                                        </form>
                                                        <button type="button" class="btn btn-warning ml-1 btnClosePopup" data-toggle="modal" id="" data-original-title="test" data-target="#exampleModal">Reject</button>
                                                        <form action="{{ url('merchant/profiledelete/'.$row->id) }}" method="post" style="margin-top: -2px;" id="deleteButton({{ $row->id }})">
                                                            @csrf
                                                            <button type="submit" class="btn btn-primary m-l-b">Hard Reject</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade MyPopup2" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title f-w-600 text-danger" id="exampleModalLabel">Select The Reason For Reject :</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ url('merchant/rejected/'.$row->id)}}" method="post" style="margin-top: -2px;" id="deleteButton({{ $row->id }})">
                                                            @csrf 
                                                            @method('put')
                                                            <div class="form" id="again">
                                                                <div class="form-group">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <div class="form-check">
                                                                                @foreach($rejectlist as $row)
                                                                                <label class="form-check-label" for="check1">
                                                                                    <input type="checkbox" class="form-check-input" id="checked" name="rej_name[]" value="{{$row->rej_name}}">{{$row->rej_name}}
                                                                                </label><br>
                                                                                <input type="hidden" name="type" class="form-control" value="profile">
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="text-right">
                                                                <button type="submit" class="btn btn-primary">Reject</button>
                                                            </div>
                                                        </form>
                                                        <form id="rejectId" role="form" action="" class="form-material form" method="post">
                                                           @csrf
                                                           <div class="form-group mt-2">
                                                               <label for="exampleInputPassword1 ">Others</label>
                                                               <input type="text" class="form-control" id="rej_name" name="rej_name" placeholder=" if need add another reasoan ">
                                                               <input type="hidden" name="type" class="form-control" value="profile">
                                                               <div class="form-group  float-right">
                                                                 <span id="saveReason" class="btn btn-success mt-2 float-right btn-sm">Add</span>
                                                               </div>
                                                           </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-rejected-tab">
                            <div class="card-body order-datatable">
                                <table class="table table-borderd" id="dataTableNoPagingDesc2">
                                    <thead>
                                        <tr>
                                            <th width="50">Sl</th>
                                            <th width="200">First Name</th>
                                            <th width="200">Last Name</th>
                                            <th width="200">Email</th>
                                            <th width="200">Phone</th>
                                            <th width="200">Description</th>
                                            <th width="80">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i=0; @endphp @foreach($rejectSellers as $row)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $row->first_name }}</td>
                                            <td>{{ $row->last_name }}</td>
                                            <td>{{ $row->email }}</td>
                                            <td>{{ $row->phone }}</td>
                                            <td>{!! $row->description !!}</td>
                                            <td class="d-flex justify-content-between">
                                                <ul>
                                                    <li><a href="{{ url('/merchant/merchant/'.$row->id) }}" title="Rejected" class="btn btn-sm btn-primary" data-toggle="modal" data-target=".rejected{{$row->id}}">View</a></li>
                                                </ul>
                                            </td>
                                        </tr>

                                        <div class="modal fade rejected{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title f-w-600" id="exampleModalLabel">Seller Profile</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row p-3">
                                                            <div class="col-md-6 br-2">
                                                                <img src="{{ !empty($row->picture) ? asset($row->picture) : asset('/uploads/vendor_profile/user.png') }}" id="output" width="150" height="150" class="img" alt="" />
                                                                <div class="sort-info mt-4">
                                                                    <h3 class="display-6 pt-2">{{ $row->first_name.' '.$row->last_name}}</h3>
                                                                    <p class="">
                                                                        Email &nbsp;&nbsp;&nbsp;: {{ $row->email }} <br />
                                                                        Phone &nbsp;&nbsp;: {{ $row->phone }} <br />
                                                                        Gender &nbsp;: {{ $row->gender }}
                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="float-left modal-logo">
                                                                    <img src="{{ !empty($row->shop->logo) ? asset($row->shop->logo) : asset('/images/avatar-shop.png') }}" class="" height="100" width="100" alt="Logo" />
                                                                </div>
                                                                <div>
                                                                    <h3 class="display-5 font-weight-bold">{{ $row->shop->name }}</h3>
                                                                    <p>{{ $row->shop->slogan }}</p>
                                                                </div>

                                                                <br />
                                                                <div class="d-inline-block mt-3">
                                                                    <p class="text-justify">{{ $row->shop->description }}</p>
                                                                    <h5>{{ $row->shop->name }}</h5>
                                                                    <h6>750 followers | 10 review</h6>
                                                                    <h6>{{ $row->shop->email }}</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
        $(".btnClosePopup").click(function () {
            $("#MyPopup").modal("hide");
        });

</script>

<script> 
$('#saveReason').click(function(e){ 
    e.preventDefault();
    const name = $('#rej_name').val(); 
    if(name == '' ){
        alert ('Required Filed Must be filled');
    }else{
        var formData = $("#rejectId").serialize(); 
        $.ajax({
            type: 'POST',
            url:"{{ url('/andbaazaradmin/reject-name/') }}", 
            data: formData,
            dataType: "json",
            success: function(response){
                var name = $('#rej_name').val('');
                if(response){
                    $("#again").load(" #again");
                } 
            }
        })
    }
});
</script>
@endpush
