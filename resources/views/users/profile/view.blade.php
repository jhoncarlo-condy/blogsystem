@extends('users.layouts.app')
@push('css')
<style>
    .image img
    {
        width:400px;
    }
</style>
@endpush
@section('link')
<li class="nav-item"><a href="{{ route('blog.index') }}" class="nav-link">Home</a>
</li>
<li class="nav-item"><a href="{{ route('categories') }}" class="nav-link">Categories</a>
</li>
<li class="nav-item"><a href="{{ route('profile') }}" class="nav-link active">Profile</a>
</li>
@endsection
@section('content')
<section style="background: url('https://images.unsplash.com/photo-1432821579285-1b649e5b1ce3?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80'); background-size: cover; background-position: center center" class="hero">
    <div class="container">
      <div class="row">
        <div class="col-lg-7">
          <h1>Bootstrap 4 Blog - A free template by Bootstrap Temple</h1><a href="#" class="hero-link">Discover More</a>
        </div>
      </div><a href=".intro" class="continue link-scroll"><i class="fa fa-long-arrow-down"></i> Scroll Down</a>
    </div>
  </section>
  <!-- Intro Section-->
 <div style=" height:50px;background-color: #e3dff0;">

 </div>
    {{-- <div class="row d-flex align-items-stretch">
            <div class="image col-lg-5"><img src="img/featured-pic-2.jpeg" alt="..."></div>
            <div class="text col-lg-7">
              <div class="text-inner d-flex align-items-center">
                <div class="content">
                  <header class="post-header">
                    <div class="category"><a href="#">Business</a><a href="#">Technology</a></div><a href="post.html">
                      <h2 class="h4">{{ $post->title }}</h2></a>
                  </header>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrude consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                  <footer class="post-footer d-flex align-items-center"><a href="#" class="author d-flex align-items-center flex-wrap">
                      <div class="avatar"><img src="img/avatar-2.jpg" alt="..." class="img-fluid"></div>
                      <div class="title"><span>John Doe</span></div></a>
                    <div class="date"><i class="icon-clock"></i> 2 months ago</div>
                    <div class="comments"><i class="icon-comment"></i>12</div>
                  </footer>
                </div>
              </div>
            </div>
          </div> --}}
  <section class="featured-posts no-padding-top">
    <div class="container">
        <div class="col-lg-8">
            <h2 class="h3">Your Recent Posts</h2>
            {{-- <p class="text-big">Place a nice <strong>introduction</strong> here <strong>to catch reader's attention</strong>. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderi.</p> --}}
        </div>
      <!-- Post-->
        @forelse ($posts->take(3) as $index=>$post)
        @if ($index == 0)
        <div class="row d-flex align-items-stretch">
            <div class="text col-lg-7">
              <div class="text-inner d-flex align-items-center">
                <div class="content">
                  <header class="post-header">
                    <div class="category"><a href="#">{{ $post->category->title }}</a></div><a href="post.html">
                      <h2 class="h4">{{ $post->title }}</h2></a>
                  </header>
                  <p class="text-muted">See more ..</p>
                  <footer class="post-footer d-flex align-items-center"><a href="#" class="author d-flex align-items-center flex-wrap">
                      {{-- <div class="avatar"></div> --}}
                      <div class="title"><i class="fas fa-user-alt fa-xs"></i><span>{{ $post->user->firstname . " " . $post->user->lastname }}</span></div></a>
                    <div class="date"><i class="fas fa-clock fa-xs"></i>2 months ago</div>
                    <div class="comments"><i class="icon-comment"></i>12</div>
                  </footer>
                </div>
              </div>
            </div>
            <div class="image col-lg-5">
            @if ($post->image)
            <img src="{{ asset('storage/'. $post->image) }}">
            @endif
            </div>
        </div>
        @elseif($index % 4 <2)
        <div class="row d-flex align-items-stretch">
            <div class="image col-lg-5">
            @if ($post->image)
            <img src="{{ asset('storage/'.$post->image) }}" alt="...">
            @endif
            </div>
            <div class="text col-lg-7">
              <div class="text-inner d-flex align-items-center">
                <div class="content">
                  <header class="post-header">
                    <div class="category"><a href="#">{{ $post->category->title }}</a></div><a href="post.html">
                      <h2 class="h4">{{ $post->title }}</h2></a>
                  </header>
                  <p class="text-muted">See more ..</p>
                  <footer class="post-footer d-flex align-items-center"><a href="#" class="author d-flex align-items-center flex-wrap">
                      <div class="title"><i class="fas fa-user fa-xs"></i><span>{{ $post->user->firstname . " " . $post->user->lastname }}</span></div></a>
                    <div class="date"><i class="fas fa-clock fa-xs"></i>2 months ago</div>
                    <div class="comments"><i class="icon-comment"></i>12</div>
                  </footer>
                </div>
              </div>
            </div>
          </div>
        @else
        <div class="row d-flex align-items-stretch">
            <div class="text col-lg-7">
              <div class="text-inner d-flex align-items-center">
                <div class="content">
                  <header class="post-header">
                    <div class="category"><a href="#">{{ $post->category->title }}</a></div><a href="post.html">
                      <h2 class="h4">{{ $post->title }}</h2></a>
                  </header>
                  <p class="text-muted">See more ..</p>
                  <footer class="post-footer d-flex align-items-center"><a href="#" class="author d-flex align-items-center flex-wrap">
                      {{-- <div class="avatar"></div> --}}
                      <div class="title"><i class="fas fa-user-alt fa-xs"></i><span>{{ $post->user->firstname . " " . $post->user->lastname }}</span></div></a>
                    <div class="date"><i class="fas fa-clock fa-xs"></i>2 months ago</div>
                    <div class="comments"><i class="icon-comment"></i>12</div>
                  </footer>
                </div>
              </div>
            </div>
            <div class="image col-lg-5">
            @if ($post->image)
            <img src="{{ asset('storage/'. $post->image) }}">
            @endif
            </div>
        </div>
        @endif
        @empty

        @endforelse
      <!-- Post        -->

      <!-- Post                            -->

    </div>
  </section>
@endsection
@push('scripts')

@endpush
