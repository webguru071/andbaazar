@extends('merchant.master')

@section('content')
@push('css')
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
</style>
@endpush
@include('elements.alert')
{{-- @component('layouts.inc.breadcrumb')
  @slot('pageTitle')
      Vendor Dashboard
  @endslot
  @slot('page')
      <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
      <li class="breadcrumb-item active" aria-current="page">Profile</li>
  @endslot
@endcomponent --}}

    <!--  dashboard section start -->
    <section class="dashboard-section section-b-space">
        <div class="container">
            <div class="row">

                @include('layouts.inc.sidebar.vendor-sidebar',[$active='profile'])

             <div class="col-sm-9 register-page contact-page">
                <h3>PERSONAL DETAIL</h3>
                <form class="theme-form" action="{{ route('sellerUpdate') }}" method="post" enctype="multipart/form-data" id="validateForm">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-8">
                            <div>
                                <label for="first_name">First Name<span class="text-danger"> *</span></label> <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                <input type="text" class="form-control @error('first_name') border-danger @enderror" required name="first_name" value="{{ old('first_name',$userprofile->first_name) }}" id="" placeholder="Firest Name">
                            </div>
                            <div>
                                <label for="last_name" class="mt-2">Last Name<span class="text-danger"> *</span></label> <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                <input type="text" class="form-control @error('last_name') border-danger @enderror" required name="last_name" value="{{ old('last_name',$userprofile->last_name) }}" id="" placeholder="Last Name">
                            </div>
                            <div>
                                <label for="phone" class="mt-2">Phone number<span class="text-danger"> *</span></label> <span class="text-danger">{{ $errors->first('phone') }}</span>
                                <input type="number" class="form-control @error('phone') border-danger @enderror" required  name="phone" value="{{ old('phone') }}" id="" placeholder="Phone Number">
                            </div>
                            <div>
                                <label for="email" class="mt-2">Email<span class="text-danger"> *</span></label> <span class="text-danger">{{ $errors->first('email') }}</span>
                                <input type="email" class="form-control @error('email') border-danger @enderror" required  name="email" value="{{ old('email',$userprofile->email) }}" id="" placeholder="Email">
                            </div>
                        </div>


                        <div class="col-md-4 text-right">
                            <label for="picture">Picture</label>
                            <div class="mt-0">
                                <img id="output"  class="imagestyle" src="{{ asset('/uploads/vendor_profile/user.png') }}" />
                            </div>
                            <div class="uploadbtn">
                                <label for="file-upload" class="custom-file-upload">Upload Here</label>
                                <input id="file-upload" type="file" name="picture" onchange="loadFile(event)"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mt-2">
                            <label for="nid">National Identity Card (NID)<span class="text-danger"> *</span></label> <span class="text-danger">{{ $errors->first('nid') }}</span>
                            <input type="number" name="nid" class="form-control @error('nid') border-danger @enderror" required value="{{ old('nid') }}">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="nid_img">Nid Image</label>
                            <input type="file" name="nid_img" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6 mt-2">
                            <label for="trad_img">Trad Licence Image</label>
                            <input type="file" name="trad_img" class="form-control">
                        </div>
                    </div>

                    <label for="description" class="mt-2">Write Your Message</label> <span class="text-danger">{{ $errors->first('description') }}</span>
                    <textarea class="form-control summernote mb-0 @error('description') border-danger @enderror" placeholder="Write Your Message"  name="description"  id="" rows="6" ></textarea>


                    <div class="form-row">
                        <div class="col-md-6 mt-2">
                            <label for="dob">Date of birth<span class="text-danger"> *</span></label> <span class="text-danger">{{ $errors->first('dob') }}</span>
                            <input type="text"  class="form-control  @error('dob') border-danger @enderror datepickerPreviousOnly" required name="dob" value="{{ old('dob') }}"  id="" placeholder="YYYY/MM/DD" autocomplete="off">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="gender">Gender (select one)<span class="text-danger"> *</span></label> <span class="text-danger">{{ $errors->first('gender') }}</span>
                            <select name="gender" class="form-control px-10 @error('gender') border-danger @enderror" id="" required autocomplete="off" style="height: 51px;">
                                <option value="Male" selected>Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                        </select>
                        </div>

                        <div class="col-md-12 mt-4">
                            <button type="submit" class="btn btn-sm btn-solid" >Save</button>
                        </div>
                    </div>
                 </form>
             </div>
            </div>
        </div>
</section>
    <!--  dashboard section end -->
@endsection
{{-- @push('js')
<script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
    };
</script>
@endpush --}}
@push('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
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
@endpush
@push('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
@endpush
