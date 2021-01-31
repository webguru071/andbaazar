@extends('admin.layout.master')

@push('css')
    <!-- For jasny bootstrap-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css" type="text/css" crossorigin="anonymous" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <style>
        .ui-menu { width: 150px; }
        #menu li {
            display: block;
        }
        .ui-widget.ui-widget-content {
            max-height: 300px;
            overflow-x: hidden;
            overflow-y: scroll;
            height: auto;
        }
        .category-active {
            background-color: var(--blue);
            color: #fff;
        }
    </style>
@endpush

@section('content')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Krishi Product Category
                            <small>{{ ucfirst(env('APP_NAME')) }} Admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="/"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Krishi Product</li>
                        <li class="breadcrumb-item active">Categories</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>eDIT Categroy</h5>
                    </div>
                    <div class="card-body">

                        <form class="needs-validation add-product-form" action="{{ action('Admin\KrishiProductCategoryController@update',$krishi_category->id) }}" novalidate="" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            @include('flash::message')
                            <div class="row product-adding">
                                <div class="col-xl-7 col-md-7">
                                    <div class="form">
                                        <div class="form-group mb-3 row">
                                            <label for="categoryName" class="col-xl-3 col-sm-4 mb-0">Name <span class="text-danger"> *</span>:</label>
                                            <input name="name" class="form-control col-xl-8 col-sm-7" id="categoryName" type="text" required value="{{ $krishi_category->name }}">
                                        </div>
                                    </div>
                                    <div class="form">
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-sm-4 mb-0">Parent Category :</label>

                                            <div class="dropdown">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" id="selectParentCategory">
                                                    {{ (!is_null($krishi_category->parent)) ? $krishi_category->parent['name'] : 'None' }}
                                                </button>
                                                <div class="dropdown-menu">
                                                    <ul id="menu">
                                                        <li category-id="0" category-name="None"><div>None</div></li>
                                                        @foreach($categories as $category)
                                                            <li category-id="{{ $category->id }}" category-name="{{ $category->name }}"><div>{{ $category->name }}</div>
                                                                @if(count($category->childs)>0)
                                                                    <ul>
                                                                        @foreach($category->childs as $child)
                                                                            <li category-id="{{ $child->id }}" category-name="{{ $child->name }}"><div>{{ $child->name }}</div></li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="parent_id" id="parent_id" value="{{ $krishi_category->parent_id }}">

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-sm-4 mb-0">Description :</label>
                                            <textarea class="form-control col-xl-8 col-sm-7" name="description" rows="4">{{ $krishi_category->description }}</textarea>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-xl-3 col-sm-4 mb-0">Icon :</label>
                                            <div class="input-group col-xl-8 col-sm-7 p-0">

                                                <input id="thumbnail" class="form-control" type="text" name="icon" value="{{ $krishi_category->icon }}">
                                                <span class="input-group-btn">
                                                     <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                                       <i class="fa fa-picture-o"></i> Choose
                                                     </a>
                                                </span>

                                                <img id="holder" style="margin-top:15px;max-height:100px;">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="sliderStatus" class="col-xl-3 col-sm-4 mb-0">Status <span class="text-danger"> *</span>:</label>
                                            <select class="form-control digits col-xl-8 col-sm-7" id="sliderStatus" name="active" required>
                                                <option value="1" {{ ($krishi_category->active === 1) ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ ($krishi_category->active === 0) ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="offset-xl-3 offset-sm-4">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <button type="reset" class="btn btn-light">Discard</button>
                                    </div>
                                </div>
                                <div class="col-xl-5 col-md-5">
                                    <div class="add-product">
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="mb-2">Thumbnail Image (450X170) <span class="text-danger">*</span></label>
                                                <div class="text-center">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail img-responsive" >
                                                            <img src="{{ Storage::url($krishi_category->thumbnail_image) }}" width="100%" alt="Thumbnail Images">
                                                        </div>
                                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                                        <div class="mt-1">
                                                            <span class="btn btn-light waves-effect btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                                                                <input type="file" name="thumbnail_image" accept="image/jpg, image/jpeg, image/png">
                                                            </span>
                                                            <a href="#" class="btn btn-primary waves-effect fileinput-exists " data-dismiss="fileinput">Remove</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        $('div.alert').delay(3000).fadeOut(350);
        $('#lfm').filemanager('image');

        //For Product Category
        $("#menu").menu({
            select : function(event,ui){
                $('#parent_id').val(ui.item.attr('category-id'));
                $('#selectParentCategory').text(ui.item.attr('category-name'));
            }
        });
    </script>
@endpush
