@extends('merchant.master')
@section('content')
@push('css')
 <style>
     .modal {
  text-align: center;
}

@media screen and (min-width: 768px) { 
  .modal:before {
    display: inline-block;
    vertical-align: middle;
    content: " ";
    height: 100%;
  }
}

.modal-dialog {
  display: inline-block;
  text-align: left;
  vertical-align: middle;
  width: 1000px;
}

.title {
    font-size: 14px;
    font-weight:bold;
}
.komen {
    font-size:17px;
}
.media{
    margin: 20px 0;
}
.geser {
    margin-left:55px;
    margin-top:5px;
}
.media-body{
    background: #f8f8f8;
    margin-left: 5px;
    border-radius: 11px;
    padding: 8px;
}
.media-left img{
    border-radius: 50%;
}
.child{
    margin-left: 60px;
}

 </style>
@include('elements.alert')


<section class="dashboard-section section-b-space">
  <div class="container">
      <div class="row">
        @include('layouts.inc.sidebar.vendor-sidebar',[$active ='products'])
        <div class="col-md-9">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="filter-main-btn mb-2"><span class="filter-btn"><i class="fa fa-filter" aria-hidden="true"></i> filter</span></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="http://themes.pixelstrap.com/multikart/assets/images/fashion/pro/001.jpg" alt="First slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="http://themes.pixelstrap.com/multikart/assets/images/fashion/pro/001.jpg" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="http://themes.pixelstrap.com/multikart/assets/images/fashion/pro/001.jpg" alt="Third slide">
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 rtl-text">
                            <div class="product-right">
                                <h2>Women Pink Shirt</h2>
                                <h4><del>$459.00</del><span>55% off</span></h4>
                                <h3>$32.96</h3>
                                <div class="border-product">
                                    <h6 class="product-title">product details</h6>
                                    <p>Sed ut perspiciatis, unde omnis iste natus error sit voluptatem
                                        accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab
                                        illo inventore veritatis et quasi architecto beatae vitae dicta sunt,
                                        explicabo. Nemo enim ipsam voluptatem,</p>
                                </div>
                                <div class="border-product">
                                    <h6 class="product-title">share it</h6>
                                    <div class="product-icon">
                                        <ul class="product-social">
                                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                            <li><a href="#"><i class="fa fa-rss"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="border-product">
                                    <h6 class="product-title">Time Reminder</h6>
                                    <div class="timer">
                                        <p id="demo"><span>25 <span class="padding-l">:</span> <span class="timer-cal">Days</span> </span><span>22 <span class="padding-l">:</span> <span class="timer-cal">Hrs</span> </span><span>13 <span class="padding-l">:</span> <span class="timer-cal">Min</span> </span><span>57 <span class="timer-cal">Sec</span></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="tab-product m-0">
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                                <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-toggle="tab" href="#top-home" role="tab" aria-selected="true"><i class="icofont icofont-ui-home"></i>Description</a>
                                    <div class="material-border"></div>
                                </li>
                                <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-toggle="tab" href="#top-profile" role="tab" aria-selected="false"><i class="icofont icofont-man-in-glasses"></i>Details</a>
                                    <div class="material-border"></div>
                                </li>
                                <li class="nav-item"><a class="nav-link" id="contact-top-tab" data-toggle="tab" href="#top-contact" role="tab" aria-selected="false"><i class="icofont icofont-contacts"></i>Video</a>
                                    <div class="material-border"></div>
                                </li>
                            </ul>
                            <div class="tab-content nav-material" id="top-tabContent">
                                <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry. Lorem Ipsum has been the industry's standard dummy text ever
                                        since the 1500s, when an unknown printer took a galley of type and
                                        scrambled it to make a type specimen book. It has survived not only five
                                        centuries, but also the leap into electronic typesetting, remaining
                                        essentially unchanged. It was popularised in the 1960s with the release
                                        of Letraset sheets containing Lorem Ipsum passages, and more recently
                                        with desktop publishing software like Aldus PageMaker including versions
                                        of Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and
                                        typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                        text ever since the 1500s, when an unknown printer took a galley of type
                                        and scrambled it to make a type specimen book. It has survived not only
                                        five centuries, but also the leap into electronic typesetting, remaining
                                        essentially unchanged. It was popularised in the 1960s with the release
                                        of Letraset sheets containing Lorem Ipsum passages, and more recently
                                        with desktop publishing software like Aldus PageMaker including versions
                                        of Lorem Ipsum.</p>
                                </div>
                                <div class="tab-pane fade" id="top-profile" role="tabpanel" aria-labelledby="profile-top-tab">
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry. Lorem Ipsum has been the industry's standard dummy text ever
                                        since the 1500s, when an unknown printer took a galley of type and
                                        scrambled it to make a type specimen book. It has survived not only five
                                        centuries, but also the leap into electronic typesetting, remaining
                                        essentially unchanged. It was popularised in the 1960s with the release
                                        of Letraset sheets containing Lorem Ipsum passages, and more recently
                                        with desktop publishing software like Aldus PageMaker including versions
                                        of Lorem Ipsum.</p>
                                </div>
                                <div class="tab-pane fade" id="top-contact" role="tabpanel" aria-labelledby="contact-top-tab">
                                    <div class="mt-3 text-center">
                                        <iframe width="560" height="315" src="https://www.youtube.com/embed/BUWzX78Ye_8" allow="autoplay; encrypted-media" allowfullscreen=""></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

            <hr>

            {{-- @forelse ($comments as $parent_comment)
                <div class="media">
                    <div class="media-left">
                    <img src="http://fakeimg.pl/50x50" class="media-object" style="width:40px">
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading title">{{$parent_comment->user->first_name}}</h4>
                        <p>
                            {!!$parent_comment->comments!!}
                        </p>
                        <button type="button" onclick="replayComment({{$parent_comment->id}})" class="btn btn-primary">Reply</button>
                    </div>
                </div>
                 @foreach($parent_comment->getChilds($parent_comment->id)->get() as $child)
                    <div class="media child">
                        <div class="media-left">
                        <img src="http://fakeimg.pl/50x50" class="media-object" style="width:40px">
                        </div>
                        <div class="media-body">
                        <h4 class="media-heading title">{{$child->user->first_name}}</h4>
                        <p>
                            {!!$child->comments!!}
                        </p>
                        <button type="button" onclick="replayComment({{$parent_comment->id}})" class="btn btn-primary">Reply</button>
                        </div>
                    </div>
                @endforeach
                @empty
                    <p>No comments</p>
            @endforelse --}}
            
        </div>
      </div>
  </div>

  <!-- Button trigger modal -->

  
  <!-- Modal -->
  {{-- <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form action="{{url('merchant/newsfeed/comment-replay-merchant')}}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Write your comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="feed_id" id="" value="{{$feed->id}}">
                    <input type="hidden" name="parent_id" id="rowId" value="">
                    <textarea class="form-control summernote"  id="newsDesctiption"  name="comments_message"></textarea>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Post</button>
                </div>
            </div>
        </form>
    </div>
  </div> --}}

</section>
@endsection
@push('js') 
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
<!-- <script src="{{ asset('') }}/js/select2.min.js"></script> --> 
    <script>
        function replayComment(row){
            // $('#newsDesctiption').val('');
            $('#rowId').val(row);
            $('#exampleModalCenter').modal('show');
        }

        $(document).ready(function() {
            $('.summernote').summernote({
                height: 300,
            });
        });

</script>
@endpush




