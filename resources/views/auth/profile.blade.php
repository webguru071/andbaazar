@extends('merchant.master')

@section('content')
@push('css')
    <link rel="stylesheet" href="/jasny-bootstrap/css/jasny-bootstrap.min.css">
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
    #file-upload1{
        display: none;
    }
    .uploadbtn{
        width: 200px;background: #ddd;text-align: center;
    }
    .custom-file-upload {
        /* border: 1px solid #ccc; */
        display: inline-block;
        padding: 9px 40px;
        cursor: pointer;
        border-top: 0px;
    }
    .inputhight{
        /* height: 51px!important; */
    }
    .nidhight{
        /* height: 37px!important; */
    }
</style>
@include('elements.alert')
    <!--  dashboard section start -->
    <section class="dashboard-section section-b-space">
        <div class="container">
            <div class="row">
                @include('layouts.inc.sidebar.vendor-sidebar',[$active='profile'])

                 <div class="col-sm-9 register-page">
                     <form class="theme-form row" action="{{ route('sellerUpdate') }}" method="post" enctype="multipart/form-data" id="validateForm">
                         @csrf
                        <div class="form-group col-sm-6">
                            <label for="first_name">First Name<span class="text-danger"> *</span></label> <span class="text-danger">{{ $errors->first('first_name') }}</span>
                            <input type="text" class="form-control @error('first_name') border-danger @enderror" required name="first_name" value="{{ old('first_name',$userprofile->first_name) }}" id="" placeholder="Firest Name">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="last_name">Last Name<span class="text-danger"> *</span></label> <span class="text-danger">{{ $errors->first('last_name') }}</span>
                            <input type="text" class="form-control @error('last_name') border-danger @enderror" required name="last_name" value="{{ old('last_name',$userprofile->last_name) }}" id="" placeholder="Last Name">
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="email" class="">Email<span class="text-danger"> *</span></label> <span class="text-danger">{{ $errors->first('email') }}</span>
                            <input type="email" readonly class="form-control @error('email') border-danger @enderror" required  name="email" value="{{ old('email',$userprofile->email) }}" id="" placeholder="Email">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="phone" class="">Phone number<span class="text-danger"> *</span></label> <span class="text-danger">{{ $errors->first('phone') }}</span>
                            <input type="number" class="form-control @error('phone') border-danger @enderror" required  name="phone" value="{{ old('phone', $userprofile->phone) }}" id="" placeholder="Phone Number">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="nid">National Identity Card (NID)<span class="text-danger"> *</span></label> <span class="text-danger">{{ $errors->first('nid') }}</span>
                            <input type="number" name="nid" placeholder="National NID Number" class="form-control nidhight @error('nid') border-danger @enderror" required  value="{{ old('nid',$sellerProfile->nid) }}">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="dob">Date of birth<span class="text-danger"> *</span></label> <span class="text-danger">{{ $errors->first('dob') }}</span>
                            <input type="text" class="form-control @error('card_expire_date') border-danger @enderror datepickerPreviousOnly" required name="dob" value="{{ old('dob',$sellerProfile->dob) }}"  id="" placeholder="YYYY/MM/DD" autocomplete="off">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="gender">Gender (select one)<span class="text-danger"> *</span></label> <span class="text-danger">{{ $errors->first('gender') }}</span>
                            <select name="gender" class="form-control px-10 @error('gender') border-danger @enderror" id="" required autocomplete="off">
                                <option value="Male" @if($sellerProfile->gender == 'Male') selected @endif>Male</option>
                                <option value="Female" @if($sellerProfile->gender =='Female' ) selected @endif>Female</option>
                                <option value="Other" @if($sellerProfile->gender == 'Other') selected @endif>Other</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="description" class="">Write Your Message</label> <span class="text-danger">{{ $errors->first('description') }}</span>
                            <textarea class="form-control summernote mb-0 @error('description') border-danger @enderror" placeholder="Write Your Message"  name="description"  id="" rows="10" >{{ $sellerProfile->description }}</textarea>
                        </div>
                        <div class="col-md-8 d-flex justify-content-between">
                            <div class="form-group">
                                <label for="picture">Picture</label>
                                <div class="mt-0">
                                    @if(!empty($sellerProfile->picture))
                                        <img id="output"  class="imagestyle" src="{{ asset($sellerProfile->picture) }}"/>
                                    @else
                                        <img id="output"  class="imagestyle" src="{{ asset('/uploads/vendor_profile/user.png') }}" />
                                    @endif
                                </div>
                                <div class="uploadbtn">
                                    <label for="img-upload" class="custom-file-upload image-upload"><i aria-hidden="true"></i> Upload Here</label>
                                    <input id="img-upload" accept="image/*"  class ="d-none" type="file" name="picture"/>
                                    <input type="hidden" value="{{$sellerProfile->picture}}" name="old_image">
                                    <div id="loader" class=""></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nid_image">Nid Card Image</label>
                                <div class="mt-0">
                                    <img id="nid_output_1"  class="imagestyle" src="{{ !empty($sellerProfile->nid_img) ? $sellerProfile->nid_img : '/uploads/vendor_profile/nid_image/demo.jpeg' }}"/>
                                </div>
                                <div class="uploadbtn">
                                    <label for="file-upload" class="custom-file-upload">Upload Here</label>
                                    <input id="file-upload" onchange="loadFile(event)" type="file" name="nid_img" class="form-control" value="{{ $sellerProfile->nid_img  }}">
                                    <input type="hidden" value="{{$sellerProfile->nid_img}}" name="old_nid_img">
                                </div>
                                @if(!empty($sellerProfile->nid_img))
                                    <a href="{{ asset($sellerProfile->nid_img) }}"  download="download">Download Here..</a>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="picture">Tread Licence Image</label>
                                <div class="mt-0">
                                    <img id="nid_output_2"  class="imagestyle" src="{{ !empty($sellerProfile->trad_img) ? $sellerProfile->trad_img : '/uploads/vendor_profile/trad_image/demo.png' }}"/>
                                </div>
                                <div class="uploadbtn">
                                    <label for="file-upload1" class="custom-file-upload">Upload Here</label>
                                    <input id="file-upload1" onchange="loadFile1(event)" type="file" name="trad_img" class="form-control" value="{{ $sellerProfile->trad_img  }}">
                                    <input type="hidden" value="{{$sellerProfile->trad_img}}" name="old_trad_img">
                                </div>
                                @if(!empty($sellerProfile->trad_img))
                                    <a href="{{ asset($sellerProfile->trad_img) }}"  download="download">Download Here..</a>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 mt-4">
                            <button type="submit" class="btn btn-sm btn-solid" >Update</button>
                        </div>
                     </form>
                </div>
            </div>
        </div>
    </section>
    <!--  dashboard section end -->
    <div class="modal" id="image-modal" tabindex="-1" role="dialog" aria-labelledby="shop-logo-modalTitle" aria-hidden="true">
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
    <script src="/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
<script src="https://foliotek.github.io/Croppie/croppie.js"></script>
<script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
    };
</script>

<script type="text/javascript">
    $(document).ready(function() {
     $('.summernote').summernote({
           height: 300,
      });
   });

   function readFileLogo(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $("#main-cropper").croppie("bind", {
        url: e.target.result
      });
      $('#image-modal').modal('show');
    };
    reader.readAsDataURL(input.files[0]);
  }
}

$("#img-upload").on("change", function() {
  readFileLogo(this);
});
var loadFile = function(event) {
    //   var output = document.getElementById('output');
      nid_output_1.src = URL.createObjectURL(event.target.files[0]);
  };
var loadFile1 = function(event) {
    //   var output = document.getElementById('output');
      nid_output_2.src = URL.createObjectURL(event.target.files[0]);
  };
var basic = $("#main-cropper").croppie({
    viewport: { width: 250, height: 250 },
    boundary: { width: 300, height: 300 },
    showZoomer: true,
    enableExif: true
});
$("#upload-image").click(function() {
  $("#main-cropper")
    .croppie("result", {
      type: "canvas",
      size: "viewport",
    }).then(function(resp) {
      $('#image-modal').modal('hide');
      $("#result").attr("src", resp);
    //   console.log(resp);
      var _token = "{{csrf_token()}}";
        $.ajax({
          url: "{{route('profile-image-crop')}}",
          type: "POST",
          dataType:"json",
          data: {"picture":resp,_token:_token,'profile':{{$sellerProfile->id}}},
          beforeSend:function(){
            $('#loader').addClass('loader');
            $('#output').addClass('opacity5');
          },
          success: function (data) {
              $('#output').attr('src',resp);
              $('#img-sidebar').attr('src',resp);
            // console.log(data);
            $('#loader').removeClass('loader');
            $('#output').removeClass('opacity5');
            $('#img-sidebar').removeClass('opacity5');
          }
        });

    });
});
 </script>
{{-- <script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
    };
</script>  --}}
@endpush
