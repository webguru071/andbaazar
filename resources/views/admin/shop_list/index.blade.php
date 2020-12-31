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
</style>
@endpush
@include('elements.alert')
@component('admin.layout.inc.breadcrumb')
  @slot('pageTitle')
    Shop List
  @endslot
  @slot('page')
      <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
      <li class="breadcrumb-item active" aria-current="page">Shop List</li>
  @endslot
@endcomponent
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5> Shop List</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderd" id="dataTableNoPagingDesc">
                            <thead>
                              <tr>
                                 <th width="50">Sl</th>
                                 <th >Owner Name</th>
                                 <th >Shop Name</th>
                                 <th > Website</th>
                                 <th >Logo</th>
                                 <th  class="text-center">Action</th>
                              </tr>
                          </thead>
                        <tbody>
                          @php $i=0; @endphp
                           @foreach($shop as $row)
                           <tr>
                               <td>{{ ++$i }}</td>
                              <td>{{ $row->seller['first_name'] . " " .$row->seller['last_name'] }}</td>
                               <td>{{ $row->name }}</td>
                               <td>{{ $row->web }}</td>
                               <td><img  src="{{ !empty($row->logo) ? asset($row->logo) : asset('/uploads/shops/logos/shop-1.png') }}" style = "height:40px;width:70px;"></td>
                               <td class="d-flex justify-content-between">
                                   <ul>
                                        <li><a href="#" id="{{ url('/andbaazaradmin/shop/'.$row->slug).'/view' }}"><button class="btn btn-sm btn-secondary"  data-toggle="modal" data-original-title="test" data-target="#tagEditModal{{$row->id}}"> View</button></a></li>
                                        <li>
                                    </li>
                                   </ul>
                               </td>
                            </tr>
                            <div class="modal fade" id="tagEditModal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title f-w-600" id="exampleModalLabel"> Shop Details</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        </div>
                                          <div class="modal-body">
                                            <form class="needs-validation" novalidate="" action={{ url('/andbaazaradmin/shop/'.$row->slug) }} method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('put')
                                                <div class="form">
                                                    <div class="col-md-12">
                                                        <div class="float-right">
                                                            <h3 class="display-5 font-weight-bold">Owner Details</h3>
                                                            <div> {{ $row->seller->first_name . " " .$row->seller->last_name}}</div>
                                                            <div> {{ $row->seller->email }}</div>
                                                            <div> {{ $row->seller->phone }}</div>
                                                        </div>
                                                        <div class="float-left modal-logo">
                                                            <img  src="{{ !empty($row->logo) ? asset($row->logo) : asset('/uploads/shops/logos/shop-1.png') }}" width="100" height="100" class="pl-3 pr-3 pb-3 pr-0" >
                                                        </div>
                                                        <div>
                                                            <h3 class="display-5 font-weight-bold">{{ $row->name }}</h3>
                                                            <p>{{ $row->web }}</p>
                                                        </div>

                                                        <br>
                                                        <div class="d-inline-block mt-3">
                                                            <p class="text-justify">{{ $row->description }}</p>
                                                            <h5>{{ $row->featured }}</h5>
                                                            <h6>{{ $row->email }}</h6>
                                                            <h6>{{ $row->phone }}</h6>
                                                        </div>
                                                </div>
                                                {{-- <div class="col-md-7">
                                                    <div class="float-left modal-logo">
                                                        <img  src="{{ asset($row->logo) }}" style = "height:70px;width:80px;padding:7px;">
                                                    </div>
                                                    <div>
                                                        <h3 class="display-5 font-weight-bold">{{ $row->name }}</h3>
                                                        <p>{{ $row->web }}</p>
                                                    </div>

                                                    <br>
                                                    <div class="d-inline-block mt-3">
                                                        <p class="text-justify">{{ $row->description }}</p>
                                                        <h5>{{ $row->featured }}</h5>
                                                        <h6>{{ $row->email }}</h6>
                                                        <h6>{{ $row->phone }}</h6>
                                                    </div>
                                            </div>                             --}}
                                            </form>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                           @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection
