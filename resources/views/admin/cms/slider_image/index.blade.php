@extends('admin.layout.master')

@section('content')
    {{--  Page Bradecome Start --}}
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Slider Images
                            <small>ANDBazar Admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="/"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">CMS</li>
                        <li class="breadcrumb-item active">Slider Images</li>
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
                                <h5>Slider Images</h5>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ action('Admin\KrishiBazarSliderController@create') }}" class="btn btn-secondary pull-right">+ Add New Slider</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        @include('flash::message')
                        <table class="table table-borderd" id="showInDataTable">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Slider URL</th>
                                <th>Details</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($all_sliders as $index=>$slider)
                                    <tr>
                                        <td><img class="img-fluid" src="{{ $slider->slider_image }}" style="height: 50px"></td>
                                        <td>{{ $slider->slider_url }}</td>
                                        <td>{{ Str::words($slider->slider_details, 5, ' >>>') }}</td>
                                        <td>{{ ($slider->status==1) ? 'Active' : 'Inactive' }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-success btn-xs" href="{{ action('Admin\KrishiBazarSliderController@edit',$slider->id) }}">Edit</a>
                                            <form action="{{ action('Admin\KrishiBazarSliderController@destroy',$slider->id) }}" id="deleteButton{{ $slider->id }}" method="post" style="display: inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-primary btn-xs" name="remove_slider_group" type="submit" onclick="makeDeleteRequest(event, '{{ $slider->id  }}')">Delete</button>
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
