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

    .fa{
        padding:4px;
      font-size:16px;
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

    <div class="container-fluid">
        <div class="row">
                           
            <!-- </div> -->
            <div class="col-sm-5">
                <div class="card">
                    <div class="card-header">
                        <h5>Create Category</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('category.store') }}" method="post" class="form" id="validateForm" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group text-left mb-5 ">
                                <label for="thumb">Image:</label>
                                <div class="col-md-6">
                                    <input type="file" name="thumb" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="category">category Name:</label>
                                <input type="text"  name="name" value="{{ old('name') }}" required class="form-control @error('name') border-danger @enderror">
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            </div>
                            <div class="form-group ">
                                <label for="percentage">Percentage:</label>
                                <input type="number" name="percentage" value="{{old('percentage')}} % " class="form-control @error('percentage') border-danger @enderror" id="amount" placeholder="0.00" required autocomplete="off">
                                <span class="text-danger">{{ $errors->first('percentage') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="desc">Description:</label>
                                <textarea   name="desc"  class="form-control @error('desc') border-danger @enderror" rows="5"> </textarea>
                                <span class="text-danger">{{ $errors->first('desc') }}</span>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
              <div class="card">
                <div class="card-header">
                    <h5>Create Sub Category</h5>
                </div>
                <div class="card-body">
                  <form action="{{ route('add.category') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                      <div class="form-group text-left mb-5 pb-3">
                        <label for="thumb">Image:</label>
                        <div class="mt-0">
                            <img id="output"  class="imagestyle" src="{{ asset('/uploads/category_image/categ.png') }}" />
                        </div>
                        <div class="uploadbtn">
                            <label for="file-upload" class="custom-file-upload">Upload Here</label>
                            <input id="file-upload" type="file" name="thumb" onchange="loadFile(event)"/>
                        </div>
                        {{-- <input type="hidden" name="old_thumb"> --}}
                    </div>
                      <select class="form-control" name="parent_id">
                        <option value="">Select Parent Category</option>
                        @foreach ($categories as $category)
                          <option value="{{ $category->id }}" class="font-weight-bold">{{ $category->name }}</option>
                          @foreach($subcategories as $subcategory)
                            @if($category->id == $subcategory->parent_id)
                            <option value="{{ $subcategory->id }}">{{$subcategory->name }}</option>
                            @endif
                          @endforeach
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                      <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Sub Category Name" required>
                    </div>
                  <div class="form-group ">
                      <label for="percentage">Percentage:</label>
                      <input type="number" name="percentage" value="{{old('percentage')}} % " class="form-control @error('percentage') border-danger @enderror" id="amount" placeholder="0.00" required autocomplete="off">
                      <span class="text-danger">{{ $errors->first('percentage') }}</span>
                  </div>
                  <div class="form-group">
                      <label for="desc">Description:</label>
                      <textarea   name="desc"  class="form-control @error('desc') border-danger @enderror" rows="5"> </textarea>
                      <span class="text-danger">{{ $errors->first('desc') }}</span>
                  </div>

                  <div class="form-group ">
                    <label for="percentage">Inventory Attribute:</label>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                      <label class="form-check-label" for="inlineCheckbox1">Storage Capacity</label>
                    </div>
                  </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
<script>
$('a[data-toggle="tooltip"]').tooltip({
    animated: 'fade',
    placement: 'bottom',
    html: true
});

// var loadFile = function(event) {
//     var outputs = document.getElementById('output');
//     outputs.src = URL.createObjectURL(event.target.files[0]);
// };
</script>

<script>
  var loadFile = function(event) {
      var output = document.getElementById('output');
      output.src = URL.createObjectURL(event.target.files[0]);
  };
</script>


@endpush
