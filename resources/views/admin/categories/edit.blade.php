@extends('admin.layout.master')

@section('content')
@push('css')
    <style>
        .imagestyleIndex{
        width: 100px;
        height:100px;
        /* border-width: 4px 4px 4px 4px; */
        /* border-style: solid;
        border-color: #ccc; */
    } 

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
    .uploadbtn{
        width: 200px;background: #ddd;float: left;text-align: center;
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
@component('admin.layout.inc.breadcrumb')
  @slot('pageTitle')
      Category
  @endslot
  @slot('page')
      <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
      <li class="breadcrumb-item active" aria-current="page">Category</li>
  @endslot
@endcomponent   
        <div class="container-fluid" style="padding-left: 500px">
            <div class="row"> 
                <div class="col-sm-7">
                    <div class="card">
                        <div class="card-header">
                            <h5>Edit Category</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/andbaazaradmin/categories/update/'.$category->id) }}" method="post" class="form" id="validateForm" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="form-group text-left mb-5 pb-3">  
                                    <label for="thumb">Logo:</label>
                                    <div class="mt-0">
                                        @if(!empty($category->thumb))
                                         <img id="output"  class="imagestyle" src="{{ asset($category->thumb) }}"/>
                                        @else
                                         <img id="output"  class="imagestyle" src="{{ asset('/uploads/brand_image/brand.png') }}" />
                                        @endif
                                    </div>
                                    <div class="uploadbtn"> 
                                        <label for="file-upload" class="custom-file-upload">Upload Here</label>
                                        <input id="file-upload" type="file" name="thumb" onchange="loadFile(event)"/>
                                        <input type="hidden" value="{{$category->thumb}}" name="old_image"> 
                                    </div>
                                </div>                      
                                <div class="form-group">
                                    <label for="validationCustom0">Category Name <span class="text-danger">*</span></label>
                                    <input class="form-control  @error('name') border-danger @enderror" name="name" value="{{old('name',$category->name)  }}" id="validationCustom0" type="text" required="">
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                </div> 
                                <div class="form-group ">
                                    <label for="percentage">Percentage:</label>
                                    <input type="number" name="percentage" value="{{old('percentage',$category->percentage)}}" class="form-control @error('percentage') border-danger @enderror" id="amount" placeholder="0.00" required autocomplete="off">
                                    <span class="text-danger">{{ $errors->first('percentage') }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <textarea type="text"  name="desc"  class="form-control @error('desc') border-danger @enderror" rows="5">{{$category->desc}}</textarea>
                                    <span class="text-danger">{{ $errors->first('desc') }}</span>
                                </div>   
                                <div class="text-right">
                                    <button type="submit"  class="btn btn-primary">Update</button>
                                </div> 
                             </form>
                           </div>                                                 
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
<script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
    };
</script>
