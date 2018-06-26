@foreach($comments as $comment)
      @include('comment.comment',['v'=>$comment])              
@endforeach