@extends('merchant.master')

@section('content')

@include('elements.alert')

    <!--  dashboard section start -->
    <section class="dashboard-section section-b-space">
        <div class="container">
            <div class="row">

            @include('layouts.inc.sidebar.vendor-sidebar',[$active ='smeProduct'])

                <!-- address section start -->
                <div class="col-sm-9 register-page container">
                        <h3>Edit SME Product</h3>
                            <form class="theme-form" action="{{ url('merchant/products/update/'.$product->slug) }}" method="post"  enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div>
                                        @include('merchant.product.smeProduct.productBasicinfoEdit')                            
                                        <input type="hidden" name="email" value="{{ $product->email }}"> 
                                </div>
                                <div class="card mb-4">
                                    <h5 class="card-header">Detailed Description</h5>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="bn_description" class="">Description (Bangla)<span class="text-danger"> *</span></label>
                                            <textarea class="form-control  summernote"  id="bn_description"  name="bn_description">{{ $product->bn_description }}</textarea>
                                            <span class="text-danger" id="message_bn_description"></span>
                                            @if ($errors->has('bn_description'))
                                                <span class="text-danger">{{ $errors->first('bn_description') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="description" class="">Description (English)</label>
                                            <textarea class="form-control  summernote"  id="description" name="description">{{ $product->description }}</textarea>
                                            <span class="text-danger" id="message_description"></span>
                                            @if ($errors->has('description'))
                                                <span class="text-danger">{{ $errors->first('description') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <!-- <label for="made_in" class="">What in the box<span class="text-danger"> *</span></label>
                                            <input type="text" class="form-control" name="made_in" id="made_in" value="{{ $product->made_in }}" required=""> -->
                                            <span class="text-danger" id="message_made_in"></span>
                                            @if ($errors->has('made_in'))
                                                <span class="text-danger">{{ $errors->first('made_in') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    @include('merchant.product.smeProduct.priceAndstockEdit')
                                </div>
                                <div class="card mb-4">
                                    <h5 class="card-header">Tag & Model</h5>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="tag_id" class="col-xl-3 col-md-4">Tag <span>*</span></label>
                                            <div class="col-md-8 multiple-tag">                                               
                                                <select class="js-example-basic-multiple form-control" name="tag_id[]" id="tad_id" multiple="multiple" required>
                                                    @foreach ($tag as $row)
                                                    @if(in_array($row->name,$selected_tags))
                                                        <option value="{{ $row->name }}">{{$row->name." "}}</option>
                                                    @else 
                                                    <option  value="{{ $row->name }}" selected="true">{{$row->name}}</option>   
                                                    @endif
                                                    @endforeach
                                                </select>
                                                {{-- <select class="js-example-basic-multiple form-control" name="tag_id[]" id="tad_id"  multiple="multiple">
                                                    @foreach ($tag as $row)
                                                    @if(in_array($row->name,$selected_tags))
                                                        <option value="{{ $row->name }}">{{$row->name." "}}</option>
                                                    @else 
                                                    <option value="{{ $row->name }}" selected="true">{{$row->name}}</option>   
                                                    @endif
                                                    @endforeach
                                                </select> --}}
                                            </div>
                                        </div>                                     
                                        <div class="form-group row margin">
                                            <label for="materials" class="col-xl-3 col-md-4">Materials<span>*</span></label>
                                            <input type="text" class="form-control col-md-8" name="materials" id="materials" value="{{ old('materials',$product->materials) }}" required="">
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
                                            <label for="price" class="col-xl-3 col-md-4">MRP<span>*</span></label>
                                            <input type="number" class="form-control col-md-8" name="price" id="price" value="{{ old('price',$product->price) }}" required="">
                                            <label for="model_no" class="col-xl-3 col-md-4"><span></span></label>
                                            <span class="text-danger" id="message_price"></span>
                                            @if ($errors->has('price'))
                                                <span class="text-danger">{{ $errors->first('price') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group row margin">
                                            <label for="org_price" class="col-xl-3 col-md-4">Selling Price<span>*</span></label>
                                            <input type="number" class="form-control col-md-8" name="org_price" id="org_price" value="{{ old('org_price',$product->org_price) }}" required="">
                                            <label for="model_no" class="col-xl-3 col-md-4"><span></span></label>
                                            <span class="text-danger" id="message_org_price"></span>
                                            @if ($errors->has('org_price'))
                                                <span class="text-danger">{{ $errors->first('org_price') }}</span>
                                            @endif
                                        </div>                  
                                    </div>
                                </div> 
                                <div class="col-md-12">
                                    <button class="btn btn-sm btn-solid" type="submit">Update</button>
                                </div>
                                </form>
                            </div>
                             
                        </div>
                    </div>
                </section>
    <!-- section end -->
@endsection
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
    <style>
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
    padding:0px;
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
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 300,
            });
        });
        $('.js-example-basic-multiple').select2();
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
</script>
    
@endpush

