@extends('admin.layout.master')
@section('content')
@include('elements.alert')
<style>
    .imagestyle{
        width: 100px;
        height: 100px;
        border-width: 4px 4px 4px 4px;
        border-style: solid;
        border-color: #ccc;
    }
    .m-l-approve{
        margin-left:100px; margin-top:-39px;
    }
    .m-l-reject{
        margin-left:232px; margin-top:-39px;
    }
    .hm-gradient {
    background-image: linear-gradient(to top, #f3e7e9 0%, #e3eeff 99%, #e3eeff 100%);
}
.darken-grey-text {
    color: #2E2E2E;
}
</style>
@component('admin.layout.inc.breadcrumb')
    @slot('pageTitle')
        Krishi Product Detail
    @endslot
    @slot('page')
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        <li class="breadcrumb-item active" aria-current="page">Auction Detail</li>
    @endslot
@endcomponent


    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="card">
            <div class="row product-page-main card-body">
                <div class="col-xl-4">

                    <div class="product-slider owl-carousel owl-theme" id="sync1">

                        @foreach ($krishiproductImage as $row)
                            <div class="item"><img id="image-rander" src="{{ !empty($row->org_img) ? asset($row->org_img) : asset('/uploads/auction/auction.png') }}" alt="" class="blur-up lazyloaded"></div>
                        @endforeach
                    </div>
                    <div class="owl-carousel owl-theme" id="sync2">
                        @foreach ($krishiproductImage as $row)
                            <div class="item"><img id="image-loop" src="{{ !empty($row->org_img) ? asset($row->org_img) : asset('/uploads/auction/auction.png') }}" alt="" class="blur-up lazyloaded"></div>
                        @endforeach
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="product-page-details product-right mb-0">
                        <h2>{{ucfirst($krishiproduct->name)}}</h2>
                        <hr>
                        <h6 class="product-title">product details</h6>
                        <p>{!! $krishiproduct->description !!}</p>
                        <h6 class="product-title mt-1">Product Category</h6>
                        <p>{{$krishiproduct->category->name}}</p>
                        <div class="mt-1">
                         Video Url : {{$krishiproduct->video_url}}
                        </div>
                        <div class="mt-1">
                         Date : {{$krishiproduct->date}}
                        </div>
                       <hr>
                        
                        <div class="m-t-15">
                            <a class="btn btn-success" href="{{ URL::previous() }}">back</a>
                            <!-- <a href="{{ url('andbaazaradmin/e-commerce/products') }}"  class="btn btn-success">Back</a> -->
                            @if($krishiproduct->status == 'Active') 
                            <label class="badge badge-pill badge-info p-3">Approved</label>
                            @elseif($krishiproduct->status == 'Reject') 
                            <label class="badge badge-pill badge-primary p-3">Rejected</label>
                            <div class="form">
                                <h6  class="product-title mt-3">Reject description</h6>
                                <p>{{$krishiproduct->rej_desc }}</p>
                            </div>
                            @elseif($krishiproduct->status == 'Pending')
                            <div class="m-l-approve">
                            <form action="{{ url('merchant/krishi/products/approvement/'.$krishiproduct->slug) }}" method="post" style="margin-top:-2px" id="deleteButton({{ $krishiproduct->id }})">
                                @csrf
                                <button type="submit" class="btn btn-warning">Approve</button>
                            </form>
                            </div>
                            <div>
                                <div class="m-l-reject">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-original-title="test" data-target="#exampleModal">Reject</button>
                                </div>
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title f-w-600 text-danger" id="exampleModalLabel">Select The Reason For Reject :</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ url('merchant/krishi/products/rejected/'.$krishiproduct->slug)}}" method="post" style="margin-top:-2px" id="deleteButton({{ $krishiproduct->id }})">
                                                @csrf
                                                @method('put')
                                                <div class="form" id="again">
                                                    <div class="card-body">
                                                        <div class="form-check">
                                                            @foreach($rejectlist as $row)
                                                            <label class="form-check-label" for="check1">
                                                                <input type="checkbox" class="form-check-input" id="checked" name="rej_name[]" value="{{$row->rej_name}}">{{$row->rej_name}}
                                                            </label><br>
                                                            <input type="hidden" name="type" class="form-control" value="krishi">
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                 </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Reject</button>
                                                    </form> 
                                                    </div>
                                                </form>
                                                <form id="rejectId" role="form" action="" class="form-material form" method="post">
                                                    @csrf
                                                    <div class="form-group mt-2">
                                                        <label for="exampleInputPassword1 ">Others</label>
                                                        <input type="text" class="form-control" id="rej_name" name="rej_name" placeholder=" if need add another reasoan ">
                                                        <input type="hidden" name="type" class="form-control" value="krishi"> 
                                                        <div class="form-group  float-right">
                                                          <span id="saveReason" class="btn btn-success mt-2 float-right btn-sm">Add</span>
                                                        </div>
                                                    </div>
                                                 </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                            @endif
                        </div>
                </div>
            </div>
                    </div>
                </div>
{{--                <div class="col-xl-2 text-center">--}}
{{--                    <div class="product-page-details product-right mb-0 border m-t-40">--}}
{{--                        <div class="profile-top">--}}
{{--                            <div class="profile-image text-center">--}}
{{--                                <img src="{{ asset('') }}/assets/images/logos/17.png" alt="" class="img-fluid">--}}
{{--                            </div>--}}
{{--                            <div class="profile-detail text-center">--}}
{{--                                <h5>Fashion Store</h5>--}}
{{--                                <h6>750 followers | 10 review</h6>--}}
{{--                                <h6>mark.enderess@mail.com</h6>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
@endsection

@push('js')
 <script>
     $(document).ready(function(){
         $('.imagecolor').on('click',function(){
            var imgcolor = $(this).data('color'); 

            $.ajax({
                type:"GET",
                url:"{{url('andbaazaradmin/color-image/{color_slug}')}}",
                data:{'imgcolor':imgcolor},
                success:function(data){ 
                    $('img#image-rander').attr('src','{{asset("/")}}/'+data[0].org_img);
                    $('img#image-loop').attr('src','{{asset("/")}}/'+data[1].org_img);  
                }
            }) 
         })
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