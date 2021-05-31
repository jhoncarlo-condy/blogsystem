@forelse ($latest as $latest)
<div class="blog-posts">
  <a href="{{ route('post.show',$latest->id) }}">
    <div class="item d-flex align-items-center">
      <div class="image">
          @if ($latest->image)
          <img src="{{ url('storage/'.$latest->image) }}" alt="..." class="img-fluid">
          @else
          <img class="img-fluid" src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg" alt="">
          @endif
      </div>
      <div class="title"><strong>{{ $latest->title }}</strong>
        <div class="d-flex align-items-center">
          <div class="views"><i class="fas fa-calendar fa-xs"></i>{{ $latest->created_at->format('m/d/Y')  }}</div>
          <div class="comments"><i class="fas fa-clock fa-xs"></i>{{ $latest->created_at->format('h:i A')  }}</div>
        </div>
      </div>
    </div>
  </a>
</div>
@empty

@endforelse
