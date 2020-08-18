@extends('admin.layout.master')

@section('content')
@push('css')
<style>
    .fa{
        padding:4px;
      font-size:16px;
    }
    @media (min-width: 768px) {
        .modal-xl {
            width: 90%;
            max-width:1200px;
        }
    }
    .imagestyle{
        width: 249px;
        height: 244px;
        /* border-width: 1px;
        border-style: solid;
        border-color: #ccc;
        border-bottom: 0px;
        padding: 10px; */
    }
    .mt-10{
        margin-top: 130px;
    }
    .modal-logo{
        margin-right: 12px;
        background: #ddd;
        padding: 10px;
    }
</style>
@endpush
@include('elements.alert')
@component('admin.layout.inc.breadcrumb')
  @slot('pageTitle')
  E-commerce Product
  @endslot
  @slot('page')
      <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
      <li class="breadcrumb-item active" aria-current="page"> E-commerce Product </li>
  @endslot
@endcomponent
<div class="container-fluid">
    <div class="row products-admin ratio_asos">
        @foreach($items as $row)
            <div class="col-xl-3 col-sm-6">

                <div class="card">
                    <div class="card-body product-box">
                        <div class="img-wrapper">
                            <div class="">
                                @foreach($row->itemimage as $itemimg)
                                    @if($loop->first)
                                        <a href="{{ url('/merchant/e-commerce/products/'.$row->slug) }}"><img src="{{ !empty($row->image) ? asset($row->image) : asset('/uploads/shops/products/product.png') }}" class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                    @endif
                                @endforeach 
                            </div>
                        </div>
                        <div class="product-detail">
                            <div class="rating">
                                @if($row->status == 'Pending')
                                    <label class="badge badge-pill badge-info p-2">Pending</label>
                                @elseif($row->status == 'Active')
                                    <label class="badge badge-pill badge-success p-2">Active</label>
                                @else
                                    <label class="badge badge-pill badge-primary p-2">Reject</label>
                                @endif
                            </div>
                            <a href="{{ url('/merchant/product/'.$row->slug) }}">
                                <h6>{{ $row->name}}</h6>
                            </a>
                            <h4>${{$row->price}}</h4>
                            <ul class="color-variant">
                                @foreach($row->inventory as $color)
                                 <li class="bg-light0" style="background:{{ $color->color_name }}"></li>
                                @endforeach 
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
</div>
@endsection
