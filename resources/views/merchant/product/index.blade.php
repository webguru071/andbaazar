@extends('merchant.master') 
@section('content') 
@push('css')
 <style>
     .modal {
  text-align: center;
}

@media screen and (min-width: 768px) { 
  .modal:before {
    display: inline-block;
    vertical-align: middle;
    content: " ";
    height: 100%;
  }
}

.modal-dialog {
  display: inline-block;
  text-align: left;
  vertical-align: middle;
  width: 1000px;
}
 </style>
@endpush
@include('elements.alert')

<section class="dashboard-section section-b-space">
    <div class="container">
        <div class="row">
            @include('layouts.inc.sidebar.vendor-sidebar',[$active ='product'])
            <div class="col-md-9">
                <div class="top-sec">
                    <h3>E-commerce Products</h3>
                    <a href="{{ url('merchant/e-commerce/products/new') }}" class="btn btn-sm btn-solid">Add New</a>
                </div>
                <form action="" method="get">
                <div class="filter-area d-flex">

                    
                    <div class="form-group mr-1">
                        <input type="text" name="keyword" class="form-control" placeholder="Search Here..." value="{{$filter['keyword']}}" />                     
                    </div>
                    <div class="form-group mr-1">
                        <div class="input-group">
                            <span class="input-group-addon bg-primary p-2 font-weight-bold text-white">Category</span>
                            <select name="category" class="form-control" id="category">
                            <option value="">All Category</option>
                            @foreach($categories as $cat)                               
                                <option value="{{ $cat->category->slug }}" {{$filter['category'] == $cat->category->slug ? 'selected':''}}>  {{$cat->category->name}}</option>
                            @endforeach
                            </select>
                        </div>                    
                    </div>                   
                    <div class="form-group mr-2">
                        <div class="input-group">
                            <span class="input-group-addon bg-primary p-2 font-weight-bold text-white">Status</span>
                            <select name="status" class="form-control" id="status">
                                <option value="">All Status</option>
                                <option value="Active" {{$filter['status'] == 'Active' ? 'selected':''}}>Active</option>
                                <option value="Pending" {{$filter['status'] == 'Pending' ? 'selected':''}}>Pending</option>
                                <option value="Rejected" {{$filter['status'] == 'Rejected' ? 'selected':''}}>Rejected</option>
                            </select>
                        </div>
                    </div>
                    <button class="btn btn-success btn-sm text-white font-weight-bold mr-1" style="padding: 8px; height: 38px;" type="sumbit"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                    @if($filter['status'] != '' || $filter['keyword'] != '' || $filter['category'] != '')
                        <a href="{{url('merchant/e-commerce/products')}}" class="btn btn-info btn-sm text-white font-weight-bold" style="padding: 8px; height: 38px;"> <i class="fa fa-refresh" aria-hidden="true"></i> Clear</a>
                    @endif
                </div>
            </form>
                <table class="table-responsive-md table mb-0 table-striped mt-2">
                    <thead>
                        <tr>
                            {{--
                            <th scope="col">image</th>
                            --}}
                            <th scope="col" class="text-left">Product name</th>
                            <th scope="col" class="text-left">Category</th>
                            <th scope="col">Price</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Sales</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($product as $row)
                        <tr>
                            {{--
                            <th scope="row"><img src="{{asset($row->image)}}" height="50" width="50" class="blur-up lazyloaded" /></th>
                            --}}
                            <td class="text-left">{{$row->name}}</td>
                            <td class="text-left">{{$row->category_slug}}</td>
                            <td>${{$row->price}}</td>
                            <td>100</td>
                            <td>2000</td>
                            <td>
                                @if($row->status == 'Pending')
                                <label class="badge badge-pill badge-primary p-2">Pending</label>
                                @elseif($row->status == 'Active')
                                <label class="badge badge-pill badge-success p-2">Active</label>
                                @else
                                <a href="#" id="" class="badge badge-pill badge-danger p-2" data-toggle="modal" data-original-title="test" data-target="#tagEditModal{{$row->id}}">Reject</a>
                                @endif
                            </td>
                            <td class="d-flex justify-content-between">
                                <ul>
                                    <li>
                                        <a href="{{ url('merchant/e-commerce/products/update/'.$row->slug.'/productupdate') }}">
                                            <button class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></button>
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ url('/merchant/e-commerce/product/'.$row->id) }}" method="post" style="margin-top: -2px;" id="deleteButton{{$row->id}}">
                                            @csrf @method('delete')
                                            <button type="submit" class="btn btn-sm btn-primary" onclick="sweetalertDelete({{$row->id}})"><i class="fa fa-trash-o"></i></button>
                                        </form>
                                    </li>
                                </ul>
                            </td>
                        </tr>

                        <div class="modal fade" id="tagEditModal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title f-w-600" id="exampleModalLabel">Reject Description</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    </div>

                                    <div class="modal-body">
                                        <div class="form">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="validationCustom01" class="mb-1">Description :</label>
                                                    <div>
                                                        {{ $row->rej_desc}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           @empty
                            <tr>
                                <td colspan="7">No Product found</td>
                            </tr>
                            @endforelse
                        </div>
                    </tbody>
                </table>
                <div class ="mt-2">
                {{$product->links()}}
                </div>
               
            </div>
            
        </div>
    </div>
</section>

@endsection 
@push('js')
<script>
    // $("#search").keyup(function () {
    //     var value = this.value.toLowerCase().trim();
    //     $("table tr").each(function (index) {
    //         if (!index) return;
    //         $(this)
    //             .find("td")
    //             .each(function () {
    //                 var id = $(this).text().toLowerCase().trim();
    //                 var not_found = id.indexOf(value) == -1;
    //                 $(this).closest("tr").toggle(!not_found);
    //                 return not_found;
    //             });
    //       });
    // });
</script>

<script>

// $('#category').on('change',function(){
//   var cat = $(this).val();  
//   window.location.href = 'products?page=1&cat=' + cat;
// });

// $('#status').on('change',function(){
//   var status = $(this).val();
//   window.location.href = 'products?page=1&status=' + status;
// });
</script>
@endpush
