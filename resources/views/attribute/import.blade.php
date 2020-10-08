@extends('admin.layout.master')

@section('content') 
@push('css')
<style> 
    .fa{
        padding:4px;
      font-size:16px;
    }
    .m-top{
        margin-top:100px;
    }
</style>
@endpush
@include('elements.alert')
@component('admin.layout.inc.breadcrumb')
  @slot('pageTitle')
  Import / Export 
  @endslot
  @slot('page')
      <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
      <li class="breadcrumb-item active" aria-current="page"> Import / Export </li>
  @endslot
@endcomponent

    <div class="container-fluid">
        <div class="container m-top text-center">
            <h2 class="mb-4">
                Import and Export Attribute
            </h2>
    
            <form action="{{route('attributestore')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                    <div class="custom-file text-left">
                        <input type="file" name="file" required class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>

                <button class="btn btn-primary">Import data</button>

                <a class="btn btn-success" href="{{ route('export') }}">Export data</a>
              
                <a class="btn btn-secondary" href="{{ route('export') }}">Download Sample</a>
            </form>
        </div>
    </div>
</div>
@endsection



