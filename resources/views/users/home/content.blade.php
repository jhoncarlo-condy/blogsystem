@extends('users.layouts.app')
@section('link')
<li class="nav-item"><a href="{{ route('blog.index') }}" class="nav-link active">Home</a>
</li>
<li class="nav-item"><a href="blog.html" class="nav-link ">Categories</a>
</li>
<li class="nav-item"><a href="post.html" class="nav-link ">Profile</a>
</li>
@endsection
@section('content')
<div class="container">
    <div class="row">
      <!-- Latest Posts -->
      <main class="posts-listing col-lg-8">
        <div class="container">
          <div class="row">
            <!-- post -->
            @forelse ($content as $cont)
            <div class="post col-xl-6">
                <div class="post-thumbnail">
                    @if($cont->image)
                    <a href="post.html">
                     <img src="{{ asset('storage/'. $cont->image) }}"  class="img-thumbnail" style="height: 200px;">
                    </a>
                    @endif
                </div>
                <div class="post-details">
                  <div class="post-meta d-flex justify-content-between">
                    <div class="date meta-last">{{ $cont->created_at->format('m d') . "|" . $cont->created_at->format('Y') }}</div>
                    <div class="category"><a href="">{{ $cont->category->title }}</a></div>
                  </div><a href="{{ route('blog.show', $cont->id) }}">
                    <h3 class="h4">{{ $cont->title }}</h3></a>
                  <p class="text-muted">{!! $cont->description !!}</p>
                  <footer class="post-footer d-flex align-items-center"><a href="#" class="author d-flex align-items-center flex-wrap">
                      {{-- <div class="avatar"><img src="img/avatar-3.jpg" alt="..." class="img-fluid"></div> --}}
                      <div class="title">
                          <span>{{ $cont->user->firstname }}</span>
                      </div></a>
                    <div class="date"><i class="icon-clock"></i> 2 months ago</div>
                    <div class="comments meta-last"><i class="icon-comment"></i>12</div>
                  </footer>
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
          {{ $content->links() }}

          </nav>
        </div>
      </main>
      @include('users.home.sidecontent')

      </div>
  </div>
@endsection

