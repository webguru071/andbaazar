@push('css')
<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
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
    .rowRemove{
            line-height: 26px;
        }
        .ui-sortable-placeholder { height: 125px; width: 125px; border: 1px dashed; line-height: 1.2em; }
</style>
@endpush
@push('js')
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/dropzone.js') }}"></script>
<script>
    Dropzone.autoDiscover = false;
    $( "#sortable-main" ).sortable({
        placeholder: "ui-state-highlight",
        revert: true,
    });
    $("#sortable-main").disableSelection();
    // setup("my-awesome-dropzone-main",'main');

    var mockFile = [];
    @if(isset($oldImages))
        @foreach($oldImages as $img)
            mockFiles = {
                name:'img-'+'product-image',
                size:{{$img->id}},
                dataURL: "{{Storage::url($img->org_img)}}",//+"{{$img->org_img}}"
            }
            mockFile.push(mockFiles);
        @endforeach
    @endif
    setup("my-awesome-dropzone-main",'main',mockFile);


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
</script>
@endpush


{{-- 
    
    
    guidline to implement
    -------------------------------------------------------------------------------------------------on html
    @include('elements.dropzone',['oldImages' => $itemImages]) //edit
    @include('elements.dropzone') //on insert
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
    -------------------------------------------------------------------------------------------------on controller
    foreach($images as $index=>$img){
           $image = [
            'product_id' => $itemId,
            'sort'       => (int)$index+1,
            'org_img'    => Baazar::base64Uploadkrishi($img,'orgimg'),
          ];
           KrishiProductItemImage::create($image);
        }
    --------------------------------------------------------------------------------------------------on helper
    public function base64Uploadkrishi($image_file,$name=null){
        $t = substr($image_file,0,11);
        if($t == 'data:image/'){
            $poster = explode(";base64", $image_file);
            $image_type = explode("image/", $poster[0]);
            $mime_type = '.'.$image_type[1];
            $path = 'images/krishiproducts/'.$name.time().rand().$mime_type;
            $image = Image::make($image_file)->fit(560, 560)->encode();
            Storage::put($path, $image);
            return $path;
        }else{
            $path = explode('/storage/',$image_file);
            return $path[1];
        }
    }
    
    
    --}}