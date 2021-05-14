@extends('users.layouts.app')
@section('link')
<li class="nav-item"><a href="{{ route('blog.index') }}" class="nav-link">Home</a>
</li>
<li class="nav-item"><a href="{{ route('categories') }}" class="nav-link active">Categories</a>
</li>
<li class="nav-item"><a href="{{ route('profile') }}" class="nav-link ">Profile</a>
</li>
@endsection
@section('content')
<section style="background: url('https://images.unsplash.com/photo-1481627834876-b7833e8f5570?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=541&q=80'); background-size: cover; background-position: center bottom" class="divider">
    <div class="container">
      <div class="row">
        <div class="col-md-7">
          <h2>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</h2><a href="#" class="hero-link">View More</a>
        </div>
      </div>
    </div>
  </section>
  <!-- Latest Posts -->
  <section class="latest-posts">
    <div class="container">
      <header>
        <h2>Latest from the categories</h2>
        {{-- <p class="text-big">Lorem ipsum dolor sit amet, conadipisicingsectetur  elit.</p> --}}
      </header>
      <div class="row">

        @forelse ($posts->take(6) as $post)
        <div class="post col-md-4">
            <div class="post-thumbnail"><a href="post.html"><img src="img/blog-1.jpg" alt="..." class="img-fluid"></a></div>
            <div class="post-details">
              <div class="post-meta d-flex justify-content-between">
                <div class="date">20 May | 2016</div>
                <div class="category"><a href="#">{{ $post->category->title }}</a></div>
              </div><a href="post.html">
                <h3 class="h4">Ways to remember your important ideas</h3></a>
              <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
            </div>
          </div>
        @empty

        @endforelse

        {{-- <div class="post col-md-4">
          <div class="post-thumbnail"><a href="post.html"><img src="img/blog-2.jpg" alt="..." class="img-fluid"></a></div>
          <div class="post-details">
            <div class="post-meta d-flex justify-content-between">
              <div class="date">20 May | 2016</div>
              <div class="category"><a href="#">Technology</a></div>
            </div><a href="post.html">
              <h3 class="h4">Diversity in Engineering: Effect on Questions</h3></a>
            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
          </div>
        </div>
        <div class="post col-md-4">
          <div class="post-thumbnail"><a href="post.html"><img src="img/blog-3.jpg" alt="..." class="img-fluid"></a></div>
          <div class="post-details">
            <div class="post-meta d-flex justify-content-between">
              <div class="date">20 May | 2016</div>
              <div class="category"><a href="#">Financial</a></div>
            </div><a href="post.html">
              <h3 class="h4">Alberto Savoia Can Teach You About Interior</h3></a>
            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
          </div>
        </div> --}}
      </div>
    </div>
  </section>

@endsection
