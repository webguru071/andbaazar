@extends('admin.layout.master') @section('content') @push('css')
<style>
    .fa {
        padding: 4px;
        font-size: 16px;
    }
    .m-l-approve{
        margin-left:65px; margin-top:-35px;
    }
    .m-l-reject{
        margin-left:140px; margin-top:-27px;
    }
</style>
@endpush 
@include('elements.alert') 
@component('admin.layout.inc.breadcrumb') 
@slot('pageTitle') News Feed 
@endslot 
@slot('page')
<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
<li class="breadcrumb-item active" aria-current="page">News Feed</li>
@endslot @endcomponent
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <!-- <div class="card-header">
                        <h5> Product List</h5>
                    </div> -->
                <div class="card-body">  
                        <div class="card-body order-datatable">
                            <table class="table table-borderd" id="dataTableNoPagingDesc3">
                                <thead>
                                    <tr>
                                        <th width="50">Sl</th> 
                                        <th>Feed By</th>
                                        <th>Title</th>
                                        <th>Description</th> 
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=0; @endphp 
                                        @foreach($newsFeed as $row)
                                            <tr>
                                                <td>{{ ++$i }}</td>  
                                                <td>{{ $row->user->first_name.' '.$row->user->last_name}}</td>
                                                <td>{{ $row->title}}</td>
                                                <td>{{ Baazar::short_text(strip_tags($row->news_desc),30) }}</td> 
                                                <td>
                                                    @if($row->status == 'Pending')
                                                    <label class="badge badge-pill badge-info p-2">Pending</label>
                                                    @elseif($row->status == 'Active')
                                                    <label class="badge badge-pill badge-success p-2">Active</label>
                                                    @else
                                                    <label class="badge badge-pill badge-primary p-2">Reject</label>
                                                    {{-- <a href="#" id="" class="badge badge-pill badge-warning p-2" data-toggle="modal" data-original-title="test" data-target="#tagEditModal{{$row->id}}">Reject</a>  --}}
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <ul>
                                                        <li>
                                                            {{-- <a href="{{ url('/merchant/product/'.$row->slug) }}"><button class="btn btn-sm btn-secondary">View</button></a> --}}
                                                            <a href="#" id="" class="btn btn-sm btn-secondary" data-toggle="modal" data-original-title="test" data-target="#feedModal{{$row->id}}">View</a>
                                                        </li> 
                                                    </ul>
                                                </td>
                                            </tr>
                                    
                                            <div class="modal fade feednewsmodal" id="feedModal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title f-w-600" id="exampleModalLabel">News Feed</h5>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                        </div>

                                                        <div class="modal-body">  
                                                            <div class="container">
                                                                <div class="row">
                                                                    <div class="cal-md-6">
                                                                        <img  src="{{!empty($row->image) ? asset($row->image) : asset('/uploads/newsfeed_image/newsfeed-4.png')}}" alt="" height="200" width="200" class="img-fluid"> 
                                                                    </div>
                                                                </div> 
                                                                <h3 class="font-weight-bold mt-2">{{ $row->title }}</h3> 
                                                                <p>{!! $row->news_desc !!}</p>
                                                                <div> 
                                                                    @if($row->status == 'Pending')
                                                                    <label class="badge badge-pill badge-info p-2">Pending</label>
                                                                    <div class="m-l-approve">
                                                                        <form action="{{ url('merchant/newsfeed/approvement/'.$row->slug) }}" method="post" id="">
                                                                            @csrf
                                                                            <button type="submit" class="btn btn-sm btn-warning">Approve</button>
                                                                        </form>
                                                                    </div> 
                                                                    <div>
                                                                        <div class="m-l-reject"> 
                                                                        <button type="button" class="btn btn-sm btn-primary btnClosePopup" data-toggle="modal" data-original-title="test" data-target="#exampleModal{{ $row->id }}">Reject</button>
                                                                        </div> 
                                                                    </div>
                                                                    
                                                                    @elseif($row->status == 'Active')
                                                                    <label class="badge badge-pill badge-success p-2">Active</label>
                                                                    @else
                                                                    <label class="badge badge-pill badge-primary p-2">Reject</label>  
                                                                    @endif
                                                                </div> 
                                                            </div> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                              <div class="modal fade" id="exampleModal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title f-w-600" id="exampleModalLabel">Reject</h5>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ url('merchant/newsfeed/reject/'.$row->slug)}}" method="post" style="margin-top:-2px" id="">
                                                                @csrf
                                                                @method('put')
                                                                <div class="form" id="again">
                                                                    <div class="card-body">
                                                                        <div class="form-check">
                                                                            @foreach($rejectlist as $row)
                                                                            <label class="form-check-label" for="check1">
                                                                                <input type="checkbox" class="form-check-input" id="checked" name="rej_name[]" value="{{$row->rej_name}}">{{$row->rej_name}}
                                                                            </label><br>
                                                                            <input type="hidden" name="type" class="form-control" value="feed">
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-primary">Reject</button> 
                                                                </div>
                                                            </form>
                                                            <form id="rejectId" role="form" action="" class="form-material form" method="post">
                                                                @csrf
                                                                <div class="form-group mt-2">
                                                                    <label for="exampleInputPassword1 ">Others</label>
                                                                    <input type="text" class="form-control" id="rej_name" name="rej_name" placeholder=" if need add another reasoan ">
                                                                    <input type="hidden" name="type" class="form-control" value="feed"> 
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
  <script>
       $(".btnClosePopup").click(function () {
            $(".feednewsmodal").modal("hide");
        });

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
