@extends('merchant.master')

@section('content')
@push('css')
<style>
    .banar{
        max-width: 100% !important;
        width: 1430px !important;
        margin: 0 auto;
    }
    /* @media (min-width: 576px)
    .modal-dialog {
        max-width: 100%;} */
    .imagestyle{
        width: 130px;
        border-radius:100%;
    }

    .banar-upload {
        cursor: pointer;
        background: #a5a0a0b5;
        padding: 10px;
    }

    .shop-image-upload{
        position: absolute;
        left: 80px;
        background: #b5b2b2db;
        border-radius: 50%;
        height: 30px;
        width: 30px;
        align-items: center;
        padding: 4px;
        color: #fff;
    }
    .vendor-profile .profile-left .profile-detail {
        align-items: normal;
    }

    .loader {
        border: 10px solid #f3f3f3;
        border-top: 10px solid #3498db;
        border-radius: 50%;
        width: 10px;
        height: 10px;
        animation: spin 2s linear infinite;
        left: 114px;
        top: 65px;
        position: absolute;
    }
    .opacity5{
        opacity: .5;
    }

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}


</style>

@endpush
@include('elements.alert')
<!--  dashboard section start -->
<section class="dashboard-section section-b-space">
    <div class="container">
        <div class="row">
            @include('layouts.inc.sidebar.vendor-sidebar',[$active='shop'])
            <div class="col-sm-9 ">
                <!-- vendor cover start -->
                <div class="vendor-cover">
                    <div>
                        <div class="mt-0">
                            <img  id="banner-outputs" src="{{!empty($shopProfile->banner) ? asset($shopProfile->banner) : asset('frontend/assets/images/vendor/profile.jpg')}}" alt="" class="bg-img lazyload blur-up">
                            <label for="banar-upload" class="banar-upload"><i class="fa fa-camera" aria-hidden="true"> Edit Banar</i></label>
                            <input id="banar-upload" accept="image/*"  class ="d-none" type="file" name="logo"/>
                        </div>
                    </div>
                </div>
                <!-- vendor cover end -->

                <!-- section start -->
                <section class="vendor-profile pt-0">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="profile-left">
                                    <div class="profile-image">
                                        <div>
                                            <label for="shop-img-upload" class="custom-file-upload shop-image-upload"><i class="fa fa-camera" aria-hidden="true"></i></label>
                                            <input id="shop-img-upload" accept="image/*"  class ="d-none" type="file" name="shop-logo"/>
                                            <img id="shop-img" src="{{!empty($shopProfile->logo) ? asset($shopProfile->logo) : asset('/uploads/shops/logos/shop-1.png')}}" alt="" class="img-fluid imagestyle">
                                            <div id="loader" class=""></div>
                                            <h3 class="mt-1">Fashion Store</h3>
                                            <div class="rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <h6>750 followers | 10 review</h6>
                                        </div>
                                    </div>

                                    <div class="profile-detail text-justify">
                                        {{ Baazar::short_text(strip_tags($shopProfile->description),700) }}
                                    </div>


                                    <div class="vendor-contact">
                                        <div>
                                            <h6>follow us:</h6>
                                            <div class="footer-social">
                                                <ul>
                                                    <li><a href="http://www.facebook.com"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                                    <li><a href="http://www.youtube.com"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                                                    <li><a href="http://www.twitter.com"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                                    <li><a href="http://www.instagram.com"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </div>
                                            <h6>if you have any query:</h6>
                                            <div class="d-flex">
                                                <!-- <button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fa fa-edit"></i> Edit</button> -->

                                                <a href="{{url('merchant/shops/update/'.$shopProfile->slug)}}"  type="button" class="btn btn-primary m-1"><i class="fa fa-edit"></i> Edit</a>

                                                <a href="{{url('shops/'.$shopProfile->slug)}}"  type="button" class="btn btn-info m-1"><i class="fa fa-eye"></i> View</a>
                                            </div>
                                            {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#facebook"> <i class="fa fa-edit"></i> Edit Your Profile</button>                                                                         --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </section>

                <!-- collection section start -->
                <section class="section-b-space">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 collection-filter"> </div>
                            <div class="col">
                                <div class="collection-wrapper">
                                    <div class="collection-content ratio_asos">
                                        <div class="page-main-content">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="filter-main-btn"><span class="filter-btn btn btn-theme"><i class="fa fa-filter" aria-hidden="true"></i> Filter</span></div>
                                                </div>
                                            </div>
                                            <div class="collection-product-wrapper">
                                                <div class="product-top-filter">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="product-filter-content">
                                                                <div class="search-count">
                                                                    <h5>Showing Products 1-24 of 10 Result</h5>
                                                                </div>
                                                                <div class="collection-view">
                                                                    <ul>
                                                                        <li><i class="fa fa-th grid-layout-view"></i></li>
                                                                        <li><i class="fa fa-list-ul list-layout-view"></i></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="collection-grid-view">
                                                                    <ul>
                                                                        <li><img src="{{asset('frontend')}}/assets/images/icon/2.png" alt="" class="product-2-layout-view"></li>
                                                                        <li><img src="{{asset('frontend')}}/assets/images/icon/3.png" alt="" class="product-3-layout-view"></li>
                                                                        <li><img src="{{asset('frontend')}}/assets/images/icon/4.png" alt="" class="product-4-layout-view"></li>
                                                                        <li><img src="{{asset('frontend')}}/assets/images/icon/6.png" alt="" class="product-6-layout-view"></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="product-page-per-view">
                                                                    <select  id="page_size">
                                                                        <option value="24">24 Products Per Page</option>
                                                                        <option value="48">48 Products Per Page</option>
                                                                        <option value="96">96 Products Per Page</option>
                                                                    </select>
                                                                </div>
                                                                <div class="product-page-filter">

                                                                    <select id="category">
                                                                    <option value="Select">Search Category</option>
                                                                       @foreach($category as $row)
                                                                         <option value="{{ $row->id }}">{{$row->name}}</option>
                                                                       @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-wrapper-grid">
                                                    <div class="row">


                                                    @foreach($items as $row)
                                                    <div class="col-xl-3 col-sm-6">
                                                          <div class="product-box">
                                                              <div class="img-wrapper">
                                                                  <div class="front">
                                                                  @foreach($row->itemimage as $itemimg)
                                                                      @if($loop->first)
                                                                          <a href="#"><img src="{{ !empty($row->image) ? asset($row->image) : asset('/uploads/shops/products/product.png') }}" class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                                                      @endif
                                                                  @endforeach
                                                                      <div class="product-hover">
                                                                          <ul>
                                                                              <li>
                                                                                  <button class="btn" type="button" data-original-title="" title=""><i class="ti-pencil-alt"></i></button>
                                                                              </li>
                                                                              <li>
                                                                                  <button class="btn" type="button" data-toggle="modal" data-target="#exampleModalCenter" data-original-title="" title=""><i class="ti-trash"></i></button>
                                                                              </li>
                                                                          </ul>
                                                                      </div>
                                                                  </div>

                                                              <div class="product-detail">
                                                                  <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                                                                  <a href="#">
                                                                      <h6>{{ $row->name}}</h6>
                                                                  </a>
                                                                  <h4>${{$row->price}}</h4>
                                                                  <ul class="color-variant">
                                                                      @foreach($row->inventory as $color)
                                                                      <li class="bg-light0" style="background:{{ $color->color_name }}"></li>
                                                                      @endforeach
                                                                  </ul>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                                  @endforeach
                                                </div>
                                                </div>


                                                <!-- <div class="product-pagination mb-0">
                                                    <div class="theme-paggination-block">
                                                        <div class="row">
                                                            <div class="col-xl-6 col-md-6 col-sm-12">
                                                                <nav aria-label="Page navigation">
                                                                    <ul class="pagination">
                                                                        <li class="page-item"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true"><i class="fa fa-chevron-left" aria-hidden="true"></i></span> <span class="sr-only">Previous</span></a></li>
                                                                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                                        <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true"><i class="fa fa-chevron-right" aria-hidden="true"></i></span> <span class="sr-only">Next</span></a></li>
                                                                    </ul>
                                                                </nav>
                                                            </div>

                                                            <div class="col-xl-6 col-md-6 col-sm-12">
                                                                <div class="product-search-count-bottom">
                                                                    <h5>Showing Products 1-24 of 10 Result</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                {{$items->links()}}
            </div>
        </div>
    </div>
</section>




    {{-- Shop logo Crop Modal --}}
    <div class="modal" id="shop-logo-modal" tabindex="-1" role="dialog" aria-labelledby="shop-logo-modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Before upload resize your picture.</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div id="main-cropper"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary p-2" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary p-2" id="upload-image">Crop & Save</button>
            </div>
          </div>
        </div>
    </div>

    {{-- Banner Image Crop Modal --}}
    <div class="modal" id="banar-modal" tabindex="-1" role="dialog" aria-labelledby="banar-modalTitle" aria-hidden="true">
        <div class="modal-dialog banar modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Before upload resize your picture.</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div id="main-cropper-banar"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary p-2" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary p-2" id="upload-image-banar">Crop & Save</button>
            </div>
          </div>
        </div>
    </div>


@endsection

@push('css')
  <link rel="stylesheet" href="https://foliotek.github.io/Croppie/croppie.css">
  <style>
    input[type="file"] {
      display: none;
    }
    #mainNav {
      height: 70px;
    }
    #mainNav .navbar-brand img, .footer-widget.footer-about a > img {
      height: 34px;
    }
  </style>
@endpush

@push('js')
<script src="https://foliotek.github.io/Croppie/croppie.js"></script>

<script type="text/javascript">

$('#category').on('change',function(){
  var cat = $(this).val();

  window.location.href = 'shop?page=1&cat=' + cat;
});


$('#page_size').on('change',function(){
  var page_size = $(this).val();

  window.location.href = 'shop?page=1&page_size=' + page_size;
});



$(document).ready(function() {
     $('.summernote').summernote({
           height: 200,
      });
   });





function readFileLogo(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $("#main-cropper").croppie("bind", {
        url: e.target.result
      });
      $('#shop-logo-modal').modal('show');
    };
    reader.readAsDataURL(input.files[0]);
  }
}


$("#shop-img-upload").on("change", function() {
  readFileLogo(this);
});
var basic = $("#main-cropper").croppie({
    viewport: { width: 250, height: 250 },
    boundary: { width: 300, height: 300 },
    showZoomer: true,
    enableExif: true,
    enableResize: true
});



function readFileBanar(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $("#main-cropper-banar").croppie("bind", {
        url: e.target.result
      });
      $('#banar-modal').modal('show');
    };
    reader.readAsDataURL(input.files[0]);
  }
}

$("#banar-upload").on("change", function() {
  readFileBanar(this);
});
var basic = $("#main-cropper-banar").croppie({
    viewport: { width: 1370, height: 450 },
    boundary: { width: 1400, height: 500 },
    showZoomer: true,
    enableExif: true,
    enableResize: true,
    enableOrientation: true,
});


$("#upload-image").click(function() {
  $("#main-cropper")
    .croppie("result", {
      type: "canvas",
      size: "viewport",
    }).then(function(resp) {
      $('#shop-logo-modal').modal('hide');
      $("#result").attr("src", resp);
    //   console.log(resp);
      var _token = "{{csrf_token()}}";
        $.ajax({
          url: "{{route('shop-logo-crop')}}",
          type: "POST",
          dataType:"json",
          data: {"image":resp,_token:_token,'shop':{{$shopProfile->id}}},
          beforeSend:function(){
            $('#loader').addClass('loader');
            $('#shop-img').addClass('opacity5');
          },
          success: function (data) {
              $('#shop-img').attr('src',resp);
              $('#shop-img-sidebar').attr('src',resp);
            // console.log(data);
            $('#loader').removeClass('loader');
            $('#shop-img').removeClass('opacity5');
            $('#shop-img-sidebar').removeClass('opacity5');
          }
        });

    });
});
$("#upload-image-banar").click(function() {
  $("#main-cropper-banar")
    .croppie("result", {
      type: "canvas",
      size: "viewport",
    }).then(function(resp) {
      $('#banar-modal').modal('hide');
      $("#result").attr("src", resp);
      console.log(resp);
      var _token = "{{csrf_token()}}";
        $.ajax({
          url: "{{route('shop-banar-crop')}}",
          type: "POST",
          dataType:"json",
          data: {"image":resp,_token:_token,'shop':{{$shopProfile->id}}},
          beforeSend:function(){
            $('.vendor-cover div.mt-0.bg-size.blur-up.lazyloaded').addClass('opacity5');
            $('#banner-outputs').addClass('opacity5');
          },
          success: function (data) {
            $('.vendor-cover div.mt-0.bg-size.blur-up.lazyloaded').removeClass('opacity5');
            $('.vendor-cover div.mt-0.bg-size.blur-up.lazyloaded').attr('style',"background-image: url("+resp+"); background-size: cover; background-position: center center; display: block");
            //   $('#banner-outputs').attr('src',resp);
            // $('#banner-outputs').removeClass('opacity5');

          }
        });

    });
});






 </script>

<script>
   $(document).ready(function(){
     $('#upload-form').on('submit',function(event){
         event.preventDefault();
         $.ajax({
             url:"{{route('shopUpdate')}}",
             method:"POST",
             data:new FormData(this),
             dataType:'JSON',
             contentType:false,
             cache:false,
             processData:false,
             success:function(data)
             {

             }
         })
     });
   });
</script>

@endpush
