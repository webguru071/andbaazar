@extends('admin.layout.master')

@push('css')
    <!-- For jasny bootstrap-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css" type="text/css" crossorigin="anonymous" />
@endpush

@section('content')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Slider Image
                            <small>{{ ucfirst(env('APP_NAME')) }} Admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="/"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">CMS</li>
                        <li class="breadcrumb-item active">Slider Image</li>
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
                        <h5>Add New Slide</h5>
                    </div>
                    <div class="card-body">

                        <form class="needs-validation add-product-form" action="{{ action('Admin\KrishiBazarSliderController@store') }}" novalidate="" method="post" enctype="multipart/form-data">
                            @csrf
                            @include('flash::message')
                            <div class="row product-adding">
                                <div class="col-xl-7 col-md-7">
                                    <div class="form">
                                        <div class="form-group mb-3 row">
                                            <label for="sliderURL" class="col-xl-3 col-sm-4 mb-0">URL <span class="text-danger"> *</span>:</label>
                                            <input name="slider_url" class="form-control col-xl-8 col-sm-7" id="sliderURL" type="url" required>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                    </div>
                                    <div class="form">
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-sm-4 mb-0">Description :</label>
                                            <textarea class="form-control col-xl-8 col-sm-7" name="slider_details" rows="4"></textarea>
                                        </div>
                                        <div class="form-group row">
                                            <label for="sliderStatus" class="col-xl-3 col-sm-4 mb-0">Status <span class="text-danger"> *</span>:</label>
                                            <select class="form-control digits col-xl-8 col-sm-7" id="sliderStatus" name="status" required>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="offset-xl-3 offset-sm-4">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                        <button type="reset" class="btn btn-light">Discard</button>
                                    </div>
                                </div>
                                <div class="col-xl-5 col-md-5">
                                    <div class="add-product">
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="mb-2">Slider Image (1087X500) <span class="text-danger">*</span></label>
                                                <div class="text-center">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail img-responsive" >
                                                            <img src="/frontend/assets/images/pro/upload_img.png" width="100%" alt="Slider Image">
                                                        </div>
                                                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                                        <div class="mt-1">
                                                            <span class="btn btn-light waves-effect btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                                                                <input type="file" name="slider_image" required>
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
    <script>
        $('div.alert').delay(3000).fadeOut(350);
    </script>
@endpush
