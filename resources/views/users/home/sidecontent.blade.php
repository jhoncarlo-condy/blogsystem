
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function()
    {
        $('#button').click(function()
        {
            $('#showall').load('{{ route('list') }}').fadeIn("slow");
        });
    });
</script>
@endpush
<aside class="col-lg-4">

@if (Auth::user())
<div class="widget latest-posts">
    <header>
      <h3 class="h6">Your Recent Posts</h3>
    </header>
    @forelse ($myrecent as $recent)
    <div class="blog-posts">
      <a href="{{ route('post.show',$recent->id) }}">
        <div class="item d-flex align-items-center">
          <div class="image">
              @if ($recent->image)
              <img src="{{ url('storage/'.$recent->image) }}" alt="..." class="img-fluid">
              @else
              <img class="img-fluid" src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg" alt="">
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
@endif

    <div class="widget latest-posts">
      <header>
        <h3 class="h6">Latest Posts</h3>
      </header>
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
    </div>
    <!-- Widget [Categories Widget]-->
    <div class="widget categories" id="showall">
      <header>
        <h3 class="h6">Categories</h3>
      </header>
      @forelse ( $categories as $category )
      <div class="item d-flex justify-content-between">
        <a href="{{ route('category.show',$category->id) }}">{{ $category->title }}</a>
        <span>({{ count($category->post) }})</span>
      </div>
      @empty
      <div class="item d-flex justify-content-between"><a href="#">No Categories Available</div>
      @endforelse
      {{-- {{ $categories->links() }} --}}
      <div class=" d-flex justify-content-between">
        <button type="button" id="button" class="btn btn-secondary">
          See All&rarr;
        </button>

        </div>
    </div>

  </aside>
