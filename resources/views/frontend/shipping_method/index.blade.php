@extends('admin.layout.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Manage Promotion Plan</h5>
                    </div>
                    <div class="card-body order-datatable">
                        <table class="display" id="basic-1">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Name</th>
                                <th>Fees</th>
                                <th>Description</th>
                                <th>Currier Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $i=0; @endphp
                              @foreach($shippingmethod as $row)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->fees }}</td>
                                <td>{{ $row->desc }}</td>
                                <td>{{ $row->courier->name }}</td>
                                <td>
                                    <ul class="list-inline">
                                        <li class="list-inline-item"><a href="{{ url('/andbaazaradmin/shippingmethod/'.$row->slug) }}" title="Show" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> </a> </li>
                                        <li class="list-inline-item"><a href="{{ url('/andbaazaradmin/shippingmethod/'.$row->slug).'/edit' }}" title="Show" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> </a> </li>
                                        <li class="list-inline-item">
                                            <form action="{{ url('/andbaazaradmin/shippingmethod/'.$row->slug) }}" method="post" style="margin-top:-2px" id="deleteButton{{$row->id}}">
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
