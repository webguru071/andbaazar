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
            <!-- <div class="col-sm-7">
                <div class="card">
                    <div class="card-header">
                        <h5>Manage Category</h5>
                    </div>
                    <div class="card-body"> -->
                        <!-- <table class="table table-borderd" id="dataTableNoPagingDesc">
                            <thead>
                            <tr>
                                <th width="50">Sl</th>
                                <th width="200">Category</th>
                                <th width="200">Percentage</th>
                                <th>Description</th>
                                <th width="80" class="text-center">Action</th>
                            </tr>
                            </thead>
                          <tbody>
                            @php $i=0; @endphp
                            @foreach($category as $row)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>
                                    <a data-toggle="tooltip" title="<img src='{{ $row->thumb ? asset($row->thumb) : asset('/uploads/category_image/user.png') }}' height='100' width='100' />">
                                        {{ $row->name }}
                                    </a>
                                </td>
                                <td>{{ $row->percentage }}</td>
                                <td>{{ $row->desc }}</td>
                                <td class="d-flex justify-content-between">
                                    <ul>
                                        <li><a href="#" id="{{ url('/andbaazaradmin/products/category/'.$row->slug.'/edit')}}" title="Edit"><button class="btn btn-sm btn-warning"  data-toggle="modal" data-original-title="test" data-target="#categoryEditModal{{$row->id}}"><i class="fa fa-edit"></i></button> </a></li>
                                        <li>
                                            <form action="{{ url('/andbaazaradmin/products/category/'.$row->slug) }}" method="post"  id="deleteButton{{$row->id}}">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-primary" onclick="sweetalertDelete({{$row->id}})"><i class="fa fa-trash-o"></i></button>
                                            </form>
                                        </li>
                                    </ul>
                                </td>
                            </tr> -->

                                <!-- <div class="modal fade" id="categoryEditModal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title f-w-600" id="exampleModalLabel">Edit category</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="needs-validation" novalidate="" action="{{ url('/andbaazaradmin/products/category/'.$row->slug) }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('put')
                                                    <div class="form">
                                                        <div class="form-goup text-left text-left mb-5 pb-3">
                                                            <label for="thumb">Image:</label>
                                                            <div class="mt-0">
                                                                <img id="output{{$row->id}}"  class="imagestyle" src="{{ asset('/uploads/category_image/user.png') }}" />
                                                            </div>
                                                            <div class="uploadbtn">
                                                                <label for="file-upload" class="custom-file-upload">Upload Here</label>
                                                                <input id="file-upload" type="file" name="thumb" onchange="loadimg(event)"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="validationCustom01" class="mb-1">category Name :</label>
                                                            <input type="text"  name="name" value="{{old('name',$row->name)}}" required class="form-control @error('name') border-danger @enderror">
                                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="validationCustom01" class="mb-1">Percentage :</label>
                                                            <input type="number"  name="percentage" value="{{old('percentage',$row->percentage)}}" required class="form-control @error('percentage') border-danger @enderror">
                                                            <span class="text-danger">{{ $errors->first('percentage') }}</span>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="desc">Description:</label>
                                                            <textarea type="validationCustom01"  name="desc"  class="form-control @error('name') border-danger @enderror" rows="5">{{$row->desc}}</textarea>
                                                            <span class="text-danger">{{ $errors->first('desc') }}</span>
                                                        </div>

                                                    </div>
                                                    <div class="mt-3 text-right">
                                                        <button type="submit" class="btn btn-success" type="button">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @push('js')
                                    {{-- <script>
                                        var loadimg = function(event) {
                                            var outputss = document.getElementById('output{{$row->id}}');
                                            outputss.src = URL.createObjectURL(event.target.files[0]);
                                            console.log(outputss.src);
                                            $('#output{{$row->id}}').attr('src',outputss.src);
                                            // outputss.src = ;
                                        };
                                    </script> --}}
                                    @endpush
                            @endforeach
                            </tbody>
                        </table>
                    </div> -->

            <!-- </div> -->
            <div class="col-sm-5">
                <div class="card">
                    <div class="card-header">
                        <h5>Create Category</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('category.store') }}" method="post" class="form" id="validateForm" enctype="multipart/form-data">
                            @csrf
                            {{-- <div class="form-group text-left mb-5 pb-3">
                                <label for="thumb">Image:</label>
                                <div class="mt-0">
                                    <img id="output"  class="imagestyle" src="{{ asset('/uploads/category_image/categ.png') }}" />
                                </div>
                                <div class="uploadbtn">
                                    <label for="file-upload" class="custom-file-upload">Upload Here</label>
                                    <input id="file-upload" type="file" name="thumb" onchange="loadFile(event)"/>
                                </div>
                            </div> --}}
                            {{-- <div class="form-group text-left mb-5 pb-3">
                                <label for="thumb">Image:</label>
                                <div class="mt-0">
                                    <img id="output"  class="imagestyle" src="{{ asset('/uploads/category_image/categ.png') }}" />
                                </div>
                                <div class="uploadbtn">
                                    <label for="file-upload" class="custom-file-upload">Upload Here</label>
                                    <input id="file-upload" type="file" name="thumb" onchange="loadFile(event)"/>
                                </div>
                            </div> --}}

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
                            <div class="form-group">
                                <label for="type">Category type</label>
                                <select class="form-control" name="type"> 
                                    <option value="ecommerce">E-Commerce</option>
                                    <option value="sme">SME</option>
                                    <option value="krishi">Krishi</option>
                                </select>
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
