@extends('auth.auth-master')
@section('content')
@push('css')
<style>
    .padding{
        /* padding: 12px!important; */
    }
    #text{
        letter-spacing: 10px;
    /* font-family: monospace;
    font-size: 40px;
    padding-left: 65px;   
    letter-spacing: 50px;   */
}
.w-60{
    width: 60%;
}
</style>
@endpush
@include('elements.alert')
<div class="row">
    <div class="col-md-5 p-0 card-left">
    </div>
    <div class="col-md-7 p-0 card-right p">
        <div class="card tab2-card pt-5 pb-5">
            <div class="card-body">
                <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="contact-top-tab" data-toggle="tab" href="#top-contact" role="tab" aria-controls="top-contact" aria-selected="false"><span class="icon-unlock mr-2"></span>Verify Token</a> 
                    </li>
                </ul>
                    
                    @if (\Session::has('error'))
                        <div class="alert alert-danger">
                                <p class="text-muted font-weight-bold">{!! \Session::get('error') !!}</p>
                        </div>
                    @endif

                      
                    <form class="form-horizontal auth-form" action="{{ route('postToken') }}" method="post" enctype="multipart/form-data" id="validateForm">
                        @csrf 
                            <div class="form-group pt-3 pb-3">
                                <input required  name="verification_token"  type="text" id="text" maxlength="5" class="form-control font-weight-bold @error('verification_token') border-danger @enderror"  placeholder="" id="exampleInputEmail12"> 
                                <span class="text-danger">{{$errors->first('verification_token')}}</span>
                            </div>  
                            <div class="form-button text-right">
                                <button class="btn btn-success" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Verify</button> 
                            </div> 
                        </form>
                        <span class="btn disabled" id="Resend" type="submit"> <i class="fa fa-refresh"></i> Resend <span class="c"></span></span> 
                    </div>
        </div>
    </div>
</div> 

@endsection
<style>
    .disabled{
        pointer-events: none;
    }
</style>
@push('js')
    <script>
        $('#Resend').click(function(){
            // console.log('dd');
            $('#resendform').submit();
        });

        $(document).ready(function(){
            c();
        });

        function c(){
            var n=60;
            var c=n;
            $('.c').text(c);
            setInterval(function(){
                c--;
                if(c>=0){
                    $('.c').text(c);
                }
                if(c==0){
                    $('.c').text('');
                    $('#Resend').removeClass('disabled');
                }
            },1000);
        }
    </script>
@endpush

