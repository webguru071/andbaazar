
@extends('merchant.master')
@section('content')
@push('css')
<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
{{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> --}}
{{-- <link href="{{ asset('material') }}/css/select2.min.css" rel="stylesheet" /> --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />


<style>
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
  width: 975px !important;
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
            background: #ddd;
            border-left: 2px solid red !important;
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

       /* Iamge */
       .h-100{
            height: 100px !important;
            margin: 4px;
        }
        .drop-area{
            display: flex;
            padding: 10px;
            background: #fdfbfb;
            cursor: pointer;
            border: 2px dashed #ddd !important
        }
        .drop-single{
            border: 1px solid #ddd;
            padding: 5px;
            margin: 5px;
            background: #fff;
            cursor: move;
        }
        .dz-message{
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .dz-message h2{
            color: #b7b0b0;
            font-weight: 1000;
            font-size: 24px;
        }
        .collpanel{
            /* width: 672px; */
            width:100%;
            height: 250px;
        }
        input[type=text],input[type=number],select,.input-group-text,.h-40{
            height: 40px !important;
        }
        .rowRemove{
            line-height: 26px;
        }
        .ui-sortable-placeholder { height: 125px; width: 125px; border: 1px dashed; line-height: 1.2em; }

        /* button */
        .custom{
          width: 108px;
          height:50px;
        }
        .multepale-select{
            padding-bottom: 100px!important;
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
        /* border: 1px solid #ccc; */
        display: inline-block;
        padding: 9px 40px;
        cursor: pointer;
        border-top: 0px;
    }
</style>

@endpush
@include('elements.alert')


<section class="dashboard-section section-b-space">
    <div class="container">
        <div class="row">
            @include('layouts.inc.sidebar.vendor-sidebar',[$active ='krishi'])
            <div class="col-md-9">
                <h3>Edit Krishi Product</h3>
                <form action="{{url('merchant/krishi/products/updat/'.$krishiproduct->slug)}}" method="POST"  class="form" id="validateForm" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                     <div class="card mb-4">
                        <h5 class="card-header">Krishi information</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">Product Name <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" class="form-control" name="name" value="{{ old('name',$krishiproduct->name) }}" id="name" />
                                                <span class="text-danger" id="message_name"></span>
                                                @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Category Name<span class="text-danger"> *</span></label> <span class="text-danger">{{ $errors->first('category_slug') }}</span>
                                        <input type="text" readonly class="form-control @error('category') border-danger @enderror" required name="category" value="{{ $krishiproduct->category['name'] }}" id="category" placeholder="Category">
                                        <span class="text-danger" id="message_category"></span>
                                        <input type="hidden" name="category_id" id="category_id" value="{{ old('category_id',$krishiproduct->category_id) }}">
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
                                        <label for="picture">Thumbnail Image</label>
                                        <div class="mt-0">
                                            <img id="output"  class="imagestyle" src="{{ (!is_null($krishiproduct->thumbnail_image)) ? asset($krishiproduct->thumbnail_image) : asset('/images/demo-product.jpg') }}" />
                                        </div>
                                        <div class="uploadbtn">
                                            <label for="img-upload" class="custom-file-upload image-upload"><i aria-hidden="true"></i> Upload Here</label>
                                            <input id="img-upload" accept="image/*"  class ="d-none" type="file" name="picture"/>
                                            <div id="loader" class=""></div>
                                        </div>
                                        <input type="hidden" name="thumbnail_image" id="thumbnail_image">
                                    </div>
                                    <div class="form-group">
                                        <div id="dropzone-main" class="img-upload-area" data-color="main"><label>Product Images<span class="text-danger" id="message_main_img"></span></label>
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
                                        <div class="col-md-6">
                                            <div class="form-group margin">
                                                <label for="available_from">Product Available From<span class="text-danger"> *</span></label> <span class="text-danger">{{ $errors->first('available_from') }}</span>
                                                <input type="text"  class="form-control inputfield  @error('available_from') border-danger @enderror datepickerPreviousOnly" required name="available_from" value="{{ $krishiproduct->available_from }}"   id="available_from" placeholder="YYYY/MM/DD" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group margin">
                                                <label class="available_for">Available For (Days)</label>
                                                <input type="number" class="form-control" name="available_for" id="available_for" placeholder="30" value="{{ \Carbon\Carbon::parse($krishiproduct->available_from) ->diffInDays(\Carbon\Carbon::parse($krishiproduct->available_to)) }}" />
                                                @if ($errors->has('available_for'))
                                                    <span class="text-danger">{{ $errors->first('available_for') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group margin">
                                                <label for="productUnit">Product Unit<span class="text-danger"> *</span></label>
                                                <select class="form-control" id="productUnit" name="product_unit_id" required>
                                                    <option value="">-- Select Unit --</option>
                                                    @foreach($productUnits as $productUnit)
                                                        <option value="{{ $productUnit->id }}" {{ ($krishiproduct->product_unit_id == $productUnit->id) ? 'selected' : '' }}>{{ $productUnit->name .' (' .$productUnit->symbol .')' }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group margin">
                                                <label class="availableStock">Available Stock (Quantity)<span class="text-danger"> *</span></label>
                                                <input type="number" class="form-control" name="available_stock" id="availableStock" placeholder="400" value="{{ $krishiproduct->available_stock }}" required/>
                                                @if ($errors->has('available_stock'))
                                                    <span class="text-danger">{{ $errors->first('available_stock') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group margin">
                                                <label class="allowCustomOffer">Allow Custom Offer<span class="text-danger"> *</span></label>
                                                <select class="form-control" id="allowCustomOffer" name="allow_custom_offer" required>
                                                    <option value="1" {{ ($krishiproduct->allow_custom_offer == 1) ? 'selected' : '' }}>Yes</option>
                                                    <option value="0" {{ ($krishiproduct->allow_custom_offer == 0) ? 'selected' : '' }}>No</option>
                                                </select>
                                                @if ($errors->has('allow_custom_offer'))
                                                    <span class="text-danger">{{ $errors->first('allow_custom_offer') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="videoUrl" class="">Youtube Video URL (optional)</label>
                                        <textarea class="form-control" rows="2" id="videoUrl" name="video_url" placeholder="Paste your link here ...">{{ $krishiproduct->video_url }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="">Description<span class="text-danger"> *</span></label>
                                        <textarea class="form-control summernote" id="description" name="description">{{ $krishiproduct->description }}</textarea>
                                        <span class="text-danger" id="message_description"></span>
                                        @if ($errors->has('description'))
                                            <span class="text-danger">{{ $errors->first('description') }}</span>
                                        @endif
                                    </div>
                                    {{-- {{dd($frequencyname)}} --}}
                                    <div class="form-group form-unit form-divided">
                                        <label for="frequency" class="form-input-label pr-5">Frequency:</label><br>
                                        <select class="js-example-basic-multiple" name="frequency[]" multiple="multiple">
                                            <option value="sunday" {{in_array('sunday',$frequencyname) ? 'selected' : ''}}>Sunday</option>
                                            <option value="monday" {{in_array('monday',$frequencyname) ? 'selected' : ''}}>Monday</option>
                                            <option value="tuesday" {{in_array('tuesday',$frequencyname) ? 'selected' : ''}}>Tuesday</option>
                                            <option value="wednessday" {{in_array('wednessday',$frequencyname) ? 'selected' : ''}}>Wednessday</option>
                                            <option value="thursday" {{in_array('thursday',$frequencyname) ? 'selected' : ''}}>Thursday</option>
                                            <option value="friday" {{in_array('friday',$frequencyname) ? 'selected' : ''}}>Friday</option>
                                            <option value="saturday" {{in_array('saturday',$frequencyname) ? 'selected' : ''}}>Saturday</option>
                                            <option value="everyday" {{in_array('everyday',$frequencyname) ? 'selected' : ''}}>Everyday</option>
                                            <option value="weekly" {{in_array('weekly',$frequencyname) ? 'selected' : ''}}>Weekly</option>
                                            <option value="fortnightly" {{in_array('fortnightly',$frequencyname) ? 'selected' : ''}}>Fortnightly</option>
                                            <option value="monthly" {{in_array('monthly',$frequencyname) ? 'selected' : ''}}>Monthly</option>
                                        </select>
                                      </div>
                                    <div class="form-group">
                                        <label for="returnPolicy" class="">Return Policy (if any)</label>
                                        <textarea class="form-control" rows="3" id="returnPolicy" name="return_policy" placeholder="Your custom return policy ...">{{ $krishiproduct->return_policy }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-success custom float-right ml-2 w-5"  type="submit">Update</button>
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
<script src="{{ asset('js/jquery-ui.js') }}"></script>
{{-- <script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script> --}}
<script src="{{ asset('js/dropzone.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> --}}
{{-- <script src="{{ asset('material') }}/js/select2.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
<script src="https://foliotek.github.io/Croppie/croppie.js"></script>
    <script>
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
                // getInventoryAttr(id);
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

        $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
// $('.js-example-basic-single').select2();

    </script>

    {{-- Summer Note --}}
    <script>
        $(document).ready(function() {
     $('.summernote').summernote({
           height: 150,
      });
   });
    </script>
  {{-- Image --}}
    <script>
        //Rendering Main images into Dropzone
        $( "#sortable-main" ).sortable({
            placeholder: "ui-state-highlight",
            revert: true,
        });
        $("#sortable-main").disableSelection();
        // setup("my-awesome-dropzone-main",'main');
        var mockFile = [];
        @foreach($itemImages as $img)
            mockFiles = {
                name:'img-'+'product-image',
                size:{{$img->id}},
                dataURL: "{{asset('/')}}"+"{{$img->org_img}}"
            }
            mockFile.push(mockFiles);
        @endforeach
        setup("my-awesome-dropzone-main",'main',mockFile);

        //Rendering Other images into Dropzone
{{--        @foreach($itemImages as $color=>$imges)--}}
{{--        mockFile = [];--}}

{{--        @foreach($imges as $img)--}}
{{--            mockFiles = {--}}
{{--                name:'img-'+'{{$img->color_slug}}',--}}
{{--                size:{{$img->id}},--}}
{{--                dataURL: "{{asset('/')}}"+"{{$img->org_img}}"--}}
{{--            }--}}
{{--            mockFile.push(mockFiles);--}}
{{--        @endforeach--}}
{{--        @if($color != 'main')--}}
{{--            appendDrops('{{$color}}',mockFile);--}}
{{--            mockFile = [];--}}
{{--        @endif--}}
{{--        @endforeach--}}

        //Drug & Drop script start
        $( "#sortable-red").sortable({
            placeholder: "ui-state-highlight",
            revert: true,
        });

        //dropzone scripts
        $('#selectColor').change(function(){
            var flag = 0;
            var color = $(this).val();
            $('.img-upload-area').each(function(){
                if(color == $(this).data('color')){
                    flag = 1;
                }
            });
            if(flag == 0){
                appendDrops(color);
            }else{
                swal("The selected color already been exits", {icon: "warning",buttons: false,timer: 2000});
            }
        });
        function appendDrops(color,mockFile=''){
            $('.drops').append(
                    `<div id="dropzone-${color}" class="img-upload-area" data-color="${color}"><label class="mt-3">Color Family: <b>${color}</b></label>
                    <span class="btn btn-sm text-danger" onclick="removeColorItem('${color}')"><i class="fa fa-trash"></i></span>
                    <div class="border m-0 collpanel drop-area row my-awesome-dropzone${color}" id="sortable-${color}">
                        <span class="dz-message color-${color}">
                            <h2>Drag & Drop Your Files</h2>
                        </span>
                    </div>
                    <small>Remember Your featured file will be the first one.</small><br></div>`
                );
                $( "#sortable-"+color ).sortable({
                    placeholder: "ui-state-highlight",
                    revert: true,
                });
                $("#sortable-"+color ).disableSelection();
                setup("my-awesome-dropzone"+color,color,mockFile);
                inventoryRows(color);
        }

        Dropzone.autoDiscover = false;


        //function
        function setup(id,color,mockFile='') {
            let options = {
                autoProcessQueue: false,
                url : '/',
                thumbnailHeight: 200,
                thumbnailWidth: 300,
                maxFilesize: 100,
                maxFiles: 5,
                dictResponseError: "Server not Configured",
                dictFileTooBig: "File too big. Must be less than ",
                dictCancelUpload: "",
                acceptedFiles: ".png,.jpg,.jpeg",
                init: function() {

                    var self = this;

                    // self.on("addedfile", function(file) {
                    //     $('.color-'+color).addClass('d-none');
                    // });

                    self.on("dragenter", function(event) {
                        $('#sortable-'+color).css('background-color','#fff');
                    });
                    self.on("dragleave", function(event) {});

                    self.on("thumbnail", function(file){
                        // console.log(file);
                        var i = 0;
                        $('.color-'+color+'-element').each(function(){
                            i = i+1;
                        });
                        if(i > 5){
                            swal("Maximum Five file are allowed", {icon: "warning",buttons: false,timer: 2000});
                            this.removeFile(file);
                            $('#id'+file.size).remove();
                        }

                        if(file.size < 3000000){
                            $('.inputs').append(`<input type="hidden" class="image-class-${color}" name="images[${color}][]" id="id${file.size}" value="${file.dataURL}">`);
                        }else{
                            swal("Maximum size reached", {icon: "warning",buttons: false,timer: 2000});
                            this.removeFile(file);
                        }
                    });

                    self.on("removedfile", function(file) {
                        var i = 0;
                        $('.color-'+color+'-element').each(function(){
                            i = i+1;
                        });
                        if(i === 0){
                            $('.color-'+color).removeClass('d-none');
                        }
                        $('#id'+file.size).remove();
                    });

                    // Send file starts
                    self.on("sending", function(file) {
                        // console.log("upload started", file);
                    });

                    self.on("complete", function(file, response) {
                        if (file.name !== "442343.jpg") {
                            //this.removeFile(file);
                        }
                    });

                    self.on("maxFilesize", function(file, response) {
                        swal("Maximum size reached", {icon: "warning",buttons: false,timer: 2000});
                        this.removeFile(file);
                    });

                    self.on("maxfilesexceeded", function(file, response) {
                        swal("Maximum file reached", {icon: "warning",buttons: false,timer: 2000});
                        this.removeFile(file);
                    });

                    self.on("addedfile", function(file) {
                        const pattern = /\d{6}(\.)(jpg|jpeg|png)/;
                        if (!pattern.test(file.name)) {
                            //   this.removeFile(file);
                        }
                    });


                    // Create the mock file:
                    // var mockFile = [
                    //     { name: "Filename", size: 12345 , dataURL:"http://localhost/andbaazar/public/uploads/shops/logos/shop-4.png"},
                    //     { name: "Filename", size: 12345 , dataURL:"http://localhost/andbaazar/public/uploads/shops/logos/shop-4.png"}
                    // ];

                    if(mockFile != ''){
                        mockFile.forEach(mockFile=>{
                            self.emit("addedfile", mockFile);
                            self.emit("thumbnail", mockFile, mockFile.dataURL);
                        });
                    }

                },

                previewTemplate: `
                <div class="drop-single color-${color}-element ui-state-default">
                <a href="javascript:undefined;" data-dz-remove=""><i class="fa fa-trash-o"></i>&nbsp;<span>Remove</span></a>
                <br/>
                <span class="dz-upload" data-dz-uploadprogress></span>
                <img class="h-100" data-dz-thumbnail/>
                </div>`
            };
            var myDropzone = new Dropzone(`.${id}`, options);
        };

        $(document).ready(function() {

    $(".js-example-basic-multiple").select2({
        placeholder: "Select Frequency"
    }).on('change', function(e) {
        if($(this).val() && $(this).val().length) {
                $(this).next('.select2-container')
            .find('li.select2-search--inline input.select2-search__field').attr('placeholder', 'Select Frequency');
        }
    });
    });
    </script>

    {{--    Start Product Thumbnail Image Croping  --}}
    <script>
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
    </script>
    {{--    End Product Thumbnail Image Croping  --}}
@endpush






