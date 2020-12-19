@extends('auth.auth-master')
@section('content')
@include('elements.alert') 
@push('css')
<style>
    .padding{
        padding: 12px!important;
    }
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 250px;
        margin-bottom: 20px;
      }
      .auth-form .form-control {
          border-radius: 0px !important;
      }
</style>
@endpush
<div class="row"> 
    <div class="col-md-5 p-0 card-left"></div>
        <div class="col-md-7 p-0 card-right"> 
            <div class="card tab2-card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="contact-top-tab" data-toggle="tab" href="#top-contact" role="tab" aria-controls="top-contact" aria-selected="false"><span class="icon-unlock mr-2"></span>Shop Register</a> 
                        </li>
                    </ul>
                    @if(session('flash_notification'))
                        <div class="flash-message">
                            @include('flash::message')
                        </div>
                    @endif                      
                    <form class="form-horizontal auth-form" action="{{ route('sellerShopeRegistration') }}" method="post" enctype="multipart/form-data" id="validateForm">
                        @csrf
                        <input type="hidden" name="token" value="{{ $seller->remember_token }}">
                        <div class="form-group">
                            <input required="" name="name" value="{{ old('name') }}" type="text" class="form-control @error('name') border-danger @enderror" placeholder="Shop Name" id="exampleInputEmail12" autocomplete="off"> 
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        </div>
                        
                        <div class="form-group">
                            <select name="division" class="form-control px-10 @error('division') border-danger @enderror" id="division" onchange="getDistrict(this)"  required autocomplete="off" style="height: 45px;">                                         
                                <option value="">Division</option>
                                @foreach ($divisions as $division)
                                    <option value="{{$division->id}}" data-lat="{{$division->lat}}" data-lng="{{$division->lng}}">{{$division->bn_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="row">
                                <select name="district" class="form-control col-md-8 px-10 @error('district') border-danger @enderror" id="district"  required autocomplete="off" style="height: 45px;">
                                    <option value="" selected disabled>Select District</option>
                                </select>

                                <select name="type" class="form-control col-md-4 px-10 @error('type') border-danger @enderror" id="type"  required autocomplete="off" style="height: 45px;">
                                    <option value="Residential" selected>Residential</option>
                                    <option value="Municipal">Municipal</option>
                                </select>
                            </div>
                        </div>

                        <div class="upazila">
                            <div class="form-group">
                                <select name="upazila" class="form-control px-10 @error('upazila') border-danger @enderror" id="upazila"  required autocomplete="off" style="height: 45px;">
                                    <option value="" selected disabled>Select Upazila</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="union" class="form-control px-10 @error('union') border-danger @enderror" id="union"  required autocomplete="off" style="height: 45px;">
                                    <option value="" selected disabled>Select Union</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="village" class="form-control px-10 @error('village') border-danger @enderror" id="village"  required autocomplete="off" style="height: 45px;">
                                    <option value="" selected disabled>Select Village</option>
                                </select>
                            </div>
                        </div>

                        <div class="municipal" style="display: none">
                            <div class="form-group">
                                <select name="municipal" class="form-control px-10 @error('municipal') border-danger @enderror" id="municipal"  required autocomplete="off" style="height: 45px;">
                                    <option value="" selected disabled>Select municipal</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="ward" class="form-control px-10 @error('ward') border-danger @enderror" id="ward"  required autocomplete="off" style="height: 45px;">
                                    <option value="" selected disabled>Select ward</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="row">
                                <input id="searchTextField" type="text" size="50" placeholder="Enter a location" class="form-control col-md-8 px-10"/>
                                <input type="button" onclick="getLocation();" class="form-control col-md-4 px-10" value="Find my location"/>
                            </div>
                        </div>
                        <input type="hidden" id="lat" name="lat" value="23.811273">
                        <input type="hidden" id="lng" name="lng" value="88.1007585">
                        <div id="mapholder"></div>
                        <div id="map"></div>
                        <div class="form-button mt-4 float-right">
                            <button class="btn btn-success" type="submit">Shope Register</button>
                        </div> 
                    </form>
               </div>
            </div>
     </div>
 </div> 
@endsection


@push('js')
@include('elements.map')
<script>
    $(document).ready(function(){
        setTimeout(function(){
            getLocation();
        },500)
    })
    function getDistrict(e){
        var division = $(e).find('option:selected'); 
        var lat = division.data("lat"); 
        var lng = division.data("lng");
        $.ajax({
            url : "{{route('get-district')}}",
            type : 'POST',
            data : {'division':$(e).val(),'_token':'{{csrf_token()}}'},
            dataType : 'text',
            beforeSend : function(){
                console.log('sending');
            },
            success : function(response){
                // console.log(response);
                $('#district').html(response);
            }
        });
        initMap(lat,lng,10);
        $('#upazila').html('<option value="" selected disabled>Select Upazila</option>');
        $('#union').html('<option value="" selected disabled>Select Union</option>');
        $('#village').html('<option value="" selected disabled>Select Village</option>');
        $('#municipal').html('<option value="" selected disabled>Select Municipal</option>');
        $('#ward').html('<option value="" selected disabled>Select ward</option>');
    };
    
    $('#district').change(function(){
        var district = $(this).find('option:selected'); 
        var lat = district.data("lat"); 
        var lng = district.data("lng");
        $.ajax({
            url : "{{route('get-upazila')}}",
            type : 'POST',
            data : {'district':$(this).val(),'_token':'{{csrf_token()}}'},
            dataType : 'json',
            beforeSend : function(){
                console.log('sending');
            },
            success : function(response){
                $('#upazila').html(response.upazila);
                $('#municipal').html(response.municipal);
            }
        });
        initMap(lat,lng,10);
        $('#union').html('<option value="" selected disabled>Select Union</option>');
        $('#village').html('<option value="" selected disabled>Select Village</option>');
        $('#ward').html('<option value="" selected disabled>Select ward</option>');
    });


    $('#upazila').change(function(){
        // var upazila = $(this).find('option:selected'); 
        // var lat = upazila.data("lat"); 
        // var lng = upazila.data("lng");
        $.ajax({
            url : "{{route('get-union')}}",
            type : 'POST',
            data : {'upazila':$(this).val(),'_token':'{{csrf_token()}}'},
            dataType : 'text',
            beforeSend : function(){
                console.log('sending');
            },
            success : function(response){
                // console.log(response);
                $('#union').html(response);
            }
        });
        $('#village').html('<option value="" selected disabled>Select Village</option>');
        // initMap(lat,lng,10);
    });

    $('#municipal').change(function(){
        // var upazila = $(this).find('option:selected'); 
        // var lat = upazila.data("lat"); 
        // var lng = upazila.data("lng");
        $.ajax({
            url : "{{route('get-ward')}}",
            type : 'POST',
            data : {'municipal':$(this).val(),'_token':'{{csrf_token()}}'},
            dataType : 'text',
            beforeSend : function(){
                console.log('sending');
            },
            success : function(response){
                // console.log(response);
                $('#ward').html(response);
            }
        });
        // initMap(lat,lng,10);
    });

    $('#union').change(function(){
        // var upazila = $(this).find('option:selected'); 
        // var lat = upazila.data("lat"); 
        // var lng = upazila.data("lng");
        $.ajax({
            url : "{{route('get-village')}}",
            type : 'POST',
            data : {'union':$(this).val(),'_token':'{{csrf_token()}}'},
            dataType : 'text',
            beforeSend : function(){
                console.log('sending');
            },
            success : function(response){
                // console.log(response);
                $('#village').html(response);
            }
        });
        // initMap(lat,lng,10);
    });

    $('#type').change(function(){
        var type = $(this).val();
        // console.log(type);
        if(type == 'Municipal'){
            $('.municipal').show();
            $('.upazila').hide();
        }else{
            $('.municipal').hide();
            $('.upazila').show();
        }
    });

  </script>
  

  @endpush
