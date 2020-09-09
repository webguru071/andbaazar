
@extends('merchant.master')
@section('content')
@push('css')
<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
     .h-100{
            height: 70px !important;
            padding: 2px;
            width: 103px;
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
            width: 672px;
            height: 151px;
        }
        input[type=text],input[type=number],select,.input-group-text,.h-40{
            height: 40px !important;
        }
        .table td {
            padding: 0 !important;
        }
        .rowRemove{
            line-height: 26px;
        }
        .ui-sortable-placeholder { height: 125px; width: 125px; border: 1px dashed; line-height: 1.2em; }
    .inputfield{
        height: 45px!important;
    }
    .dropzone-previews { 
            width: 980px; 
        }
</style>
@endpush
@include('elements.alert')


<section class="dashboard-section section-b-space">
  <div class="container">
      <div class="row">
        @include('layouts.inc.sidebar.vendor-sidebar',[$active ='inventory'])
        <div class="col-md-9">
            <h3>Add E-commerce Inventory</h3>
            <div class="card">
                <div class="card-body">
                    <form class="theme-form" action="{{ route('inventory.store') }}" method="post" id="validateForm">
                        @csrf
                            <div class="form-row">
        
                                <div class="col-md-6">
                                    <label for="product_id">Product <span class="text-danger"> *</span></label><span class="text-danger">{{ $errors->first('product_id') }}</span>
                                    <select name="product_id" class="form-control px-10" id="product_id"  autocomplete="off">
                                        <option value="" selected disabled>Select Product</option>
                                        @foreach ($item as $row)
                                            <option  value="{{ $row->id }}" data-cat="{{ $row->category_id }}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
        
                                <div class="col-md-6"> 
                                    <label for="color_id"">Color<span class="text-danger"> *</span></label><span class="text-danger">{{ $errors->first('color_id') }}</span>
                                        <select name="color_name" autocomplete="off" class="form-control color_id" id="selectColor">
                                            <option value="">No Color</option>
                                            @foreach($color as $row)
                                                <option value="{{ $row->slug }}">{{ $row->name }}</option>
                                            @endforeach
                                    </select>
                                </div> 
                                <div class="col-md-12"> 
                                        <label for="" class="col-xl-3 col-md-8"></label>
                                        <div class="drops dropzone-previews"></div>
                                        <div class="inputs"></div> 
                                </div>
        
                                
                                <div class="col-md-12" id="Inventory-attr">
                                </div>


                                <div class="col-md-6 mt-1">
                                    <label for="price">Price <span class="text-danger"> *</span></label><span class="text-danger">{{ $errors->first('Price') }}</span>
                                    <input type="number" class="form-control inputfield" name="price" id="price" value="{{ old('price') }}">
                                </div>
                                <div class="col-md-6 mt-1">
                                    <label for="qty_stock">Stock Quantity <span class="text-danger"> *</span></label><span class="text-danger">{{ $errors->first('qty_stock') }}</span>
                                    <input type="number" class="form-control inputfield" name="qty_stock" id="qty_stock" value="{{ old('qty_stock') }}">
                                </div>
                                <div class="col-md-12 mt-2">
                                    <label for="seller_sku">SellerSku <span class="text-danger"></span></label><span class="text-danger">{{ $errors->first('seller_sku') }}</span>
                                    <input type="text" class="form-control inputfield" name="seller_sku" id="seller_sku" value="{{ old('seller_sku') }}">
                                </div>
                                <div class="col-md-12 mt-2">
                                    <h4>Special price (optional)</h4>
                                    <hr>
                                </div>
                                <div class="col-md-6">
                                    <label for="special_price">Special price</label>
                                    <input type="number" class="form-control inputfield" name="special_price" id="special_price" value="{{ old('special_price') }}">
                                </div>
        
                                <div class="col-md-6">
                                    <label for="" >Special price Period</label>
                                    <div class="input-group">
                                     <input type="text" id="spcial_price_start" name="start_date" class="datepickerRange form-control inputfield" value="{{ old('start_date') }}"><span class="input-group-addon p-2 bg-success bottom" >To</span><input type="text" id="spcial_price_end" name="end_date" class="datepickerRange form-control inputfield" value="{{ old('end_date') }}">
                                </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <button class="btn btn-sm btn-solid" type="submit">Save</button>
                                    <a href="{{ url('merchant/e-commerce/inventories') }}" class="btn btn-sm btn-solid">Back</a>
                                </div>
                            </div>
                        </form> 
                </div>  
            </div>         
        </div>
      </div>
   </div>
</section>
@endsection
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> 
<!-- <link rel="stylesheet" type="text/css" href="{{asset('css')}}/select2.min.css"> -->
@endpush
@push('js')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<!-- <script src="{{ asset('') }}/js/select2.min.js"></script> -->
    <script>

        $('#product_id').on('change',function () {
            var cat = $(this).find(':selected').data('cat');
            console.log(cat);
            $.ajax({
                type:'POST',
                url:"{{url('merchant/get-inventory-attr-new-Inventory')}}",
                data:{'cat_id':cat,'_token':'{{csrf_token()}}'},
                dataType:'json',
                success:function(data){
                    $('#Inventory-attr').html(data.option);
                }
            });
        });


        //dropzone scripts
        $('#selectColor').change(function(){
            var flag = 0;
            var color = $(this).val();
            var item = $('#product_id').val();
            // alert('hi');
            $.ajax({
                type:'GET',
                url:"{{url('merchant/inventories/inventorycolor')}}",
                data:{'color':color,'item':item},
                dataType:'json',
                success:function(data){
                    $('#droparea').show();
                    console.log(data);
                    if(data.count > 0){
                        $('.inputs').html('');
                        $('.drops').html(
                            `<div id="dropzone-${color}" class="img-upload-area" data-color="${color}"><label class="mt-3">Color Family: <b>${color}</b></label>
                           
                            <div class="border m-0 collpanel drop-area row my-awesome-dropzone${color} dropzone-previews" id="sortable-${color}">
                                <span class="dz-message color-${color}">
                                    <h2>Drag & Drop Your Files</h2>
                                </span>
                            </div>
                            <small>Remember Your featured file will be the first one.</small><br></div>`
                        );
                        $( "#sortable-"+color ).sortable({
                            placeholder: "ui-state-highlight",
                            revert: true,
                            update: function( event, ui ) {
                                $('.inputs').html('');
                                $(this).children().each(function (index){
                                    if(index > 0){
                                        var sr = $(this)[0].children[3].src;
                                        $('.inputs').append(`<input type="hidden" class="image-class-${color}" name="images[${color}][]" value="${sr}">`);
                                    }
                                })
                            }
                        });
                        $("#sortable-"+color ).disableSelection();
                        $('#color-'+color).addClass('d-none');
                        var mockFile = [];
                        data.images.forEach(img=>{
                            mockFiles = {
                                name:'img-'+img.color_slug,
                                size:img.id,
                                dataURL: "{{asset('/')}}"+img.org_img
                            }
                            mockFile.push(mockFiles);
                        });
                        setup("my-awesome-dropzone"+color,color,mockFile);
                    }else{
                        $('.drops').html(
                            `<div id="dropzone-${color}" class="img-upload-area" data-color="${color}"><label class="mt-3">Color Family: <b>${color}</b></label>
                           
                            <div class="border m-0 collpanel drop-area row my-awesome-dropzone${color} dropzone-previews" id="sortable-${color}">
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
                        setup("my-awesome-dropzone"+color,color);
                    }
                }
            });
        });
        Dropzone.autoDiscover = false;

        $( "#sortable-main" ).sortable({
            placeholder: "ui-state-highlight",
            revert: true,
        });

        $("#sortable-main").disableSelection();
        // setup("my-awesome-dropzone-main",'main');

        function cheee(size){
            console.log(size+' --');
        }
        //function
        function setup(id,color,mockFile='',sss = '') {
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

                self.on("addedfile", function(file) {
                    $('.color-'+color).addClass('d-none');
                });

                self.on("dragenter", function(event) {
                    $('#sortable-'+color).css('background-color','#fff');
                });
                self.on("dragleave", function(event) {});

                self.on("thumbnail", function(file){
                    // console.log($('.h-100:last-child'));
                    // $(".h-100:last-child").attr('data-size', file.size);
                    // cheee(file.size);
                    sss = file.size;
                    if(file.size < 3000000){
                        $('.inputs').append(`<input type="hidden" class="image-class-${color}" name="images[${color}][]" id="id${file.size}" value="${file.dataURL}">`);
                    }else{
                        swal("Maximum size reached", {icon: "warning",buttons: false,timer: 2000});
                        this.removeFile(file);
                    }
                });

                self.on("removedfile", function(file) {
                    console.log(file.dataURL);
                    var i = 0;
                    $('.color-'+color+'-element').each(function(){
                        i = i+1;
                    });
                    if(i === 0){
                        $('.color-'+color).removeClass('d-none');
                    }
                    // $('#id'+file.size).remove();
                    $('div.col-md-12 div.inputs input.image-class-'+color).each(function(){
                        // console.log($(this).val());
                        if(file.dataURL == $(this).val()){
                        // console.log($(this).val());
                            $(this).remove();
                        }
                    });
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
                if(mockFile != ''){
                    mockFile.forEach(mockFile=>{
                        self.emit("addedfile", mockFile);
                        self.emit("thumbnail", mockFile, mockFile.dataURL);
                    });
                }
            console.log(sss);
            },
            previewTemplate: `
                <div class="drop-single color-${color}-element ui-state-default">
                <a href="javascript:undefined;" data-dz-remove=""><i class="fa fa-trash-o"></i>&nbsp;<span>Remove</span></a>
                <br/>
                <span class="dz-upload" data-dz-uploadprogress></span>
                <img class="h-100" data-size="${sss}" data-dz-thumbnail/>
                <div class="d-none size" data-dz-size></div>
                </div>`
            };
            var myDropzone = new Dropzone(`.${id}`, options);
        }


        function removeColorItem(color){

            swal({
                title: "Are you sure to delete it?",
                text: "To continue this action!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                        swal("Your action has beed done! :)", {
                        icon: "success",
                        buttons: false,
                        timer: 1000
                    });
                    $('#dropzone-'+color).remove();
                    $('input[name^="images['+color+']"]').each(function() {
                        $(this).remove();
                    });
                    document.querySelectorAll('.newRow option').forEach(item => {
                        if(item.innerHTML == color){
                            if(item.selected == true){
                                item.style.background = 'red';
                                item.style.color = 'white';
                                item.parentElement.style.border = '2px solid red';
                            }else{
                                item.remove()
                            }
                        }
                    })
                }
            });
        } 
    </script> 
<script>
    $('.js-example-basic-single').select2();
</script>
@endpush





