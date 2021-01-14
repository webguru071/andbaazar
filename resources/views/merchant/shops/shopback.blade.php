@extends('merchant.master')

@section('content')
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
<style>
    .imagestyle{
        width: 200px;
        height: 200px;
        border-width: 1px;
        border-style: solid;
        border-color: #ccc;
        border-bottom: 0px;
        padding: 10px;
    }

    #file-upload{
        display: none;
    }
    .uploadbtn{
        width: 200px;background: #ddd;float: right;text-align: center;
    }
    .custom-file-upload {
        /* border: 1px solid #ccc; */
        display: inline-block;
        padding: 9px 40px;
        cursor: pointer;
        border-top: 0px;
    }
    #map {
  height: 100%;
}
/* Optional: Makes the sample page fill the window. */
html, body {
  height: 100%;
  margin: 0;
  padding: 0;
}
</style>
@endpush
@include('elements.alert')
@component('layouts.inc.breadcrumb')
  @slot('pageTitle')
      Vendor Dashboard
  @endslot
  @slot('page')
      <li class="breadcrumb-item active" aria-current="page">Profile</li>
      <li class="breadcrumb-item active" aria-current="page">Shop</li>
  @endslot
@endcomponent


    <!--  dashboard section start -->
    <section class="dashboard-section section-b-space">
        <div class="container">

            <div class="row">

                @include('layouts.inc.sidebar.vendor-sidebar',[$active='shop'])

             <div class="col-sm-9 register-page contact-page">

                <h3>Shop Detail</h3>
                @if($sellerProfile->status == 'Inactive')
                <div class="mt-2">
                    {{-- <h3>Merchant profile Status</h3> --}}
                        <div class="bg-warning text-center p-5 rounded">
                            <h4>Thank Your for your request</h4>
                            <p>We nedd to review your request a little longer. After approve your request you can see your dashboard.</p>
                        </div>
                    </div>
                @elseif($sellerProfile->status == 'Reject')

                <div class="mt-2">
                    {{-- <h3 class="card-header text-danger">Merchant profile Status</h3> --}}
                        <div class="bg-warning p-5 text-center rounded">
                            <h4>Your profile is Rejected</h4>
                            <h6>Reject Reason : <small>{{ $sellerProfile->rej_desc }}</small></h6>
                            <p>Resubmit your Profile.</p>
                        <a href="{{ url('merchant/seller/'.$sellerProfile->slug.'/resubmit') }}" title="Resubmit" class="btn btn-sm btn-solid">Resubmit</a>
                        </div>
                </div>

                @elseif($sellerProfile->status == 'Active')
                <form class="theme-form" action="{{route('shopUpdate')}}" method="post" enctype="multipart/form-data" id="validateForm">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-8">
                            <div>
                                <label for="name">Shop Name<span class="text-danger"> *</span></label> <span class="text-danger">{{ $errors->first('name') }}</span>
                                <input type="text" class="form-control @error('name') border-danger @enderror" required name="name" value="{{ old('name',$shopProfile->name) }}" id="" placeholder="Shop Name">
                            </div>
                            <div>
                                <label for="phone" class="mt-2">Shop Phone<span class="text-danger"> *</span></label> <span class="text-danger">{{ $errors->first('phone') }}</span>
                                <input type="text" class="form-control @error('phone') border-danger @enderror" required name="phone" value="{{ old('phone',$shopProfile->phone) }}" id="" placeholder="Shop Phone">
                            </div>
                            <div>
                                <label for="email" class="mt-2">Shop Email<span class="text-danger"> *</span></label> <span class="text-danger">{{ $errors->first('email') }}</span>
                               <input type="email" class="form-control @error('email') border-danger @enderror" required  name="email" value="{{ old('email',$shopProfile->email) }}" id=""  placeholder="Shop Email">
                            </div>
                        </div>


                        <div class="col-md-4 text-right">
                            <label for="picture">Shop Logo</label>
                            <div class="mt-0">
                                @if(!empty($shopProfile->logo))
                                 <img id="output"  class="imagestyle" src="{{ asset($shopProfile->logo) }}"/>
                                @else
                                 <img id="output"  class="imagestyle" src="{{ asset('/images/avatar-shop.png') }}" />
                                @endif
                            </div>
                            <div class="uploadbtn">
                                <label for="file-upload" class="custom-file-upload">Upload Here</label>
                                <input id="file-upload" type="file" name="logo" onchange="loadFile(event)"/>
                                <input type="hidden" value="{{$shopProfile->logo}}" name="old_image">
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="web" class="mt-2">Web<span class="text-danger"> </span></label> <span class="text-danger">{{ $errors->first('web') }}</span>
                        <input type="url" class="form-control @error('web') border-danger @enderror"  name="web" value="{{ old('Web',$shopProfile->web) }}" id="" placeholder="Shop website">
                    </div>
                    <label for="description" class="mt-2">Write about your shop</label> <span class="text-danger">{{ $errors->first('description') }}</span>
                    <textarea class="form-control summernote mb-0 @error('description') border-danger @enderror" placeholder="Write Your Message"  name="description"  id="" rows="6" >{{ $shopProfile->description }}</textarea>


                    <div class="form-row">
                        <div class="col-md-12 mt-4">
                            <button type="submit" class="btn btn-sm btn-solid" >Shop Update</button>
                        </div>
                    </div>
                 </form>
                 @endif
             </div>
              <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="..." alt="Card image cap">
                <div class="card-body">
                    <div id="map"></div>

                    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLCE9-x9OVyUottiBHi_L6UZKB2rvj7eo&callback=initMap"
        type="text/javascript"></script>

                </div>
              </div>


              <!-- Replace the value of the key parameter with your own API key. -->

            </div>
        </div>
</section>
    <!--  dashboard section end -->
@endsection
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
     $('.summernote').summernote({
           height: 200,
      });
   });
 </script>
<script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
    };
</script>

<script>
    var marker;

function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 13,
    center: {lat: 59.325, lng: 18.070}
  });

  marker = new google.maps.Marker({
    map: map,
    draggable: true,
    animation: google.maps.Animation.DROP,
    position: {lat: 59.327, lng: 18.067}
  });
  marker.addListener('click', toggleBounce);
}

function toggleBounce() {
  if (marker.getAnimation() !== null) {
    marker.setAnimation(null);
  } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
}
</script>

{{-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLCE9-x9OVyUottiBHi_L6UZKB2rvj7eo&callback=initMap"
type="text/javascript"></script> --}}
{{--
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"
  type="text/javascript"></script> --}}
@endpush

