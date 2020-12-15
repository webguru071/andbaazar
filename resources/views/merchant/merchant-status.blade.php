@if($seller->status == 'Inactive')
<div class="card">
    <div class="card-body">
        <p class="lead text-danger">
            Hi <b>{{Auth::user()->first_name}}</b>,<br />
            <br />
            Your account hass been under review. We will review it soon. Please put your rich information and <a href="{{url('merchant/profile')}}">profile</a> and <a href="{{url('merchant/shop')}}">shop</a>.<br />
            <br />
            <b>Andbaazar</b>
        </p>
    </div>
</div>
<br />
@elseif($seller->status == 'Reject')
<div class="card">
    <div class="card-body">
        <p class="lead text-danger">
            Hi <b>{{Auth::user()->first_name}}</b>,<br />
            <br />
            Sorry your account has been rejected for.<br />
            <br />

            @php $i=0; @endphp @foreach($seller->rejectvalue as $row)
        </p>

        <ol>
            <span class="text-danger">{{ ++$i }} .</span>
            <li><b class="text-danger">{{$row->rej_name." "}}</b></li>
        </ol>
        @endforeach

        <br />
        <br />
        Please put your rich information and <a href="{{url('merchant/profile')}}">profile</a> and <a href="{{url('merchant/shop')}}">shop</a>.<br />
        <br />
        <b>Andbaazar</b>

        <p>
            <a href="#" id=""><button class="btn btn-sm btn-solid float-right" data-toggle="modal" data-original-title="test" data-target="#merchantStatusModal{{ $seller->id }}">Re-submit</button></a>
        </p>
    </div>
</div>
<div class="modal fade" id="merchantStatusModal{{ $seller->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-600" id="exampleModalLabel">Re-submit</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>

            <div class="modal-body">
                <form class="needs-validation" novalidate="" action="{{ url('merchant/resubmit/'.$seller->id) }}" method="post" enctype="multipart/form-data" id="myform">
                    @csrf
                    @method('put')
                    <div class="form"></div>
                    <div class="form">
                        If you fill your all information.Please fill the yes check box and click submit.
                    </div>
                    <div class="form-terms mt-2">
                        <div class="custom-control custom-checkbox mr-sm-2">
                            <!-- <input type="checkbox" name="yes" class="custom-control-input @error('yes') border-danger @enderror" id="customControlAutosizing1">
                            @foreach($seller->rejectvalue as $row)
                            <label class="custom-control-label" for="customControlAutosizing1">
                            <b ">{{$row->rej_desc." "}}</b>
                             </label>
                            @endforeach
                            <br>
                            <span class="text-danger">{{ $errors->first('yes') }}</span> -->

                            <!-- <label for="option">

                                @foreach($seller->rejectvalue as $row)

                                <input type="checkbox" name="checkbox" class = "mr-5" id="option{{$row->id}}"/>
                                <span></span>
                                <p>{{$row->rej_desc." "}}</p>
                                @endforeach
                            </label> -->
                        </div>
                        <!-- @foreach($seller->rejectvalue as $row)
                        <div class="item">
                            <input type="checkbox" name="checkboxes[] class = "checkboxes mr-2" id="option{{$row->id}}"/>
                            <label for="a">{{$row->rej_desc." "}}</label>
                        </div>
                        @endforeach   -->

                        @foreach($seller->rejectvalue as $row)
                        <div class="item">
                            <input type="checkbox" name="checkboxes[]" class="checkboxes mr-2" id="option{{$row->id}}" />
                            <label for="a">{{$row->rej_name." "}}</label>
                        </div>
                        @endforeach

                        <div class="item"><input id="checkall" class="" type="checkbox" /> Select All</div>
                    </div>
                    <!--
                        <input type="checkbox" name="checkbox" class="custom-control-input @error('checkbox') border-danger @enderror" id="customControlAutosizing1">
                        <span class="text-danger">{{ $errors->first('checkbox') }}</span> -->

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-solid" type="button">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<br />
@endif @push('css')
<style>
    .my-error-class {
        color: red;
        /* margin-left: -120000cm!important; */
        float: left;
    }
</style>
@endpush @push('js')
<!-- <script>
    $(document).ready(function () {
        $('#myform').validate({
            errorClass: "my-error-class",
            rules: {
                checkbox:{
                    required: true,
                }
            },
            messages: {
                checkbox: {
                        required: "please check all  field.",
                    },

                }
        });

    });
</script> -->

<script>
    $("#checkall").click(function () {
        if ($("#checkall").is(":checked")) {
            $(".checkboxes").each(function () {
                $(this).prop("checked", true);
            });
        } else {
            $(".checkboxes").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
</script>

@endpush
