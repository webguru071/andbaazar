@extends('merchant.master')

@section('content')
    @push('css')
    <link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <style>
            /* .inputfield{
                height: 45px!important;
            } */
            .bottom{
                margin-bottom: 25px;
            }
           
        .h-100{
            height: 70px !important;
            padding: 2px;
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

        .dropzone-previews { 
            width: 980px; 
        }
        .spanHi{
            height: 40px!important;
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
            <li class="breadcrumb-item active" aria-current="page">Inventory</li>
        @endslot
    @endcomponent --}}

    <!--  dashboard section start -->
    <section class="dashboard-section section-b-space">
        <div class="container">
            <div class="row">

            @include('layouts.inc.sidebar.vendor-sidebar',[$active='smeInventory'])

            <!-- address section start -->
                <div class="col-sm-9">
                    <h3>Edit SME Inventory</h3>
                    <div class="card">
                        <div class="card-body">
                            <form class="theme-form" action="{{ url('merchant/sme/inventories/update/'.$inventory->slug) }}" method="post" id="validateForm">
                                @csrf
                                @method('put') 
                                <div class="form-row">
                                    
        
                                    <div class="col-md-6">
                                        <label for="product_id">Product <span class="text-danger"> *</span></label><span class="text-danger">{{ $errors->first('product_id') }}</span>
                                        <input type="text" class="form-control" value="{{$inventory->item->name}}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="color_id">Color <span class="text-danger"> *</span></label><span class="text-danger">{{ $errors->first('color_name') }}</span>
                                        <input type="text" readonly class="form-control" value="{{$inventory->color->name}}">
                                    </div>


                                    <div class="col-md-12"> 
                                        <label for="" class="col-xl-3 col-md-8"></label>
                                        <div class="drops dropzone-previews"></div>
                                        <div class="inputs"></div> 
                                    </div>

                                    {{-- <div class="col-md-12 d-none">
                                        <label for="color_id" class="col-xl-3 col-md-4"></label>
                                        <div id="dropzone-main" class="img-upload-area" data-color="main"><label class="mt-3"><b>Feature Images :</b><span class="text-danger" id="message_main_img"></span></label>
                                            <div class="border m-0 collpanel drop-area row my-awesome-dropzone-main" id="sortable-main">
                                                <span class="dz-message color-main d-none">
                                                    <h2>Drag & Drop Your Files</h2>
                                                </span>
                                            </div>
                                            <small>Remember Your featured file will be the first one.</small><br>
                                        </div>
                                    </div> --}}
        
                                    
                                    <div class="col-md-6 mt-1">
                                        <label for="price">Price <span class="text-danger"> *</span></label><span class="text-danger">{{ $errors->first('Price') }}</span>
                                        <input type="number" class="form-control inputfield" name="price" id="price" value="{{ old('price',$inventory->price) }}">
                                    </div>
                                    <div class="col-md-6 mt-1">
                                        <label for="qty_stock">Stock Quantity <span class="text-danger"> *</span></label><span class="text-danger">{{ $errors->first('qty_stock') }}</span>
                                        <input type="number" class="form-control inputfield" name="qty_stock" id="qty_stock" value="{{ old('qty_stock',$inventory->qty_stock) }}">
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <label for="seller_sku">SellerSku <span class="text-danger"></span></label><span class="text-danger">{{ $errors->first('seller_sku') }}</span>
                                        <input type="text" class="form-control inputfield" name="seller_sku" id="seller_sku" value="{{ old('seller_sku',$inventory->seller_sku) }}">
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <h4>Special price (optional)</h4>
                                        <hr>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="special_price">Special price</label>
                                        <input type="number" class="form-control inputfield" name="special_price" id="special_price" value="{{ old('special_price',$inventory->special_price) }}">
                                    </div>
        
                                    <div class="col-md-6">
                                        <label for="" >Special price Period</label>
                                        <div class="input-group">
                                            <input type="text" id="spcial_price_start" name="start_date" class="datepickerRange form-control inputfield" value="{{ old('start_date',$inventory->start_date) }}"><span class="input-group-addon p-2 bg-success bottom spanHi">To</span><input type="text" id="spcial_price_end" name="end_date" class="datepickerRange form-control inputfield" value="{{ old('end_date',$inventory->end_date) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-sm btn-solid" type="submit">Update</button>
                                        <a href="{{ url('merchant/sme/inventories') }}" class="btn btn-sm btn-solid">Back</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> 
                </div>

            </div>
        </div>
    </section>
    <!-- section end -->
@endsection
@push('js')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
    <script>
        //Rendering Other images into Dropzone
        @foreach($itemImages as $color=>$imges)
        mockFile = [];
            @foreach($imges as $img)
                mockFiles = {
                    name:'img-'+'{{$img['color_slug']}}',
                    size:{{$img['id']}},
                    dataURL: "{{asset('/')}}"+"{{$img['org_img']}}"
                }
                mockFile.push(mockFiles);
            @endforeach
            @if($color != 'main')
                appendDrops('{{$color}}',mockFile);
                mockFile = [];
            @endif
        @endforeach 

        // get inventories attributes 
        // Drug & Drop script start
        $( "#sortable-red").sortable({
            placeholder: "ui-state-highlight",
            revert: true,
        });

        // dropzone scripts
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
            $('.inputs').html('');
            $('.drops').html(
                    `<div id="dropzone-${color}" class="img-upload-area dropzone-previews" data-color="${color}"><label class="mt-3">Color Family: <b>${color}</b></label> 
                    <div class="border m-0 collpanel drop-area row my-awesome-dropzone${color} dropzone-previews" id="sortable-${color}">
                        <span class="dz-message color-${color}">
                            <h2>Drag & Drop Your Files</h2>
                        </span>
                    </div>
                    <small>Remember Your featured file will be the first one.</small><br></div>`
                );
                // $( "#sortable-"+color ).sortable({
                //     placeholder: "ui-state-highlight",
                //     revert: true,
                // });
                $( "#sortable-"+color ).sortable({
                            placeholder: "ui-state-highlight",
                            revert: true,
                            update: function( event, ui ) {
                                $('.inputs').html('');
                                $(this).children().each(function (index){
                                    if(index > 0){
                                        // var kwy = Math.floor((Math.random() * 100000) + 1);
                                        var sr = $(this)[0].children[3].src;
                                        $('.inputs').append(`<input type="hidden" class="image-class-${color}" name="images[${color}][]" value="${sr}">`);
                                    }
                                })
                            }
                        });
                $("#sortable-"+color ).disableSelection();
                setup("my-awesome-dropzone"+color,color,mockFile);
                // inventoryRows(color);
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

                    self.on("addedfile", function(file) {
                        $('.color-'+color).addClass('d-none');
                    });

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
        }
        
    </script>
@endpush

