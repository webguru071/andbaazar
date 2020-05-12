@extends('layouts.vendor')
@section('content')
<style>
.contact-page .theme-form input{
     height: 50px;
     border-radius:4px;
      }
      .margin{
        margin-top:-30px
      }

      .contact-page .form-control{
        border-radius:4px;        
      }
      select.form-control:not([size]):not([multiple]){
        height: 50px;
      }
      .ckwidth{
          width:1000px;
      }

      .form-control {
  width: 100%;
}


 </style>
    @include('admin.elements.alert')
    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="page-title">
                        <h2>vendor dashboard</h2>
                    </div>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb" class="theme-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">vendor dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb End -->


    <!--  dashboard section start -->
    <section class="dashboard-section section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="dashboard-sidebar">
                        <div class="profile-top">
                            <div class="profile-image">
                                <img src="{{ asset('') }}/assets/images/logos/17.png" alt="" class="img-fluid">
                            </div>
                            <div class="profile-detail">
                                <h5>Products Store</h5>
                                <h6>750 followers | 10 review</h6>
                                <h6>mark.enderess@mail.com</h6>
                            </div>
                        </div>
                        <div class="faq-tab">
                            <ul class="nav nav-tabs" id="top-tab" role="tablist">
                                <li class="nav-item"><a data-toggle="tab" class="nav-link active" href="#dashboard">dashboard</a></li>
                                <li class="nav-item"><a  class="nav-link" href="{{ url('merchant/product') }}">All Products</a>
                                </li>
                                 <li class="nav-item"><a  class="nav-link" href="{{ url('merchant/inventory') }}">All Inventory</a>                     
                                <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#orders">orders</a>
                                </li>
                                <li class="nav-item"><a  class="nav-link" href="{{ url('merchant/seller/create') }}">profile</a>
                                </li>
                                <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#settings">settings</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" data-toggle="modal" data-target="#logout" href="#">logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- address section start -->
                <div class="col-sm-9 contact-page register-page container">                      
                            <form class="theme-form" action="{{ route('product.store') }}" method="post"  enctype="multipart/form-data">
                                @csrf
                           
                                <div class="card mb-4">
                                    <h5 class="card-header">Basic information</h5>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-12">   
                                                 <div class="form-group row">
                                                    <label for="category_id" class="col-xl-3 col-md-4">Category <span>*</span></label>
                                                    <select name="category_id" class="form-control col-md-8" id="category_id"  autocomplete="off">
                                                        <option value="" selected disabled>Select Category</option>
                                                        @foreach ($categories as $row)
                                                            <option value="{{ $row->id }}">{{$row->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>                                     
                                                <div class="form-group row">
                                                    <label for="sub_category" class="col-xl-3 col-md-4"> Sub Category <span>*</span></label>
                                                    <select name="sub_category" class="form-control col-md-8 sub" id="sub_category"  autocomplete="off">
                                                        <option value="" selected disabled>Select Sub Category</option>
                                                       {{-- @foreach ($subCategories as $row)
                                                    <option value="{{ $row->id }}">{{$row->name}}</option>

                                                @endforeach    --}}
                                                {{-- <option value="">Select Sub Category</option> --}} 
                                                  </select>
                                                </div> 

                                                <div class="form-group row">
                                                    <label for="name" class="col-xl-3 col-md-4">Name <span>*</span></label>                                          
                                                    <input class="form-control col-md-8" type="text" class="form-control" name="name" id="name">
                                                    @if ($errors->has('name'))
                                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>

                                                <div class="form-group row margin">
                                                    <label for="video_url" class="col-xl-3 col-md-4">Video Url<span>*</span></label>
                                                    <input type="text" class="form-control col-md-8" name="video_url" id="video_url"  >
                                                    @if ($errors->has('video_url'))
                                                        <span class="text-danger">{{ $errors->first('video_url') }}</span>
                                                    @endif
                                                </div> 

                                            </div>
                                        </div>
                                     </div>
                                  </div>

                                  <div class="card  mb-4">
                                    <h5 class="card-header">Made & Description</h5>
                                    <div class="card-body">

                                        <div class="form-group row">
                                            <label for="made_in" class="col-xl-3 col-md-4">Made In<span>*</span></label>
                                            <input type="text" class="form-control col-md-8" name="made_in" id="made_in" required="">
                                            @if ($errors->has('made_in'))
                                                <span class="text-danger">{{ $errors->first('made_in') }}</span>
                                            @endif
                                        </div> 

                                        <div class="form-group row">
                                      
                                            <label for="description" class="col-xl-3 col-md-4">Description<span>*</span></label>
                                            <div class="col-md-8 p-0">
                                            <textarea class="form-control  summernote"  id="description" name="description"></textarea>
                                                @if ($errors->has('description'))
                                                <span class="text-danger">{{ $errors->first('description') }}</span>
                                                @endif                                                                                        
                                        </div> 
                                        </div> 

                                    </div>
                                  </div>

                                  <div class="card mb-4">
                                    <h5 class="card-header">Tag & Model</h5>
                                    <div class="card-body">
                                      <div class="form-group row">
                                            {{-- <label for="tag_id" class="col-xl-3 col-md-4">Tag <span>*</span></label> --}}
                                            <select type="text" class="multiselect" multiple="multiple" role="multiselect"> 
                                            {{-- <select name="tag_id" class="form-control col-md-8 selectpicker" id="tag_id"  autocomplete="off" multiple> --}}
                                                <option value="" selected disabled>Select Tag</option> 
                                                @foreach ($tag as $row)
                                                    <option value="{{ $row->id }}">{{$row->name}}</option>
                                                @endforeach
                                            </select>
                                       </div>  
                                       <div class="form-group row">
                                            <label for="video_url" class="col-xl-3 col-md-4">Model No<span>*</span></label>
                                            <input type="number" class="form-control col-md-8" name="model_no" id="model_no"  required="">
                                              @if ($errors->has('model_no'))
                                                <span class="text-danger">{{ $errors->first('model_no') }}</span>
                                              @endif
                                      </div> 
                                      <div class="form-group row margin">
                                        <label for="materials" class="col-xl-3 col-md-4">Materials<span>*</span></label>
                                        <input type="text" class="form-control col-md-8" name="materials" id="materials"  required="">
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
                                            <input type="number" class="form-control col-md-8" name="price" id="price" required="">
                                            @if ($errors->has('price'))
                                                <span class="text-danger">{{ $errors->first('price') }}</span>
                                            @endif
                                        </div> 
                                      <div class="form-group row margin">
                                        <label for="org_price" class="col-xl-3 col-md-4">Orginal Price<span>*</span></label>
                                        <input type="number" class="form-control col-md-8" name="org_price" id="org_price" required="">
                                            @if ($errors->has('org_price'))
                                                <span class="text-danger">{{ $errors->first('org_price') }}</span>
                                            @endif
                                      </div> 
                                      <div class="form-group row margin">
                                        <label for="min_order" class="col-xl-3 col-md-4">Minimum Order <span>*</span></label>
                                        <input type="number" class="form-control col-md-8" name="min_order" id="min_order"  required="">
                                            @if ($errors->has('min_order'))
                                                <span class="text-danger">{{ $errors->first('min_order') }}</span>
                                            @endif
                                      </div> 
                                    </div>
                                  </div>                           
                                <div class="col-md-12">
                                    <button class="btn btn-sm btn-solid" type="submit">Save</button>
                                </div>
                            </div>
                        </form> 
                    </div>

                </div>
            </div>
        </section>
    <!-- section end -->
@endsection

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
{{-- <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script> --}}
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/19.0.0/classic/ckeditor.js"></script> --}}
{{-- <script>
    CKEDITOR.replace( 'summary-ckeditor' );
</script> --}}

{{-- <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script> --}}

{{-- Script for ckeditor --}}

{{-- <script type="text/javascript">
    CKEDITOR.replace('description',
        {
            customConfig: 'config.js',
            toolbar: 'simple'
            // config.width = '500;
            // config.width = '500';
            // config.width = '25em';
            config.width = '100%';
        })
</script> --}}

{{-- Script for subcategory --}}
<script>
    $(document).ready(function(){
        $('#category_id').on('change',function(){ 
            var categoryId = $(this).val();
            var subCategoryId = $('#sub_category').val();
            var option     = '<option value="">Sub category</option>'; 
            $.ajax({
                type:"get", 
                url:"{{ url('/merchant/product/subcategory/{id}') }}",
                data:{'categoryId':categoryId},
                success:function(data){
                    for(var i=0; i<data.length; i++){
                        option = option+'<option value="'+data[i].id+'">'+data[i].name+'</option>';  
                    }
                    $('.sub').html(option); 
                }
            })
        })
    });
    </script>


{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script> --}}
<script>
$('select').selectpicker();
</script>
@push('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
@endpush
@push('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
     $('.summernote').summernote({
           height: 300,
      });
   });
 </script>
@endpush