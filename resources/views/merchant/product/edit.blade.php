@extends('merchant.master')

@section('content')

@include('elements.alert')

    <!--  dashboard section start -->
    <section class="dashboard-section section-b-space">
        <div class="container">
            <div class="row">
                @include('layouts.inc.sidebar.vendor-sidebar',[$active ='product'])
                <!-- address section start -->
                <div class="col-sm-9 register-page container">
                    <h3>Edit Product {{$product->id}}</h3>
                    <form class="theme-form" action="{{ url('merchant/e-commerce/products/update/'.$product->slug) }}" method="post"  enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div>
                                @include('merchant.product.productBasicinfoEdit')
                            @if($product->item_meta->count())
                                @include('merchant.product.productAttributesEdit')
                                <input type="hidden" name="email" value="{{ $product->email }}"> 
                            @endif
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
                                    <label for="made_in" class="">What in the box<span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" name="made_in" id="made_in" value="{{ $product->made_in }}" required="">
                                    <span class="text-danger" id="message_made_in"></span>
                                    @if ($errors->has('made_in'))
                                        <span class="text-danger">{{ $errors->first('made_in') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div>
                            @include('merchant.product.priceAndstockEdit')
                        </div>
                        <div class="card mb-4">
                            <h5 class="card-header">Tag & Model</h5>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="tag_id" class="col-xl-3 col-md-4">Tag <span>*</span></label>
                                    <div class="col-md-8 multiple-tag">
                                        <select class="js-example-basic-multiple form-control" name="tag_id[]" id="tad_id"  multiple="multiple">
                                            @foreach ($tag as $row)
                                            @if(in_array($row->name,$selected_tags))
                                                <option value="{{ $row->name }}">{{$row->name." "}}</option>
                                            @else 
                                            <option value="{{ $row->name }}" selected="true">{{$row->name}}</option>   
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label for="model_no" class="col-xl-3 col-md-4">Model No<span>*</span></label>
                                    <input type="text" class="form-control col-md-8" name="model_no" id="model_no" value="{{ old('model_no',$product->model_no) }}"  required="">
                                    <label for="model_no" class="col-xl-3 col-md-4"><span></span></label>
                                    <span class="text-danger" id="message_model_no"></span>
                                    @if ($errors->has('model_no'))
                                        <span class="text-danger">{{ $errors->first('model_no') }}</span>
                                    @endif
                                </div>
                                <div class="form-group row margin">
                                    <label for="materials" class="col-xl-3 col-md-4">Materials<span>*</span></label>
                                    <input type="text" class="form-control col-md-8" name="materials" id="materials" value="{{ old('materials',$product->materials) }}" required="">
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
                                    <label for="price" class="col-xl-3 col-md-4">Price<span>*</span></label>
                                    <input type="number" class="form-control col-md-8" name="price" id="price" value="{{ old('price',$product->price) }}" required="">
                                    <label for="model_no" class="col-xl-3 col-md-4"><span></span></label>
                                    <span class="text-danger" id="message_price"></span>
                                    @if ($errors->has('price'))
                                        <span class="text-danger">{{ $errors->first('price') }}</span>
                                    @endif
                                </div>
                                <div class="form-group row margin">
                                    <label for="org_price" class="col-xl-3 col-md-4">Orginal Price<span>*</span></label>
                                    <input type="number" class="form-control col-md-8" name="org_price" id="org_price" value="{{ old('org_price',$product->org_price) }}" required="">
                                    <label for="model_no" class="col-xl-3 col-md-4"><span></span></label>
                                    <span class="text-danger" id="message_org_price"></span>
                                    @if ($errors->has('org_price'))
                                        <span class="text-danger">{{ $errors->first('org_price') }}</span>
                                    @endif
                                </div>
                                <!-- <div class="form-group row margin">
                                    <label for="min_order" class="col-xl-3 col-md-4">Minimum Order <span>*</span></label>
                                    <input type="number" class="form-control col-md-8" name="min_order" id="min_order" value="{{ old('min_order',$product->min_order) }}" required="">
                                    <label for="model_no" class="col-xl-3 col-md-4"><span></span></label>
                                    <span class="text-danger" id="message_min_order"></span>
                                    @if ($errors->has('min_order'))
                                        <span class="text-danger">{{ $errors->first('min_order') }}</span>
                                    @endif
                                </div> -->
                            </div>
                        </div> 
                        {{-- <div class="col-md-12"> --}}
                            <button class="btn btn-sm btn-solid" type="submit">Update</button>
                        {{-- </div> --}}
                    </form>
                </div>
                             
            </div>
        </div>
    </section>
    <!-- section end -->
@endsection
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
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
    </style>
@endpush
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 300,
            });
        });
        $('.js-example-basic-multiple').select2();

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

