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
        @include('layouts.inc.sidebar.vendor-sidebar',[$active ='newsfeed'])
        <div class="col-md-9"> 
            <img src="{{url($feed->image)}}" width="100%" alt="feed img">
            <h3 class="mt-4">{{$feed->title}}</h3>
            <p class="lead text-justify">
                {!!$feed->news_desc!!}
            </p>
            <hr>

            @forelse ($comments as $parent_comment)
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
            @endforelse
            
        </div>
      </div>
  </div>

  <!-- Button trigger modal -->

  
  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
  </div>

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




