@extends('auth.auth-master')
@section('content')
@include('elements.alert')
<div class="row">
    <div class="col-md-5 p-0 card-left"></div>
    <div class="col-md-7 p-0 card-right p">
        <div class="text-right">
            <span class=""> {{  $seller->verification_token }}</span>
        </div>
        <div class="card tab2-card pt-5 pb-5">
            <div class="card-body">
                <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="contact-top-tab" data-toggle="tab" href="#top-contact" role="tab" aria-controls="top-contact" aria-selected="false"><span class="icon-unlock mr-2"></span>Verify Token</a>
                    </li>
                </ul>

                @if(session('flash_notification'))
                    <div class="flash-message">
                        @include('flash::message')
                    </div>
                @endif

                <form action="{{ route('postToken') }}" method="post" class="digit-group text-center p-4" data-group-name="digits" data-autosubmit="false" autocomplete="off">
                    @csrf
                    <input type="hidden" name="token" value={{ $seller->remember_token }}>
                    <input type="text" id="digit-1" name="digit[]" data-next="digit-2" />
                    <input type="text" id="digit-2" name="digit[]" data-next="digit-3" data-previous="digit-1" />
                    {{-- <span class="splitter">&ndash;</span> --}}
                    <input type="text" id="digit-3" name="digit[]" data-next="digit-4" data-previous="digit-2" />
                    <input type="text" id="digit-4" name="digit[]" data-next="digit-5" data-previous="digit-3" />
                    <input type="text" id="digit-5" name="digit[]" data-next="digit-6" data-previous="digit-4" />

                    <div class="form-button mt-4 pt-4 text-right">
                        <button class="btn btn-success" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Verify</button>
                    </div>
                </form>
                <span class="btn disabled" id="Resend" type="submit"> <i class="fa fa-refresh"></i> Resend <span class="c"></span></span>
            </div>
            <form action="{{ route('updateToken') }}" method="post" id="resendform" style="d-none">
                @csrf
                <input type="hidden" name="token" value={{$seller->remember_token}}>
            </form>
        </div>
    </div>
</div>

@endsection
<style>
    .disabled{
        pointer-events: none;
    }
    .digit-group input {
    width: 30px;
    height: 50px;
    background-color: #727272;
    border: none;
    line-height: 50px;
    text-align: center;
    font-size: 24px;
    font-family: "Raleway", sans-serif;
    font-weight: 200;
    color: white;
    margin: 0 2px;
    }
    .digit-group .splitter {
    padding: 0 5px;
    color: rgb(17, 16, 16);
    font-size: 24px;
    }

    .prompt {
    margin-bottom: 20px;
    font-size: 20px;
    color: white;
    }
</style>
@push('js')
    <script>
        $('.digit-group').find('input').each(function() {
            $(this).attr('maxlength', 1);
            $(this).on('keyup', function(e) {
                var parent = $($(this).parent());

                if(e.keyCode === 8 || e.keyCode === 37) {
                    var prev = parent.find('input#' + $(this).data('previous'));

                    if(prev.length) {
                        $(prev).select();
                    }
                } else if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
                    var next = parent.find('input#' + $(this).data('next'));

                    if(next.length) {
                        $(next).select();
                    } else {
                        if(parent.data('autosubmit')) {
                            parent.submit();
                        }
                    }
                }
            });
        });

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

