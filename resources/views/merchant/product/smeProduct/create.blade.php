@extends('merchant.master')

@section('content')
@include('elements.alert')

    <!--  dashboard section start -->
    <section class="dashboard-section section-b-space">
        <div class="container">
            <div class="row">
                @include('layouts.inc.sidebar.vendor-sidebar',[$active ='smeProduct'])
                <div class="col-sm-9">
                    <h2 id="heading">Add SME Product</h2>
                    <form id="msform" action="{{ route('smeproduct.store') }}" method="post"  enctype="multipart/form-data" id="validateForm">
                        @csrf
                        <!-- progressbar -->
                        <ul id="progressbar">
                            <li class="active1 msform1" id="account"><strong><i class="fa fa-product-hunt "></i> Basic Information</strong></li>
                            <li class="msform1" id="personal"><strong><i class="fa fa-info-circle "></i> Details</strong></li>
                            <li class="msform1" id="payment"><strong><i class="fa fa-exchange"></i> Price & Stock</strong></li>
                            <li class="msform1" id="confirm1"><strong><i class="fa fa-check-circle"></i> Finish</strong></li>
                        </ul>

                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <br>

                        <fieldset id="basic_information">
                            <div>
                            @include('merchant.product.smeProduct.productBasicinfo')                               
                                <input type="hidden" name="email" value="{{ $sellerId->email }}">
                            </div>
                            <input type="button" name="next" class="next btn btn-primary float-right" value="Next" data-step="1"/>
                        </fieldset>
                        <fieldset id="detail_information">
                            <div class="card mb-4">
                                <h5 class="card-header">Detailed Description</h5>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="bn_description" class="">Description (Bangla)<span class="text-danger"> *</span></label>
                                        <textarea class="form-control  summernote"  id="bn_description"  name="bn_description"></textarea>
                                        <span class="text-danger" id="message_bn_description"></span>
                                        @if ($errors->has('bn_description'))
                                            <span class="text-danger">{{ $errors->first('bn_description') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="">Description (English)</label>
                                        <textarea class="form-control  summernote"  id="description" name="description"></textarea>
                                        <span class="text-danger" id="message_description"></span>
                                        @if ($errors->has('description'))
                                            <span class="text-danger">{{ $errors->first('description') }}</span>
                                        @endif
                                    </div>                                  
                                </div>
                            </div>
                            <input type="button" name="next" class="next btn btn-primary float-right" value="Next" data-step="2" />
                            <input type="button" id="previous" name="previous" class="previous btn btn-info float-right mr-2" value="Previous" />
                        </fieldset>
                        <fieldset id="pricestock_information">
                            <div>
                                @include('merchant.product.priceAndstock')
                            </div>
                            <input type="button" name="next" class="next btn btn-primary float-right" value="Next" data-step="3"/>
                            <input type="button" id="previous2" name="previous" class="previous btn btn-info float-right mr-2" value="Previous" />
                        </fieldset>
                        <fieldset id="tagmodel_information">
                            <div>
                                <div class="card mb-4">
                                    <h5 class="card-header">Tag & Model</h5>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="tag_id" class="col-xl-3 col-md-4">Tag <span>*</span></label>
                                            <div class="col-md-8 multiple-tag">
                                                <select class="js-example-basic-multiple form-control" name="tag_id[]" id="tad_id" multiple="multiple" required>
                                                    @foreach ($tag as $row)
                                                        <option value="{{ $row->name }}">{{$row->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>                                       
                                        <div class="form-group row margin">
                                            <label for="materials" class="col-xl-3 col-md-4">Materials<span>*</span></label>
                                            <input type="text" class="form-control col-md-8" name="materials" id="materials"  required="">
                                            <label for="materials" class="col-xl-3 col-md-4"><span></span></label>
                                            <span class="text-danger" id="message_materials"></span>
                                            @if ($errors->has('materials'))
                                                <span class="text-danger">{{ $errors->first('materials') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-4 ">
                                    <h5 class="card-header">Price</h5>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="price" class="col-xl-3 col-md-4"> MRP  <span>*</span></label>
                                            <input type="number" class="form-control col-md-8" name="price" id="price" required="">
                                            <label for="model_no" class="col-xl-3 col-md-4"><span></span></label>
                                            <span class="text-danger" id="message_price"></span>
                                            @if ($errors->has('price'))
                                                <span class="text-danger">{{ $errors->first('price') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group row margin">
                                            <label for="org_price" class="col-xl-3 col-md-4">Selling Price<span>*</span></label>
                                            <input type="number" class="form-control col-md-8" name="org_price" id="org_price" required="">
                                            <label for="model_no" class="col-xl-3 col-md-4"><span></span></label>
                                            <span class="text-danger" id="message_org_price"></span>
                                            @if ($errors->has('org_price'))
                                                <span class="text-danger">{{ $errors->first('org_price') }}</span>
                                            @endif
                                        </div>                                       
                                    </div>
                                </div>
                               <div class="card mb-4">
                                    <h5 class="card-header">Product Publis on news feed (optional)</h5>
                                    <div class="card-body">
                                        <div class="contianer"> 
                                            <div class="form-group">
                                                <div class="checkbox">
                                                    <label data-toggle="collapse" data-target="#collapseable" aria-expanded="false" aria-controls="collapseable">
                                                        Are you want to publish product on news feed ? <input type="checkbox" id="check"></label>
                                                </div>
                                            </div>
                                            <div id="collapseable" aria-expanded="false" class="collapse">
                                                <div class="well">
                                                    <div class="form-group row">
                                                        <div class="col-md-6 text-left">
                                                            <label for="image">News feed Image</label> 
                                                            <div class="mt-0">
                                                                <img id="output"  class="imagestyle" src="{{ asset('/uploads/newsfeed_image/newsfeed-4.png') }}" />
                                                            </div>
                                                            <div class="uploadbtn">
                                                                <label for="file-upload" class="custom-file-upload">Upload Here</label>
                                                                <input id="file-upload" type="file" name="image" onchange="loadFile(event)"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="title" class="">Title <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="title" id="title">
                                                        <span class="text-danger" id="message_title"></span>
                                                        @if ($errors->has('title'))
                                                            <span class="text-danger">{{ $errors->first('title') }}</span>
                                                        @endif 
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="news_desc" class="">Description<span class="text-danger"> *</span></label>
                                                        <textarea class="form-control summernote"  id="newsDesctiption"  name="news_desc"></textarea>
                                                        <span class="text-danger" id="message_news_desc"></span>
                                                        @if ($errors->has('news_desc'))
                                                            <span class="text-danger">{{ $errors->first('news_desc') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button id="save" class="btn btn-success float-right ml-2" type="submit" data-step="4">Save</button>
                            <input type="button" id="previous3" name="previous" class="previous btn btn-info float-right mr-2" value="Previous" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- section end -->

@endsection

@push('css') 
<!-- <link hred="{{ asset('css/summernote.min.css')}}" rel="stylesheet"> -->

<!-- <link rel="stylesheet" type="text/css" href="{{asset('css')}}/select2.min.css"> -->

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
{{-- 
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> --}}

<style>
    .categoryBox{
        /* width: 672px; */
        margin-left: 204px;
        height: 300px;
    }
    .keyword{
        width: 129px;
        height: 1px;
    }
    .attributs{
        margin-left: 2px;
    }
    .tbSelectbox{
        height: 35px;
        width: 94px;
     }

     .t1{
        height: 37px;
     }


     }
     /*  */
     * {
    margin: 0;
    padding: 0
}

html {
    height: 100%
}

p {
    color: grey
}

/* Step design  */
.msform1 {
    text-align: center;
    margin-top: 20px
}




#msform fieldset:not(:first-of-type) {
    display: none
}


#progressbar {
    overflow: hidden;
}

#progressbar .active1 {
    color: #FF4C3B
}

#progressbar li {
    width: 25%;
    float: left;
}


.progress-bar {
    background-color: #FF4C3B
}

span.select2.select2-container.select2-container--default {
    width: 100% !important;
}

.multiple-tag{
    padding-right: 0px !important;
    padding-left: 0px !important;
}
.select2-container--default .select2-selection--multiple {
    border: 1px solid #ced4da;
    border-radius: 0px !important;
    cursor: text;
    padding-bottom: 0px !important;
    padding-right: 0px !important;
    height: 40px !important;
}

    #personal_information{
        display:none;
    }

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
        width: 200px;background: #ddd;float: left;text-align: center;
    }
    .custom-file-upload {
        /* border: 1px solid #ccc; */
        display: inline-block;
        padding: 9px 40px;
        cursor: pointer;
        border-top: 0px;
    }


/* select2 */

.select2-selection {
    height: 34px !important; 
    font-size: 13px;
    font-family: 'Open Sans', sans-serif;
    border-radius: 0 !important;
    border: solid 1px #c4c4c4 !important;
    padding-left: 4px;
    padding-top:7px;
    }

    .select2-selection--multiple {
    height: 70px !important;
    width: 75px !important;
    overflow: hidden;
    }

    .select2-selection__choice {
    height: 40px;
    line-height: 40px;
    padding-right: 16px !important;
    padding-left: 16px !important;
    background-color: #CAF1FF !important;
    color: #333 !important;
    border: none !important;
    border-radius: 3px !important;
    }

    .select2-selection__choice__remove {
    float: right;
    margin-right: 0;
    margin-left: 2px;
    }
    .select2-search--inline .select2-search__field {
    line-height: 40px;
    color: #333;
    width: 100%!important;
    }

    .select2-container:hover,
    .select2-container:focus,
    .select2-container:active,
    .select2-selection:hover,
    .select2-selection:focus,
    .select2-selection:active {
    outline-color: transparent;
    outline-style: none;
    }

    .select2-results__options li {
    display: block; 
    }

    .select2-selection__rendered {
    transform: translateY(2px);
    }

    .select2-selection__arrow {
    display: none;
    }

    .select2-results__option--highlighted {
    background-color: #CAF1FF !important;
    color: #333 !important;
    }

    .select2-dropdown {
    border-radius: 0 !important;
    box-shadow: 0px 3px 6px 0 rgba(0,0,0,0.15) !important;
    border: none !important;
    margin-top: 4px !important;
    width: 366px !important;
    }

    .select2-results__option {
    font-family: 'Open Sans', sans-serif;
    font-size: 13px;
    line-height: 24px !important;
    vertical-align: middle !important;
    padding-left: 8px !important;
    }

    .select2-results__option[aria-selected="true"] {
    background-color: #eee !important; 
    }

    .select2-search__field {
    font-family: 'Open Sans', sans-serif;
    color: #333;
    font-size: 13px;
    padding-left: 8px !important;
    border-color: #c4c4c4 !important;
    }

    .select2-selection__placeholder {
    color: #c4c4c4 !important; 
    }
    .select2-selection {
    height: 34px !important; 
    font-size: 13px;
    font-family: 'Open Sans', sans-serif;
    border-radius: 0 !important;
    border: solid 1px #c4c4c4 !important;
    padding-left: 4px;
    padding-top:7px;
}

.select2-selection--multiple {
  height: 70px !important;
  width:669px !important;
  margin-right:20px;
  overflow: hidden;
}

.select2-selection__choice {
  height: 40px;
  line-height: 40px;
  padding-right: 16px !important;
  padding-left: 16px !important;
  background-color: #CAF1FF !important;
  color: #333 !important;
  border: none !important;
  border-radius: 3px !important;
}

.select2-selection__choice__remove {
  float: right;
  margin-right: 0;
  margin-left: 2px;
}
.select2-search--inline .select2-search__field {
  line-height: 40px;
  color: #333;
  width: 100%!important;
}

.select2-container:hover,
.select2-container:focus,
.select2-container:active,
.select2-selection:hover,
.select2-selection:focus,
.select2-selection:active {
  outline-color: transparent;
  outline-style: none;
}

.select2-results__options li {
  display: block; 
}

.select2-selection__rendered {
  transform: translateY(2px);
}

.select2-selection__arrow {
  display: none;
}

.select2-results__option--highlighted {
  background-color: #CAF1FF !important;
  color: #333 !important;
}

.select2-dropdown {
  border-radius: 0 !important;
  box-shadow: 0px 3px 6px 0 rgba(0,0,0,0.15) !important;
  border: none !important;
  margin-top: 4px !important;
  width: 366px !important;
}

.select2-results__option {
  font-family: 'Open Sans', sans-serif;
  font-size: 13px;
  line-height: 24px !important;
  vertical-align: middle !important;
  padding-left: 8px !important;
}

.select2-results__option[aria-selected="true"] {
  background-color: #eee !important; 
}

.select2-search__field {
  font-family: 'Open Sans', sans-serif;
  color: #333;
  font-size: 13px;
  padding-left: 8px !important;
  border-color: #c4c4c4 !important;
}

.select2-selection__placeholder {
  color: #c4c4c4 !important; 
}
    /* select2  End*/

</style>
@endpush
@push('js') 
<!-- <script src="{{ asset('js/summernote.min.js') }}"></script> -->
{{-- 
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>

<!-- <script src="{{ asset('') }}/js/select2.min.js"></script> -->

<script type="text/javascript">

    $(document).ready(function() {
     $('.summernote').summernote({
           height: 300,
      });
   });
    $('.js-example-basic-multiple').select2();
    //


$(document).ready(function(){

    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;
    var current = 1;
    var steps = $("fieldset").length;

    setProgressBar(current);

    $(".next").click(function(){
        var error = 0;
        var current_step = $(this).data('step');
        if(current_step == 1){error = firstStepValidation();}
        if(current_step == 2){error = secondStepValidation();}
        if(current_step == 3){error = thirdStepValidation();}
        if(current_step == 4){error = fourthStepValidation();}
        if(error == 0) {
            current_fs = $(this).parent();
            next_fs = $(this).parent().next();
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active1");
            next_fs.show();
            current_fs.css({
                'display': 'none',
                'position': 'relative'
            });
            setProgressBar(++current);
        }
    });
    
    $(".previous").click(function(){
        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active1");
        previous_fs.show();
            current_fs.css({
                'display': 'none',
                'position': 'relative'
            });
            setProgressBar(--current);
    });

    function setProgressBar(curStep){
        var percent = parseFloat(100 / steps) * curStep;
        percent = percent.toFixed();
        $(".progress-bar")
        .css("width",percent+"%")
    }

});
    function checkeEmpty(id){
        if ($('#'+id).val() == ''){
            $('#'+id).addClass('border-danger');
            $('#message_'+id).text('This field is required');
            return 1;
        }else{
            $('#'+id).removeClass('border-danger');
            $('#message_'+id).text('');
            return 0;
        }
    }
    function checkUrl(id){
        if (url){
            return 0;
        }else{
            return 1;
        }
        
    }
    
    function firstStepValidation(){
        var err = 0;
        err = checkeEmpty('bn_name');
        err = checkeEmpty('name');
        err = checkeEmpty('category');
        // err = checkeEmpty('video_url');
        //err = checkUrl('video_url');
        return err;
    }
    function secondStepValidation(){
        var err = 0;
        err = checkeEmpty('bn_description');
        err = checkeEmpty('description');
        err = checkeEmpty('made_in');
        return err;
    }
    function thirdStepValidation(){
       var img = 0;
       var err = 0;

       var album_text = [];

        $("input[name='inventory_price[]']").each(function() {
            var value = $(this).val();
            if (!value) {
                err = 1;
                $(this).addClass('border-danger');
            }else{
                $(this).removeClass('border-danger');
            }
        });
        $("input[name='inventory_qty[]']").each(function() {
            var value = $(this).val();
            if (!value) {
                err = 1;
                $(this).addClass('border-danger');
            }else{
                $(this).removeClass('border-danger');
            }
        });
        $("input[name='seller_sku[]']").each(function() {
            var value = $(this).val();
            if (!value) {
                err = 1;
                $(this).addClass('border-danger');
            }else{
                $(this).removeClass('border-danger');
            }
        });
        $(".image-class-main").each(function() {
            var value = $(this).val();
            console.log(value);
            if (value) {
                img = img+1;
            }
        });
        console.log(img);
        if(img == 0){
            $('.my-awesome-dropzone-main').attr('style', 'border-color:red !important');
            $('#message_main_img').text('You must put at least one image');
            err = 1;
        }else{
            $('.my-awesome-dropzone-main').removeAttr('style');
            $('#message_main_img').text('');
        }
       return err;
    }
    function fourthStepValidation(){
        var err = 0;
        err = checkeEmpty('tag_id');
        err = checkeEmpty('model_no');
        err = checkeEmpty('materials');
        err = checkeEmpty('price');
        err = checkeEmpty('org_price');
        err = checkeEmpty('min_order');
        return err;
    }

 </script>

<script>
    $('#check').click(function(){
    var txt = $('textarea#description').val();
    $('#newsDesctiption').summernote('code',txt); 
});

 var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
    };

    $(function() {
  var checkbox = $("#check"); 
  checkbox.change(function() {
    if (checkbox.is(':checked')) { 
      $('#title').prop('required', true); 
    } else { 
      $("#title").val("");
      $('#title').prop('required', false); 
    }
  });
});
</script>
@endpush
