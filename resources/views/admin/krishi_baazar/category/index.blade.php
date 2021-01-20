@extends('admin.layout.master')

@section('content')
    {{--  Page Bradecome Start --}}
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Krishi Categories
                            <small>ANDBazar Admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="/"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Krishi</li>
                        <li class="breadcrumb-item active">Categories</li>
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
                            <div class="col-md-6">
                                <h5>Krishi Categories</h5>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ action('Admin\KrishiProductCategoryController@create') }}" class="btn btn-secondary pull-right">+ Add New Category</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        @include('flash::message')
                        <table class="table table-borderd" id="showInDataTable">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Parent Category</th>
                                <th>Icon</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($krishi_categories as $index=>$krishi_category)
                                <tr>
                                    <td>{{ $krishi_category->name }}</td>
                                    <td>{{ $krishi_category->slug }}</td>
                                    <td>{{ (!is_null($krishi_category->parent)) ? $krishi_category->parent['name'] : 'None' }}</td>
                                    <td><img class="img-fluid" src="{{ $krishi_category->icon }}" style="height: 50px"></td>
                                    <td>{{ ($krishi_category->active === 1) ? 'Active' : 'Inactive' }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-success btn-xs" href="{{ action('Admin\KrishiProductCategoryController@edit',$krishi_category->id) }}">Edit</a>
                                        <form action="{{ action('Admin\KrishiProductCategoryController@destroy',$krishi_category->id) }}" id="deleteButton{{ $krishi_category->id }}" method="post" style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-primary btn-xs" name="remove_slider_group" type="submit" onclick="makeDeleteRequest(event, '{{ $krishi_category->id  }}')">Delete</button>
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
