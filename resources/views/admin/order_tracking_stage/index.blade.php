@extends('admin.layout.master')


@section('content')
    @push('css')
        <style>
            .fa{
                padding:4px;
                font-size:16px;
            }
        </style>
    @endpush
    @include('elements.alert')
    @component('admin.layout.inc.breadcrumb')
        @slot('pageTitle')
            Order Tracking Stage
        @endslot
        @slot('page')
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            <li class="breadcrumb-item active" aria-current="page">Order Tracking Stage</li>
        @endslot
    @endcomponent

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-7">
                <div class="card">
                    <div class="card-header">
                        <h5>Order Tracking Stage</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderd" id="dataTableNoPagingDesc">
                            <thead>
                            <tr>
                                <th width="50">#</th>
                                <th width="200">Stage Name</th>
                                <th>Description</th>
                                <th width="80" class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody id="sortable">
                                @foreach( $orderTrackingStages as $trackingStage)
                                        <tr id='{{ $trackingStage->id }}'>
                                            <td style="cursor:move"><i class="fa fa-bars" aria-hidden="true"></i></td>
                                            <td>{{ $trackingStage->stage_name }}</td>
                                            <td>{{ \Illuminate\Support\Str::limit($trackingStage->details,100)  }}</td>
                                            <td class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-success btn-xs mr-1" id="{{ action('Admin\OrderTrackingStageController@edit',$trackingStage->id) }}" title="Edit" data-toggle="modal" data-original-title="test" data-target="#paymentEditModal{{$trackingStage->id}}"><i class="fa fa-edit"></i></button>
                                                <form action="{{ action('Admin\OrderTrackingStageController@destroy',$trackingStage->id) }}" method="post" id="deleteButton{{$trackingStage->id}}" style="display: inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-primary btn-xs" type="submit" onclick="makeDeleteRequest(event,{{$trackingStage->id}})"><i class="fa fa-trash-o"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="paymentEditModal{{$trackingStage->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title f-w-600" id="exampleModalLabel">Edit payment</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="needs-validation" novalidate="" action="{{ action('Admin\OrderTrackingStageController@update',$trackingStage->id) }}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('put')
                                                            <div class="form">
                                                                <div class="form-group">
                                                                    <label for="validationCustom01" class="mb-1">Stage Name :</label>
                                                                    <input type="text"  name="stage_name" value="{{old('stage_name',$trackingStage->stage_name)}}" required class="form-control @error('stage_name') border-danger @enderror">
                                                                    <span class="text-danger">{{ $errors->first('stage_name') }}</span>
                                                                </div>
                                                                <div class="form-group mb-0">
                                                                    <label for="validationCustom02" class="mb-1">Description :</label>
                                                                    <textarea name="details" class="form-control @error('details') border-danger @enderror" id="" rows="5">{{$trackingStage->details}}</textarea>
                                                                    <span class="text-danger">{{ $errors->first('details') }}</span>
                                                                </div>
                                                            </div>
                                                            <div class="mt-3 text-right">
                                                                <button type="submit" class="btn btn-success" type="button">Update</button>
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
            </div>
            <div class="col-sm-5">
                <div class="card">
                    <div class="card-header">
                        <h5>Manage Order Tracking Stage</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ action('Admin\OrderTrackingStageController@store') }}" method="post" class="form" id="validateForm">
                            @csrf
                            <div class="form-group">
                                <label for="name">Stage Name:</label>
                                <input type="text"  name="stage_name" value="{{ old('stage_name') }}" required class="form-control @error('stage_name') border-danger @enderror">
                                <span class="text-danger">{{ $errors->first('stage_name') }}</span>
                            </div>

                            <div class="form-group">
                                <label for="desc">Description:</label>
                                <textarea name="details" class="form-control @error('details') border-danger @enderror" id="" rows="5"></textarea>
                                <span class="text-danger">{{ $errors->first('details') }}</span>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $( "#sortable" ).on( "sortupdate", function( event, ui ) {
                var idsInOrder = $( "#sortable" ).sortable( "toArray" );
                $.ajax({
                    type:'POST',
                    url:'/andbaazaradmin/update-tracking-stages-order',
                    data:{trackingStageOrders: idsInOrder, _token: '{{ csrf_token() }}'},
                    success:function (response) {
                        if (response=='success'){
                            toastr.success('Order tracking stage order updated successfully.', 'Success');
                        }
                        else {
                            alert('Something went wrong. Please try again later.');
                        }
                    }
                });

                console.log(idsInOrder);
            } );
        });
        $( function() {
            $( "#sortable" ).sortable();
            $( "#sortable" ).disableSelection();
        } );
    </script>
@endpush

