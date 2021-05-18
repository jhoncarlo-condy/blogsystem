@extends('users.layouts.app')
@section('link')
<li class="nav-item"><a href="{{ route('blog.index') }}" class="nav-link active">Home</a>
</li>
<li class="nav-item"><a href="{{ route('categories') }}" class="nav-link ">Categories</a>
</li>
@if (Auth::user())
<li class="nav-item"><a href="{{ route('profile') }}" class="nav-link ">Profile</a>
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
            @forelse ($content as $cont)
            <div class="post col-xl-6">
                <div class="post-thumbnail">
                    @if($cont->image)
                    <a href="{{ route('blog.show',$cont->id) }}">
                     <img src="{{ asset('storage/'. $cont->image) }}"  class="img-thumbnail" style="height: 200px;width:400px;">
                    </a>
                    @else
                    <a href="{{ route('blog.show', $cont->id) }}">
                    <img class="img-thumbnail" style="width:400px;height:200px;" src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg" alt="">
                    </a>
                    @endif
                </div>
                <div class="post-details">
                  <div class="post-meta d-flex justify-content-between">
                        <div class="date meta-last">{{ $cont->created_at->format('m d') . "|" . $cont->created_at->format('Y') }}</div>
                        <div class="category"><a href="{{ route('blog.show', $cont->id) }}">{{ $cont->category->title }}</a></div>
                  </div><a href="{{ route('blog.show', $cont->id) }}">
                    <h3 class="h4">{{ $cont->title }}</h3></a>
                  <p class="text-muted">See more ..</p>
                  <footer class="post-footer d-flex align-items-center"><a href="#" class="author d-flex align-items-center flex-wrap">
                      {{-- <div class="avatar"><img src="img/avatar-3.jpg" alt="..." class="img-fluid"></div> --}}
                      <a href="{{ route('viewprofile',$cont->user->id) }}">
                      <div class="title">
                          <i class="fas fa-user fa-xs"></i><span>{{ $cont->user->firstname }}</span>
                      </div></a>
                    <div class="date"><i class="fas fa-clock fa-xs"></i>{{ $cont->created_at->diffForHumans() }}</div>
                    <div class="comments meta-last"><i class="fas fa-comment fa-xs"></i></i>{{ $commentcount->where('post_id',$cont->id)->count() }}</div>
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
            <div class="d-flex justify-content-center">
                {{ $content->links() }}
            </div>

          </nav>
        </div>
      </main>
      @include('users.home.sidecontent')

      </div>
  </div>
@endsection
@push('scripts')

@endpush

