@extends('admin.layout.master')

@section('content')
    {{--  Page Bradecome Start --}}
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Krishi Products
                            <small>ANDBazar Admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="/"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Krishi</li>
                        <li class="breadcrumb-item active">Upcoming Products</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    {{--  Page Bradecome End --}}

    {{--  Page Content Start --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12">
                                <h5>Krishi Products</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        @include('flash::message')
                        <table class="table table-borderd" id="showInDataTable">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Available from</th>
                                <th>Available stock</th>
                                <th>Regular Price</th>
                                <th>Wholesale Price</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($upcoming_krishi_products as $index=>$krishi_product)
                                <tr>
                                    <td><img class="img-fluid" src="{{ Storage::url($krishi_product->thumbnail_image) }}" style="height: 50px"></td>
                                    <td>{{ $krishi_product->name }}</td>
                                    <td>{{ $krishi_product->category['name'] }}</td>
                                    <td>{{ $krishi_product->available_from }}</td>
                                    <td>{{ $krishi_product->available_stock }}</td>
                                    <td>{{ $krishi_product->price }}</td>
                                    <td>{{ $krishi_product->wholesale_price }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-success btn-xs" href="{{ action('Admin\KrishiProductController@show',$krishi_product->slug) }}">View</a>
                                        <form action="{{ action('Admin\KrishiProductController@destroy',$krishi_product->id) }}" id="deleteButton{{ $krishi_product->id }}" method="post" style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-primary btn-xs" name="remove_slider_group" type="submit" onclick="makeDeleteRequest(event, '{{ $krishi_product->id  }}')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--  Page Content Start --}}
@endsection

@push('js')
    <script>
        $('div.alert').delay(3000).fadeOut(350);
    </script>
@endpush
