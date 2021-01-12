@extends('admin.layout.master')

@section('content')
    {{--  Page Bradecome Start --}}
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Agents
                            <small>ANDBazar Admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="/"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Pending agents</li>
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
                        <h5> Pending Agent List</h5>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-borderd" id="showInDataTable">
                            <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Phone No</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Joined At</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pending_agents as $index=>$agent)
                                <tr>
                                    <td><img class="img-fluid" src="{{ (!is_null($agent->agentDetails['picture'])) ? $agent->agentDetails['picture'] : asset('images/avatar-user.png') }}" style="height: 50px"></td>
                                    <td>{{ $agent->first_name . " " .$agent->last_name}}</td>
                                    <td>{{ $agent->phone }}</td>
                                    <td>{{ $agent->email }}</td>
                                    <td>{{ $agent->agentDetails['gender'] }}</td>
                                    <td>{{ $agent->created_at->format('Y-m-d') }}</td>
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
