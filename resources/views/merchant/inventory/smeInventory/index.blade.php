@extends('merchant.master')
@section('content')
@push('css')


@endpush
@include('elements.alert')


<section class="dashboard-section section-b-space">
    <div class="container">
        <div class="row">
            @include('layouts.inc.sidebar.vendor-sidebar',[$active ='smeInventory'])
            <div class="col-md-9"> 
                <div class="top-sec">
                    <h3>Sme Inventory</h3>
                    <a href="{{ url('merchant/sme/inventories/new') }}" class="btn btn-sm btn-solid float-right">add New</a>
                </div> 
                <div class="filter-area w-50">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon bg-primary p-2 font-weight-bold text-white">Select Product</span>
                            <select name="product" id="product" class="form-control"> 
                                <option value="all" {{ $select['product'] == 'all' ? 'selected' : ''}}>All Product</option>
                                @foreach($products as $row)
                                <option value="{{$row->slug}}" {{ $select['product'] == $row->slug ? 'selected' : ''}}>{{$row->name}}</option> 
                                @endforeach
                            </select>
                        </div>                    
                    </div>
                </div>
                <div>  
                    <ul class="nav nav-tabs nav-material myTab" id="top-tab" role="tablist">
                        <li class="nav-item"><a class="nav-link active show" id="top-home-tab" data-toggle="tab" href="#top-home" role="tab" aria-selected="true"><i class="icofont icofont-ui-home"></i>Active</a>
                            <div class="material-border"></div>
                        </li>
                        <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-toggle="tab" href="#top-profile" role="tab" aria-selected="false"><i class="icofont icofont-man-in-glasses"></i>Out of Stock</a>
                            <div class="material-border"></div>
                        </li>
                    </ul>
                    <div class="tab-content nav-material" id="top-tabContent">
                        <div class="tab-pane fade active show" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                            <div class="card dashboard-table mt-0">
                                <div class="card-body"> 
                                    <table class="table-responsive-md table mb-0 table-striped" id="example22">
                                        <thead>
                                            <tr>
                                                <th scope="col">Color</th>
                                                <th scope="col" class="text-left">product name</th>
                                                <th scope="col" class="text-right">price</th>
                                                <th scope="col" class="text-right">stock</th>
                                                <th scope="col" class="text-right">sales</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="serchInventory">
                                            @forelse($inventories as $row)
                                                <tr>
                                                    <td>{{$row->color_name}}</td>
                                                    <td class="text-left">{{$row->item->name}} 
                                                    </td>
                                                    <td class="text-right">{{number_format($row->price,2)}}</td>
                                                    <td class="text-right">{{$row->qty_stock}}</td>
                                                    <td class="text-right">2000</td>
                                                    <td class="">
                                                        <ul>
                                                            <li><a href="{{ url('merchant/sme/inventories/update/'.$row->slug.'/smeinventroyupdate') }}"><button class="btn btn-sm btn-warning" data-toggle="modal" data-original-title="test" data-target="#inventoryEditModal{{$row->id}}"><i class="fa fa-edit"></i> </button></a></li>
                                                            <li>
                                                                <form action="{{ url('/merchant/sme/inventories/'.$row->id) }}" method="post" style="margin-top:-2px" id="deleteButton{{$row->id}}">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="submit" class="btn btn-sm btn-primary" onclick="sweetalertDelete({{$row->id}})"><i class="fa fa-trash-o"></i></button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr> 
                                                @empty
                                                <tr>
                                                    <td colspan="7">No Product found</td>
                                                </tr> 
                                            @endforelse
                                        </tbody> 
                                    </table>
                                
                                </div>
                            </div>
                            <br>
                            <div>Showing {{ $inventories->firstItem() }} to {{ $inventories->lastItem() }} of total {{$inventories->total()}} entries</div>
                            {{$inventories->links()}}
                        </div>
                        <div class="tab-pane fade" id="top-profile" role="tabpanel" aria-labelledby="profile-top-tab">
                            <div class="card dashboard-table mt-0">
                                <div class="card-body">
                                    <table class="table-responsive-md table mb-0 table-striped" id="example23">
                                        <thead>
                                            <tr>
                                                <th scope="col">Color</th>
                                                <th scope="col" class="text-left">product name</th>
                                                <th scope="col" class="text-right">price</th>
                                                <th scope="col" class="text-right">stock</th>
                                                <th scope="col" class="text-right">sales</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($inventoriesOutStock as $row)
                                                <tr>
                                                    <td>{{$row->color_name}}</td>
                                                    <td class="text-left">{{$row->item->name}}
                                                    </td>
                                                    <td class="text-right">{{number_format($row->price,2)}}</td>
                                                    <td class="text-right">{{$row->qty_stock}}</td>
                                                    <td class="text-right">2000</td>
                                                    <td class="d-flex justify-content-between">
                                                        <ul>
                                                            <li><a href="{{ url('merchant/inventories/update/'.$row->slug.'/invertoryupdate') }}" ><button class="btn btn-sm btn-warning" ><i class="fa fa-edit"></i> </button></a></li>
                                                            <li>
                                                                <form action="{{ url('/merchant/inventories/'.$row->id) }}" method="post" style="margin-top:-2px" id="deleteButton{{$row->id}}">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="submit" class="btn btn-sm btn-primary" onclick="sweetalertDelete({{$row->id}})"><i class="fa fa-trash-o"></i></button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="7">No Product found</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <br>
                            <div>Showing {{ $inventoriesOutStock->firstItem() }} to {{ $inventoriesOutStock->lastItem() }} of total {{$inventoriesOutStock->total()}} entries</div>
                            {{$inventoriesOutStock->links()}}

                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@push('js') 
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $('.js-example-basic-single').select2();
    $('#product').on('change',function(){
        var product = $(this).val();
        window.location.href = 'inventories?page=1&product='+product;
    });

    $(document).ready(function(){
        $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
            localStorage.setItem('activeTab', $(e.target).attr('href'));
        });
        var activeTab = localStorage.getItem('activeTab');
        if(activeTab){
            $('.myTab a[href="' + activeTab + '"]').tab('show');
        }
    });
</script>
@endpush




