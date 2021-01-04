@extends('merchant.master')
@section('content')
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
            #catarea{
                background: #fff;
                border: 1px solid #ddd;
                width: 97%;
            }
            .cat-level ul li {
                display: inherit;
                padding: 5px;
                cursor: pointer;
                border-left: 2px solid #fff;
                margin: 2px;
            }
            .cat-level ul li:hover,.active{
                /*background: #ddd;*/
                /*border-left: 2px solid red !important;*/
            }
            .cat-level{
                border: 1px solid #ddd;
            }
            .cat-levels{
                height: 250px;
                overflow-y: scroll;
            }
            .cat-level input[type=text]{
                height: 40px;
            }
            .foo {
                position: absolute;
                background-color: white;
                width: 5em;
                z-index: 100;
            }
            .scroll {
                overflow-x: auto;
            }
            .readonly {
                opacity: .5;
                cursor: not-allowed !important;
            }     
            input[type=text],input[type=number],select,.input-group-text,.h-40{
                height: 40px !important;
            }
            /* Thumbnail Image Upload*/
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
                display: inline-block;
                padding: 9px 40px;
                cursor: pointer;
                border-top: 0px;
            }
        </style>
    @endpush
    @include('elements.alert')
    @include('elements.dropzone')
    <section class="dashboard-section section-b-space">
        <div class="container">
            <div class="row">
                @include('layouts.inc.sidebar.vendor-sidebar',[$active ='krishi'])
                <div class="col-md-9">
                    <h3>Add Krishi Product</h3>
                    <form action="{{route('krishiproductstore')}}" method="POST"  class="form" id="validateForm" enctype="multipart/form-data">
                        @csrf
                        <div class="card mb-4">
                            <h5 class="card-header">Krishi information</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">

                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="picture">Thumbnail Image</label>
                                                    <div class="mt-0">
                                                        <img id="output"  class="imagestyle" src="{{ asset('/images/demo-product.jpg') }}" />
                                                    </div>
                                                    <div class="uploadbtn">
                                                        <label for="img-upload" class="custom-file-upload image-upload"><i aria-hidden="true"></i> Upload Here</label>
                                                        <input id="img-upload" accept="image/*"  class ="d-none" type="file" name="picture"/>
                                                        <div id="loader" class=""></div>
                                                    </div>
                                                    <input type="hidden" name="thumbnail_image" id="thumbnail_image">
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label for="name">Product Name <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" class="form-control" name="name" value="{{ old('name') }}" id="name" placeholder="Tomato"/>
                                                    <span class="text-danger" id="message_name"></span>
                                                    @if ($errors->has('name'))
                                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                                <div class="row">
                                                    <div class="form-group margin col-md-4">
                                                        <label for="available_from">Product Available From<span class="text-danger"> *</span></label> <span class="text-danger">{{ $errors->first('available_from') }}</span>
                                                        <input type="text"  class="form-control inputfield  @error('available_from') border-danger @enderror datepickerNexDayOnly" required name="available_from" value="{{ old('available_from') }}"   id="available_from" placeholder="YYYY/MM/DD" autocomplete="off">
                                                    </div>
                                                    <div class="form-group margin col-md-4">
                                                        <label class="available_for">Estimate Available For Days</label>
                                                        <input type="number" class="form-control" name="available_for" id="available_for" placeholder="30" />
                                                        @if ($errors->has('available_for'))
                                                            <span class="text-danger">{{ $errors->first('available_for') }}</span>
                                                        @endif
                                                    </div>
                                                        <div class="form-group margin col-md-4">
                                                            <label class="availableStock">Available Stock (Quantity)<span class="text-danger"> *</span></label>
                                                            <input type="number" class="form-control" name="available_stock" id="availableStock" placeholder="400" required/>
                                                            @if ($errors->has('available_stock'))
                                                                <span class="text-danger">{{ $errors->first('available_stock') }}</span>
                                                            @endif
                                                        </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group margin col-md-4">
                                                        <label for="regular_price">Product Price <span class="text-danger"> *</span></label> <span class="text-danger">{{ $errors->first('regular_price') }}</span>
                                                        <input type="number"  class="form-control inputfield  @error('regular_price') border-danger @enderror " required name="regular_price" value="{{ old('regular_price') }}"   id="regular_price" placeholder="price" autocomplete="off">
                                                    </div>
                                                    <div class="form-group margin col-md-4">
                                                        <label for="productUnit">Product Unit<span class="text-danger"> *</span></label>
                                                        <select class="form-control" id="productUnit" name="product_unit_id" required>
                                                            <option value="">-- Select Unit --</option>
                                                            @foreach($productUnits as $productUnit)
                                                                <option value="{{ $productUnit->id }}">{{ $productUnit->bn_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group margin col-md-4">
                                                        <label for="productUnit">Whole Sale Support</label>
                                                        <select class="form-control" id="productUnit" name="product_unit_id" required>
                                                            <option value="">No</option>
                                                            <option value="">Yes</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Category Name<span class="text-danger"> *</span></label> <span class="text-danger">{{ $errors->first('name') }}</span>
                                            <input type="text" readonly class="form-control @error('category') border-danger @enderror" required name="category" value="{{ old('name') }}" id="category" placeholder="Select Category">
                                            <span class="text-danger" id="message_category"></span>
                                            <input type="hidden" name="category_id" id="category_id">
                                            <div class="position-absolute foo p-3" id="catarea" style="display: none">
                                                <div class="categories search-area d-flex scroll border">
                                                    <div class="col-md-3 cat-level p-2 level-1">
                                                        <input type="text" class="form-control" onkeyup="categorySearch(1,this)" placeholder="search">
                                                        <ul class="cat-levels" id="">
                                                            @foreach ($categories as $row)
                                                            <li onclick="getNextLevel({{$row->id}},1,this)" value="{{ $row->id }}">{{$row->name}} <span class="float-right"><i class="fa fa-chevron-right" aria-hidden="true"></i></span></li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="cat-footer p-2">
                                                    <p>Current Selection : <span class="currentSelection font-weight-bold"></span></p>
                                                    <span class="btn btn-sm btn-info m-1 readonly" id="confirm" data-category="" >Confirm</span>
                                                    <span class="btn btn-sm btn-warning m-1" id="close">Close</span>
                                                    <span class="btn btn-sm btn-danger m-1" id="clear">Clear</span>
                                                </div>
                                            </div>
                                        </div>

                                        

                                        <div class="form-group">
                                            <div id="dropzone-main" class="img-upload-area" data-color="main"><label>Product Images <span class="text-danger" id="message_main_img"></span></label>
                                                <div class="border m-0 collpanel drop-area row my-awesome-dropzone-main" id="sortable-main">
                                                    <span class="dz-message color-main">
                                                        <h2>Drag & Drop Your Files</h2>
                                                    </span>
                                                </div>
                                                <small>Remember Your featured file will be the first one.</small><br>
                                            </div>
                                            <div class="inputs"></div>
                                        </div>
                                        <div class="row">
                                            
                                            
                                            <div class="col-md-4">
                                                <div class="form-group margin">
                                                    <label class="allowCustomOffer">Allow Custom Offer<span class="text-danger"> *</span></label>
                                                    <select class="form-control" id="allowCustomOffer" name="allow_custom_offer" required>
                                                        <option value="1">Yes</option>
                                                        <option value="0">No</option>
                                                    </select>
                                                    @if ($errors->has('allow_custom_offer'))
                                                        <span class="text-danger">{{ $errors->first('allow_custom_offer') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="videoUrl" class="">Youtube Video URL (optional)</label>
                                            <textarea class="form-control" rows="2" id="videoUrl" name="video_url" placeholder="Paste your link here ..."></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="description" class="">Description<span class="text-danger"> *</span></label>
                                            <textarea class="form-control summernote" id="description" name="description"></textarea>
                                            <span class="text-danger" id="message_description"></span>
                                            @if ($errors->has('description'))
                                            <span class="text-danger">{{ $errors->first('description') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="form-input-label pr-5">Frequency :</label><br>
                                            <div class="ml-3" style="max-height: 200px; overflow-y: scroll;">
                                            <label for="sunday"><input type="checkbox" id="sunday" name="frequency[]" value="sunday"> &nbsp; Sunday </label> <br/>
                                            <label for="monday"><input type="checkbox" id="monday" name="frequency[]" value="monday"> &nbsp; Monday </label> <br/>
                                            <label for="tuesday"><input type="checkbox" id="tuesday" name="frequency[]" value="tuesday"> &nbsp; Tuesday </label><br/>
                                            <label for="wednessday"><input type="checkbox" id="wednessday" name="frequency[]" value="wednessday"> &nbsp; Wednessday </label><br/>
                                            <label for="thursday"><input type="checkbox" id="thursday" name="frequency[]" value="thursday"> &nbsp; Thursday </label><br/>
                                            <label for="friday"><input type="checkbox" id="friday" name="frequency[]" value="friday"> &nbsp; Friday </label><br/>
                                            <label for="saturday"><input type="checkbox" id="saturday" name="frequency[]" value="saturday"> &nbsp; Saturday </label><br/>
                                            <label for="everyday"><input type="checkbox" id="everyday" name="frequency[]" value="everyday"> &nbsp; Everyday </label><br/>
                                            <label for="weekly"><input type="checkbox" id="weekly" name="frequency[]" value="weekly"> &nbsp; Weekly </label><br/>
                                            <label for="fortnightly"><input type="checkbox" id="fortnightly" name="frequency[]" value="fortnightly"> &nbsp; Fortnightly </label><br/>
                                            <label for="monthly"><input type="checkbox" id="monthly" name="frequency[]" value="monthly"> &nbsp; Monthly </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="returnPolicy" class="">Return Policy (if any)</label>
                                            <textarea class="form-control" rows="3" id="returnPolicy" name="return_policy" placeholder="Your custom return policy ..."></textarea>
                                        </div>
                                    </div>
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
                                                Are you want to publish product on news feed ? <input type="checkbox" name="allow_to_feed" value="1" id="check">
                                            </label>
                                        </div>
                                    </div>
                                    <div id="collapseable" aria-expanded="false" class="collapse">
                                        <div class="well">
                                            <div class="form-group row">
                                                <div class="col-md-6 text-left">
                                                    <label for="image">News feed Image</label> 
                                                    <div class="mt-0">
                                                        <img id="outputs"  class="imagestyle" src="{{ asset('/images/demo-product.jpg') }}" />
                                                    </div>
                                                    <div class="uploadbtn">
                                                        <label for="file-upload" class="custom-file-upload">Upload Here</label>
                                                        <input id="file-upload" type="file" name="feed_image" onchange="loadFile(event)"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="title" class="">Title <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="feed_title" id="title">
                                                <span class="text-danger" id="message_title"></span>
                                                @if ($errors->has('title'))
                                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                                                @endif 
                                            </div>
                                            <div class="form-group">
                                                <label for="news_desc" class="">Description<span class="text-danger"> *</span></label>
                                                <textarea class="form-control summernote"  id="newsDesctiption"  name="feed_desc"></textarea>
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
                        <button class="btn btn-success custom float-right ml-2 w-5"  type="submit">Save</button>
                    </form>
            </div>
            </div>
        </div>
    </section>

    {{--    Start Image Croping Modal --}}
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
    {{--    End Image Croping Modal --}}
@endsection
@push('js')
    <script src="https://foliotek.github.io/Croppie/croppie.js"></script>
    <script>
        //summernote
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 150,
            });
        });
        //category
        $('#category').click(function(){
            $('#catarea').toggle();
        });
        $('#close').click(function(){
            $('#catarea').hide();
        });

        function getNextLevel(val,level,e){
            setConfirm(val,level,e);
            // $('#confirm').addClass('readonly');
            // $('#confirm').attr('onclick','ConfirmCategory('+val+',this)');
            var nextLevel = level+1;
            var li ='';
            $.ajax({
                type:"get",
                url:"{{ url('/merchant/krishi/products/subCategoryChild/{id}') }}",
                data:{ 'subCatId': val },
                success:function(data){
                        li += `<div class="col-md-3 cat-level p-2 level-${nextLevel}">
                                    <input type="text" onkeyup="categorySearch(${nextLevel},this)" class="form-control" placeholder="search">
                                    <ul class="cat-levels sub">`;
                    for( var i=0; i<data.length; i++ ){
                        if(data[i].is_last == 1){
                            li += `<li onclick="setConfirm(${data[i].id},${nextLevel},this)">${data[i].name}</li>`;
                        }else{
                            li += `<li onclick="getNextLevel(${data[i].id},${nextLevel},this)">${data[i].name}<span class="float-right"><i class="fa fa-chevron-right" aria-hidden="true"></i></span></li>`;
                        }
                    }
                        li +=`</ul>
                                </div>`;

                    setActive(level,e);
                    $('.categories').append(li);
                    var far = $('.categories' ).width();
                    $('.categories').animate({scrollLeft:far},800);
                }
            })
        };

        function setConfirm(id,level,e){
            setActive(level,e);
            $('#confirm').attr('onclick','ConfirmCategory('+id+',this)');
            $('#confirm').removeClass('readonly');
        }

        function ConfirmCategory(id,e){
            if(id <= 0){
                alert('please select a category properly');
            }else{
                $('#category_id').val(id);
                $('#category').val($('.currentSelection').text());
                $('#catarea').hide();
                // getCategoryAttr(id);
                // getInventoryAttr(id);/
                // getBrands(id);
            }
        }

        function setActive(level,e){
            var current = '';
            for(var j = level+1; j<10 ; j++){
                $('.level-'+j).remove();
            }

            $('.col-md-3.cat-level.p-2.level-'+level+' ul li').each(function(){
                $(this).removeClass('active');
            })

            $(e).addClass('active');
            $('.col-md-3.cat-level.p-2 ul li.active').each(function(){
                current += $(this).text()+'/';
            })
            $('.currentSelection').html(current);

        }

        $('#clear').on('click',function(){
            for(var j = 2; j<10 ; j++){
                $('.level-'+j).remove();
            }
        });


        //search
        function categorySearch(level,e){
            var value = $(e).val();
            var patt = new RegExp(value, "i");

            $('.col-md-3.cat-level.p-2.level-'+level).find('li').each(function() {
                if($(this).text().search(patt) >= 0){
                    $(this).show();
                }else{
                    $(this).hide();
                }
            });

        };
        //image croping start (Start Product Thumbnail Image Croping)
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
                $('#thumbnail_image').val(resp);
                $('#output').attr('src',resp);
                $('#img-sidebar').attr('src',resp);
                $('#loader').removeClass('loader');
                $('#output').removeClass('opacity5');
                $('#img-sidebar').removeClass('opacity5');
            });
        });

        //news feed options
        var loadFile = function(event) {
            var output = document.getElementById('output');
            outputs.src = URL.createObjectURL(event.target.files[0]);
        };

        $('#check').click(function(){
            var txt = $('textarea#description').val();
            $('#newsDesctiption').summernote('code',txt); 
        });
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






