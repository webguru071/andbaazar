
@push('css')
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
  width:665px !important;
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
 </style>
@endpush
<div class="card mb-4">
  <h5 class="card-header">Basic information</h5>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="bn_name">Product Name(Bangla) <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" class="form-control" name="bn_name" value="{{ old('bn_name') }}" id="bn_name">
                            <span class="text-danger" id="message_bn_name"></span>
                            @if ($errors->has('bn_name'))
                                <span class="text-danger">{{ $errors->first('bn_name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Product Name(English) <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" class="form-control" value="{{ old('name') }}" name="name" id="name">
                            <span class="text-danger" id="message_name"></span>
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                
                
                {{-- <div class="row">
                    <label for="materials" class="col-xl-3 col-md-4">Tag<span>*</span></label>
                    <div class="col-md-8">
                        <div class="form-group margin">                        
                            <select class="js-example-basic-multiple form-control" name="tag_id[]" id="tad_id" multiple="multiple" required>
                                @foreach ($tag as $row)
                                    <option value="{{ $row->name }}">{{$row->name}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger" id="message_video_url"></span>
                            @if ($errors->has('video_url'))
                                <span class="text-danger">{{ $errors->first('video_url') }}</span>
                            @endif
                        </div>
                    </div>
                </div> --}}

                {{-- <div class="form-group row margin">
                    <label for="materials" class="col-xl-3 col-md-4">Materials<span>*</span></label>
                    <input type="text" class="form-control col-md-8" name="materials" id="materials"  required="">
                    <label for="model_no" class="col-xl-3 col-md-4"><span></span></label>
                    <span class="text-danger" id="message_materials"></span>
                    @if ($errors->has('materials'))
                        <span class="text-danger">{{ $errors->first('materials') }}</span>
                    @endif
                </div> --}}

               
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
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group margin">
                            <label for="brand_id">Brands<span>*</span></label>
                            <select name="brand_id" class="form-control" id="brand">
                                <option value="" selected>No Brand</option> 
                            </select>
                            <span class="text-danger" id="message_video_url"></span>
                            @if ($errors->has('video_url'))
                                <span class="text-danger">{{ $errors->first('video_url') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group margin">
                            <label for="video_url">Video Url<span>*</span></label>
                            <input type="text" class="form-control" name="video_url" id="video_url">
                            <span class="text-danger" id="message_video_url"></span>
                            @if ($errors->has('video_url'))
                                <span class="text-danger">{{ $errors->first('video_url') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
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

        function getBrands(cid){
            $.ajax({
                type:"POST",
                url:"{{ url('/merchant/e-commerce/products/get-brand/') }}",
                data:{ 'cat': cid ,'_token':'{{csrf_token()}}'},
                success:function(data){
                    $('#brand').html(data);
                }
            });
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
@endpush
