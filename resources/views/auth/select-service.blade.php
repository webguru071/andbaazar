@extends('auth.auth-master')
@section('content')
@include('elements.alert')
@push('css')
    <style>
        .text-card-input {
            display: none;
        }
        .text-card {
            border: 1px solid;
            border-color: #BEC2C9;
            text-align: center;
            cursor: pointer;
            transition: .4s all ease-in-out;
        }
        .flat-icon {
            text-align: center;
            font-size: 40px;
        }
        .text-card:hover {
            background-color: #ff8084;
            color: white;
            border: 1px solid #ff8084;
        }

        .text-card-input:checked + .text-card {
            background-color: #ff8084;
            color: white;
            border: 1px solid #ff8084;
        }
    </style>
@endpush
<div class="row">
    <div class="col-md-5 p-0 card-left"></div>
    <div class="col-md-7 p-0 card-right">
        <div class="card tab2-card">
            <div class="card-body">
                <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="top-profile-tab" data-toggle="tab" href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="true"><span class="icon-settings mr-2"></span>Select service</a>
                    </li>
                </ul>

                @if(session('flash_notification'))
                    <div class="flash-message">
                        @include('flash::message')
                    </div>
                @endif

                <form class="form-horizontal" method="post" action="{{ action('AuthController@setDefaultService') }}">
                    @csrf
                    <div class="row">
                        @foreach($userServices as $userService)
                        <div class="col-md-6">
                            <label> 
                                <input type="radio" class="text-card-input radio_array" value="{{$userService}}" name="selected_service">
                                <div class="text-card">
                                <div class=""><img width="100%" height="180" src="/images/{{$userService}}.jpg" alt="" style="background: #f7f6fc;"></div>  
                                <div class="poroperty-name">
                                    {{ucfirst($userService)}}
                                </div>                                                  
                                </div>
                            </label>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="form-button text-right">
                        <button class="btn btn-primary" style="border-radius:5px" type="submit">Continue</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
    <script>
        $('.radio_array').on('click',function(){ 
            $("input:radio[name=selected_service]:checked")[0].checked = true;
        });
    </script>
@endpush