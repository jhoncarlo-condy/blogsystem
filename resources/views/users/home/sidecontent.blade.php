
<aside class="col-lg-4">

    <div class="widget latest-posts">
        <header>
          <h3 class="h6">Your Recent Posts</h3>
        </header>
        @forelse ($myrecent->take(3) as $recent)
        <div class="blog-posts">
          <a href="{{ route('blog.show',$recent->id) }}">
            <div class="item d-flex align-items-center">
              <div class="image">
                  @if ($recent->image)
                  <img src="{{ url('storage/'.$recent->image) }}" alt="..." class="img-fluid">
                  @else

                  @endif
              </div>
              <div class="title"><strong>{{ $recent->title }}</strong>
                <div class="d-flex align-items-center">
                  <div class="views"><i class="fas fa-user fa-xs"></i>Me</div>
                  <div class="comments"><i class="fas fa-clock fa-xs"></i>{{ $recent->created_at->diffForHumans() }}</div>
                </div>
              </div>
            </div>
          </a>
        </div>
        @empty

        @endforelse
      </div>

    <div class="widget latest-posts">
      <header>
        <h3 class="h6">Latest Posts</h3>
      </header>
      @forelse ($latest->take(3) as $latest)
      <div class="blog-posts">
        <a href="{{ route('blog.show',$latest->id) }}">
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
    </div>
    <!-- Widget [Categories Widget]-->
    <div class="widget categories">
      <header>
        <h3 class="h6">Categories</h3>
      </header>
      @forelse ( $categories->take(7) as $category )
      <div class="item d-flex justify-content-between"><a href="#">{{ $category->title }}</a>
        <span>({{ $count->where('category_id',$category->id)->count() }})</span>
      </div>
      @empty
      <div class="item d-flex justify-content-between"><a href="#">No Categories Available</div>
      @endforelse
      <a href="{{ route('categories') }}"><div class=" d-flex justify-content-between">See All&rarr;</a></div>
      {{-- {{ $categories->links() }} --}}
    </div>
    <!-- Widget [Tags Cloud Widget]-->
    {{-- <div class="widget tags">
      <header>
        <h3 class="h6">Tags</h3>
      </header>
      <ul class="list-inline">
        <li class="list-inline-item"><a href="#" class="tag">#Business</a></li>
        <li class="list-inline-item"><a href="#" class="tag">#Technology</a></li>
        <li class="list-inline-item"><a href="#" class="tag">#Fashion</a></li>
        <li class="list-inline-item"><a href="#" class="tag">#Sports</a></li>
        <li class="list-inline-item"><a href="#" class="tag">#Economy</a></li>
      </ul>
    </div> --}}
  </aside>
