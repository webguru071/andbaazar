@extends('admin.layout.master')

@section('content')
    <style>
        .imagestyle{
            width: 50px;
            height: 50px;
            border-width: 4px 4px 4px 4px;
            border-style: solid;
            border-color: #ccc;
        }
    </style>
    @include('admin.elements.alert')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Manage Order</h5>
                    </div>
                    <div class="card-body">
                        <table class="table" id="example">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Category</th>
                                <th>Thumb</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                          <tbody>
                            @php $i=0; @endphp
                            @foreach($category as $row)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $row->name }}</td>
                                <td>
                                    @if(!empty($row->thumb))
                                       <img class="imagestyle" src="{{ asset($row->thumb ) }}"></td>
                                    @else
                                        <img class="imagestyle" src="{{ asset('/uploads/category_image/user.png') }}">
                                    @endif
                                <td>
                                    <ul class="list-inline">
                                        <li class="list-inline-item"><a href="{{ url('/andbaazaradmin/category/'.$row->slug) }}" title="Show" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> </a> </li>
                                        <li class="list-inline-item"><a href="{{ url('/andbaazaradmin/category/'.$row->slug).'/edit' }}" title="Show" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> </a> </li>
                                        <li class="list-inline-item">
                                            <form action="{{ url('/andbaazaradmin/category/'.$row->slug) }}" method="post" style="margin-top:-2px" id="deleteButton{{$row->id}}">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </li>
                                    </ul>
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
@endsection
@push('js')
<script>
    $(document).ready(function() {
    $('#example').DataTable();
} );
    </script>
    @endpush
