@extends('users.layouts.app')
@push('scripts')
<script>
    $(document).ready(function()
    {
        $('#button').click(function()
        {
            $('#showall').load('{{ route('list') }}').fadeIn("slow");
        });
    });
</script>
@include('common.pusher')
@endpush
@php
    $auth = Auth::user();
@endphp
@section('link')
<li class="nav-item"><a href="{{ route('post.index') }}" class="nav-link active">Home</a>
</li>
<li class="nav-item"><a href="{{ route('category.index') }}" class="nav-link ">Categories</a>
</li>
@if ($auth)
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
          <div class="row" id="userposttable">
            @include('users.posts.realtimeposts')
          </div>
          <!-- Pagination -->
          <nav aria-label="Page navigation example">

            <div class="d-flex justify-content-center">
                {{ $posts->links() }}
            </div>

          </nav>
        </div>
      </main>

{{-- side contents --}}
<aside class="col-lg-4">

@if ($auth)
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
      <div id="latestpost">
        @include('users.posts.realtimelatestpost')
      </div>
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

