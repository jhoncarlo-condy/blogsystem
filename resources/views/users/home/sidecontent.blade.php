
<aside class="col-lg-4">
    <!-- Widget [Search Bar Widget]-->
    <div class="widget search">
      <header>
        <h3 class="h6">Search the blog</h3>
      </header>
      <form action="#" class="search-form">
        <div class="form-group">
          <input type="search" placeholder="What are you looking for?">
          <button type="submit" class="submit"><i class="icon-search"></i></button>
        </div>
      </form>
    </div>
    <!-- Widget [Latest Posts Widget]        -->
    <div class="widget latest-posts">
      <header>
        <h3 class="h6">Latest Posts</h3>
      </header>
      @forelse ($latest->take(3) as $latest)
      <div class="blog-posts">
        <a href="#">
          <div class="item d-flex align-items-center">
            <div class="image">
                @if ($latest->image)
                <img src="{{ url('storage/'.$latest->image) }}" alt="..." class="img-fluid">
                @else

                @endif
            </div>
            <div class="title"><strong>{{ $latest->title }}</strong>
              <div class="d-flex align-items-center">
                <div class="views"><i class="fas fa-calendar fa-xs"></i>{{ $latest->created_at->format('m/d/Y')  }}</div>
                <div class="comments"><i class="fas fa-clock fa-xs"></i>{{ $latest->created_at->format('H:i A')  }}</div>
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
      <div class="item d-flex justify-content-between"><a href="#">{{ $category->title }}</a><span>12</span></div>
      @empty
      <div class="item d-flex justify-content-between"><a href="#">No Categories Available</div>
      @endforelse
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
