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
                    <h3>Auction Products</h3>
                    <a href="{{ url('merchant/auction/products/new') }}" class="btn btn-sm btn-solid">Add New</a>
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

@endpush
