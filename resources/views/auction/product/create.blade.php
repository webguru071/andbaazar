
@extends('merchant.master')
@section('content')
@push('css')
<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<style>
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
</style>

@endpush
@include('elements.alert')


<section class="dashboard-section section-b-space">
    <div class="container">
        <div class="row">
            @include('layouts.inc.sidebar.vendor-sidebar',[$active ='auction'])
            <div class="col-md-9">
                <h3>Add Auction Product</h3>
                 <div class="card mb-4">
                    <h5 class="card-header">Auction information</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                            <form action="{{route('auctionstore')}}" method="POST" method="post" class="form" id="validateForm" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Product Name <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" class="form-control" name="name" value="{{ old('name') }}" id="name" />
                                            <span class="text-danger" id="message_name"></span>
                                            @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name">Category Name<span class="text-danger"> *</span></label> <span class="text-danger">{{ $errors->first('name') }}</span>
                                    <input type="text" readonly class="form-control @error('category') border-danger @enderror" required name="category" value="{{ old('name') }}" id="category" placeholder="Category">
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
                                    {{-- <div id="dropzone-main" class="img-upload-area" data-color="main">
                                        <label class="mt-3"><b>Images :</b><span class="text-danger" id="message_main_img"></span></label>
                                        <div class="border m-0 collpanel drop-area row my-awesome-dropzone-main" id="sortable-main">
                                            <span class="dz-message color-main">
                                                <h2>Drag & Drop Your Files</h2>
                                            </span>
                                        </div>
                                        <small>Remember Your featured file will be the first one.</small><br />
                                    </div> --}}
                                    <label for="color_id" class="col-xl-3 col-md-4"></label>
                                    <div id="dropzone-main" class="img-upload-area" data-color="main"><label class="mt-3"><b>Images :</b><span class="text-danger" id="message_main_img"></span></label>
                                        <div class="border m-0 collpanel drop-area row my-awesome-dropzone-main" id="sortable-main">
                                            <span class="dz-message color-main">
                                                <h2>Drag & Drop Your Files</h2>
                                            </span>
                                        </div>
                                        <small>Remember Your featured file will be the first one.</small><br>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="">Description<span class="text-danger"> *</span></label>
                                    <textarea class="form-control summernote" id="description" name="description"></textarea>
                                    <span class="text-danger" id="message_description"></span>
                                    @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>   
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group margin">
                                            <label for="qty">Quantity<span>*</span></label>
                                            <input type="number" class="form-control" name="qty" id="qty" />
                                            <span class="text-danger" id="message_qty"></span>
                                            @if ($errors->has('qty'))
                                            <span class="text-danger">{{ $errors->first('qty') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group margin">
                                            <label for="unit">Unit<span>*</span></label>
                                            <input type="text" class="form-control" name="unit" id="unit" />
                                            <span class="text-danger" id="message_unit"></span>
                                            @if ($errors->has('unit'))
                                            <span class="text-danger">{{ $errors->first('unit') }}</span>
                                            @endif
                                        </div>
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
@endsection
@push('js')
<script src="{{ asset('js/jquery-ui.js') }}"></script>
{{-- <script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script> --}}
<script src="{{ asset('js/dropzone.js') }}"></script>
    <script>
         $('#category').click(function(){
            $('#catarea').toggle();
        });
        $('#close').click(function(){
            $('#catarea').hide();
        });

        function getNextLevel(val,level,e){
            $('#confirm').addClass('readonly');
            $('#confirm').attr('onclick','ConfirmCategory(0,this)');
            var nextLevel = level+1;
            var li ='';
            $.ajax({
                type:"get",
                url:"{{ url('/merchant/e-commerce/products/subCategoryChild/{id}') }}",
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
                getCategoryAttr(id);
                getInventoryAttr(id);
                getBrands(id);
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

    </script>

    {{-- Summer Note --}}
    <script>
        $(document).ready(function() {
     $('.summernote').summernote({
           height: 300,
      });
   });
    </script>
  {{-- Image --}}
    <script>
          //Drug & Drop script start
        $( "#sortable-red").sortable({
            placeholder: "ui-state-highlight",
            revert: true,
        });

        Dropzone.autoDiscover = false;

        $( "#sortable-main" ).sortable({
            placeholder: "ui-state-highlight",
            revert: true,
        });
        $("#sortable-main").disableSelection();
        setup("my-awesome-dropzone-main",'main');

        //function
        function setup(id,color) {
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
                self.on("dragleave", function(event) {});

                // self.on("thumbnail", function(file){
                //     if(file.size < 3000000){
                //         $('.inputs').append(`<input type="hidden" class="image-class-${color}" name="images[${color}][]" id="id${file.size}" value="${file.dataURL}">`);
                //     }else{
                //         swal("Maximum size reached", {icon: "warning",buttons: false,timer: 2000});
                //         this.removeFile(file);
                //     }
                // });              

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
            },

            previewTemplate: `
                <div class="drop-single ui-state-default">
                <a href="javascript:undefined;" data-dz-remove=""><i class="fa fa-trash-o"></i>&nbsp;<span>Remove</span></a>
                <br/>
                <span class="dz-upload" data-dz-uploadprogress></span>
                <img class="h-100" data-dz-thumbnail/>
                </div>`
            };
            var myDropzone = new Dropzone(`.${id}`, options);
        }
    </script>
@endpush






