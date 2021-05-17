@extends('users.layouts.app')
@push('css')

</style>
@endpush
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
          <h2>CATEGORIES</h2><a href="#" class="hero-link"></a>
        </div>
        <div class="col-md-7">
        </div>
      </div>
    </div>
  </section>
  <!-- Intro Section-->
 <div style=" height:10px;background-color: #e3dff0;"></div>
 <div class="container">
    <div class="row">
      <main class="posts-listing col-lg-8">
        <div class="category">
        <h3>Posts from category: {{ $posts[0]->category->title }}</h3>
        </div>
        <div class="container">
          <div class="row">
            <!-- post -->
            @forelse ($posts as $post)
            <div class="post col-xl-6">
                <div class="post-thumbnail">
                    @if($post->image)
                    <a href="{{ route('blog.show',$post->id) }}">
                        <img style="height: 150px;width:400px;" src="{{ asset('storage/'.$post->image) }}" alt="..." class="img-fluid"></a>
                    </a>
                    @else
                    <img style="height: 150px;width:400px;" src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg" alt="..." class="img-fluid"></a>
                    @endif
                </div>
                <div class="post-details">
                  <div class="post-meta d-flex justify-content-between">
                    <div class="date meta-last"></div>
                    <div class="category"><a href="{{ route('blog.show',$post->id) }}">{{ $post->category->title }}</a></div>
                  </div><a href="{{ route('blog.show', $post->id) }}">
                    <h3 class="h4">{{ $post->title }}</h3></a>
                  <p class="text-muted">See more ..</p>
                  <footer class="post-footer d-flex align-items-center"><a href="#" class="author d-flex align-items-center flex-wrap">
                      {{-- <div class="avatar"><img src="img/avatar-3.jpg" alt="..." class="img-fluid"></div> --}}
                      <div class="title">
                          <i class="fas fa-user fa-xs"></i><span>{{ $post->user->firstname}}</span>
                      </div></a>
                    <div class="date"><i class="fas fa-clock fa-xs"></i>{{ $post->created_at->diffForHumans() }}</div>
                  </footer>
                </div>
              </div>
            @empty
              Empty
            @endforelse

          </div>
          {{ $posts->links() }}

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
            </div>

          </nav>
        </div>
      </main>

<aside class="col-lg-4">

    <!-- Widget [Categories Widget]-->
    <div class="widget categories">
      <header>
        <h3 class="h6">Categories</h3>
      </header>
      @forelse ( $lists as $category )
      <div class="item d-flex justify-content-between"><a href="{{ route('view',$category->id) }}">{{ $category->title }}</a>
        <span>({{ $count->where('category_id',$category->id)->count() }})</span>
      </div>
      @empty
      <div class="item d-flex justify-content-between"><a href="#">No Categories Available</div>
      @endforelse
      {{-- {{ $categories->links() }} --}}
    </div>

  </aside>


      </div>
  </div>

@endsection
