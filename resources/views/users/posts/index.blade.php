@extends('users.layouts.app')
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
@section('link')
<li class="nav-item"><a href="{{ route('post.index') }}" class="nav-link active">Home</a>
</li>
<li class="nav-item"><a href="{{ route('category.index') }}" class="nav-link ">Categories</a>
</li>
@if (Auth::user())
<li class="nav-item"><a href="{{ route('profile.index') }}" class="nav-link ">Profile</a>
</li>
@endif
@endsection
@section('content')
<section style="background: url('https://images.unsplash.com/photo-1432821579285-1b649e5b1ce3?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80'); background-size: cover; background-position: center center" class="hero">
    <div class="container">
      <div class="row">
        <div class="col-lg-7">
          <h1>Welcome to Creator's Blog <br>- An open source blogging website</h1>
        </div>
      </div><a href=".intro" class="continue link-scroll"><i class="fas fa-long-arrow-alt-down    "></i> See posts below</a>
    </div>
  </section>
<div class="container">
    <div class="row">
      <!-- Latest Posts -->
      <main class="posts-listing col-lg-8">
        <div class="container">
          <div class="row">
            <!-- post -->
            @forelse ($posts as $post)
            <div class="post col-xl-6">
                <div class="post-thumbnail">
                    @if($post->image)
                    <a href="{{ route('post.show',$post->id) }}">
                     <img src="{{ asset('storage/'. $post->image) }}"  class="img-thumbnail" style="height: 200px;width:400px;">
                    </a>
                    @else
                    <a href="{{ route('post.show', $post->id) }}">
                    <img class="img-thumbnail" style="width:400px;height:200px;" src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg" alt="">
                    </a>
                    @endif
                </div>
                <div class="post-details">
                  <div class="post-meta d-flex justify-content-between">
                        <div class="date meta-last">{{ $post->created_at->format('m d') . "|" . $post->created_at->format('Y') }}</div>
                        <div class="category"><a href="{{ route('post.show', $post->id) }}">{{ $post->category->title }}</a></div>
                  </div><a href="{{ route('post.show', $post->user->id) }}">
                    <h3 class="h4">{{ $post->title }}</h3></a>
                  <p class="text-muted">See more ..</p>
                  @auth
                  @if ($post->user->id == Auth::user()->id)
                  <footer class="post-footer d-flex align-items-center"><a href="#" class="author d-flex align-items-center flex-wrap">
                      {{-- <div class="avatar"><img src="img/avatar-3.jpg" alt="..." class="img-fluid"></div> --}}
                      <a href="{{ route('profile.index') }}">
                      <div class="title">
                          <i class="fas fa-user fa-xs"></i><span>Me</span>
                      </div></a>
                  <div class="date"><i class="fas fa-clock fa-xs"></i>{{ $post->created_at->diffForHumans() }}</div>
                  <div class="comments meta-last"><i class="fas fa-comment fa-xs"></i></i>{{ count($post->comments) }}</div>
                  </footer>
                  @endauth
                  @else
                  <footer class="post-footer d-flex align-items-center"><a href="#" class="author d-flex align-items-center flex-wrap">
                        {{-- <div class="avatar"><img src="img/avatar-3.jpg" alt="..." class="img-fluid"></div> --}}
                        <a href="{{ route('profile.show',$post->user_id) }}">
                        <div class="title">
                            <i class="fas fa-user fa-xs"></i><span>{{ $post->user->firstname }}</span>
                        </div></a>
                    <div class="date"><i class="fas fa-clock fa-xs"></i>{{ $post->created_at->diffForHumans() }}</div>
                    <div class="comments meta-last"><i class="fas fa-comment fa-xs"></i></i>{{ count($post->comments) }}</div>
                  </footer>
                  @endif
                </div>
              </div>
            @empty
              Empty
            @endforelse
          </div>
          <!-- Pagination -->
          <nav aria-label="Page navigation example">
            {{-- <ul class="pagination pagination-template d-flex justify-content-center">
              <li class="page-item"><a href="#" class="page-link"> <i class="fa fa-angle-left"></i></a></li>
              <li class="page-item"><a href="#" class="page-link active">1</a></li>
              <li class="page-item"><a href="#" class="page-link">2</a></li>
              <li class="page-item"><a href="#" class="page-link">3</a></li>
              <li class="page-item"><a href="#" class="page-link"> <i class="fa fa-angle-right"></i></a></li>
            </ul> --}}
            <div class="d-flex justify-content-center">
                {{ $posts->links() }}
            </div>

          </nav>
        </div>
      </main>


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


      </div>
  </div>
@endsection
@push('scripts')

@endpush

