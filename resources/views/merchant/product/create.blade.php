@extends('merchant.master')

@section('content')
@include('elements.alert')

    <!--  dashboard section start -->
    <section class="dashboard-section section-b-space">
        <div class="container">
            <div class="row">
                @include('layouts.inc.sidebar.vendor-sidebar',[$active ='product'])
                <div class="col-sm-9">
                    <h2 id="heading">Add Product</h2>
                    <form id="msform" action="{{ url('merchant/product/') }}" method="post"  enctype="multipart/form-data" id="validateForm">
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
                                @include('merchant.product.productBasicinfo')
                                @include('merchant.product.productAttributes')
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
                                        <textarea class="form-control summernote"  id="description" name="description"></textarea>
                                        <span class="text-danger" id="message_description"></span>
                                        @if ($errors->has('description'))
                                            <span class="text-danger">{{ $errors->first('description') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="made_in" class="">What in the box<span class="text-danger"> *</span></label>
                                        <input type="text" class="form-control" name="made_in" id="made_in" required="">
                                        <span class="text-danger" id="message_made_in"></span>
                                        @if ($errors->has('made_in'))
                                            <span class="text-danger">{{ $errors->first('made_in') }}</span>
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
                                        <div class="form-group row">
                                            <label for="model_no" class="col-xl-3 col-md-4">Model No<span>*</span></label>
                                            <input type="text" class="form-control col-md-8" name="model_no" id="model_no"  required="">
                                            <label for="model_no" class="col-xl-3 col-md-4"><span></span></label>
                                            <span class="text-danger" id="message_model_no"></span>
                                            @if ($errors->has('model_no'))
                                                <span class="text-danger">{{ $errors->first('model_no') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group row margin">
                                            <label for="materials" class="col-xl-3 col-md-4">Materials<span>*</span></label>
                                            <input type="text" class="form-control col-md-8" name="materials" id="materials"  required="">
                                            <label for="model_no" class="col-xl-3 col-md-4"><span></span></label>
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
                                            <label for="price" class="col-xl-3 col-md-4">MRP<span>*</span></label>
                                            <input type="number" class="form-control col-md-8" name="price" id="price" required="">
                                            <label for="model_no" class="col-xl-3 col-md-4"><span></span></label>
                                            <span class="text-danger" id="message_price"></span>
                                            @if ($errors->has('price'))
                                                <span class="text-danger">{{ $errors->first('price') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group row margin">
                                            <label for="org_price" class="col-xl-3 col-md-4">Seling Price<span>*</span></label>
                                            <input type="number" class="form-control col-md-8" name="org_price" id="org_price" required="">
                                            <label for="model_no" class="col-xl-3 col-md-4"><span></span></label>
                                            <span class="text-danger" id="message_org_price"></span>
                                            @if ($errors->has('org_price'))
                                                <span class="text-danger">{{ $errors->first('org_price') }}</span>
                                            @endif
                                        </div>
                                        <!-- <div class="form-group row margin">
                                            <label for="min_order" class="col-xl-3 col-md-4">Minimum Order <span>*</span></label>
                                            <input type="number" class="form-control col-md-8" name="min_order" id="min_order"  required="">
                                            <label for="model_no" class="col-xl-3 col-md-4"><span></span></label>
                                            <span class="text-danger" id="message_min_order"></span>
                                            @if ($errors->has('min_order'))
                                                <span class="text-danger">{{ $errors->first('min_order') }}</span>
                                            @endif
                                        </div> -->
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

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

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


</style>
@endpush
@push('js') 
<!-- <script src="{{ asset('js/summernote.min.js') }}"></script> -->

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

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
        err = checkeEmpty('video_url');
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
