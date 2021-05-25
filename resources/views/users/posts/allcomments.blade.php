@foreach ($postcomments->comments as $postcomment)
<div class="comment-header d-flex justify-content-between">
    <div class="user d-flex align-items-center">
      {{-- <div class="image"><img src="img/user.sv  g" alt="..." class="img-fluid rounded-circle"></div> --}}

      <div class="title"><strong>{{ $postcomment->user->firstname }}</strong>
        <span class="date">{{ $postcomment->created_at->diffForHumans() }}</span>
      </div>
    </div>
  </div>
  <div class="comment-body">
    <p>{{ $postcomment->comment }}</p>
  </div>
@endforeach

