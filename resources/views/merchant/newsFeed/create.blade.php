@extends('merchant.master')

@section('content')
@push('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
<style>
    .imagestyle{
        width: 200px;
        height: 200px;
        border-width: 1px;
        border-style: solid;
        border-color: #ccc;
        border-bottom: 0px;
        padding: 10px;
    }

    #file-upload{
        display: none;
    }
    .uploadbtn{
        width: 200px;background: #ddd;float: left;text-align: center;
    }
    .custom-file-upload {
        /* border: 1px solid #ccc; */
        display: inline-block;
        padding: 9px 40px;
        cursor: pointer;
        border-top: 0px;
    }
</style>
@include('elements.alert') 
    <section class="dashboard-section section-b-space">
        <div class="container">
            <div class="row">

                @include('layouts.inc.sidebar.vendor-sidebar',[$active='newsfeed'])

                <div class="col-sm-9">
                 <h3>Add News Feed</h3>
                 <div class="card">
                        <div class="card-body">
                        <form class="them-form" action="{{ route('NewsFeed') }}" method="post" enctype="multipart/form-data" id="validateForm">
                                @csrf 
                                <div class="form-row">
                                    <div class="col-md-4 text-left">
                                        <label for="image">News Feed Image</label>
                                        <div class="mt-0"> 
                                            <img id="output" class="imagestyle" src="{{ asset('/uploads/newsfeed_image/newsfeed-4.png') }}"/> 
                                        </div>
                                        <div class="uploadbtn">
                                            <label for="file-upload" class="custom-file-upload">Upload Here</label>
                                            <input id="file-upload" type="file" name="image" onchange="loadFile(event)"/> 
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mt-4">
                                        <label for="title">Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title" id="title" class="form-control @error('title') border-danger @enderror" value="{{ old('title') }}">
                                        <span class="text-danger" id="message_title"></span>
                                        @if ($errors->has('title'))
                                            <span class="text-danger">{{ $errors->first('title') }}</span>
                                        @endif 
                                    </div> 
                                </div> 
                                <div class="form-row">
                                    <div class="col-md-12 mt-4">
                                        <label for="news_desc" class="">Description<span class="text-danger"> *</span></label>
                                        <textarea class="form-control summernote @error('news_desc') border-danger @enderror"  id="newsDesctiption"  name="news_desc"></textarea>
                                        <span class="text-danger" id="message_news_desc"></span>
                                        @if ($errors->has('news_desc'))
                                            <span class="text-danger">{{ $errors->first('news_desc') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-12 mt-4">
                                        <button type="submit" class="btn btn-sm btn-solid" >Save</button>
                                        <a href="{{ url('merchant/newsfeed') }}" class="btn btn-sm btn-solid" >Back</a>
                                    </div>
                                </div> 
                            </form>
                        </div> 
                </div>
            </div>
        </div>
</section>
    <!--  dashboard section end -->
@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
            $('.summernote').summernote({
                height: 300,
            });
        });
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
    };
</script>
@endpush
