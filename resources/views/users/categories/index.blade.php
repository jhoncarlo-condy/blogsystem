@extends('users.layouts.app')
@push('css')

</style>
@endpush

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
<li class="nav-item"><a href="{{ route('post.index') }}" class="nav-link">Home</a>
</li>
<li class="nav-item"><a href="{{ route('category.index') }}" class="nav-link active">Categories</a>
</li>
@if (Auth::user())
<li class="nav-item"><a href="{{ route('profile.index') }}" class="nav-link ">Profile</a>
</li>
@endif
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
        <h3>Latest post from each category</h3>
        <div class="container">
          <div class="row">
            <!-- post -->
            @forelse ($categories as $category)
            @foreach ($category->post as $post)

            <div class="post col-xl-6">
                <div class="post-thumbnail">
                    @if($post->image)
                    <a href="{{ route('post.show',$post->id) }}">
                        <img style="height: 150px;width:400px;" src="{{ asset('storage/'.$post->image) }}" alt="..." class="img-fluid"></a>
                    </a>
                    @else
                    <img style="height: 150px;width:400px;" src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg" alt="..." class="img-fluid"></a>
                    @endif
                </div>
                <div class="post-details">
                  <div class="post-meta d-flex justify-content-between">
                    <div class="date meta-last"></div>
                    <div class="category"><a href="{{ route('post.show',$post->id) }}">{{ $post->title }}</a></div>
                  </div><a href="{{ route('post.show',$post->id) }}">
                    <h3 class="h4">{{ $category->title }}</h3></a>
                  <p class="text-muted">{{ $category->title }}</p>
                  <p class="text-muted"><a href="{{ route('post.show',$category->id) }}"> See more ..</a></p>
                  <footer class="post-footer d-flex align-items-center">
                      {{-- <a href="{{ route('viewprofile',$post->user->id) }}" class="author d-flex align-items-center flex-wrap"> --}}
                      {{-- <div class="avatar"><img src="img/avatar-3.jpg" alt="..." class="img-fluid"></div> --}}
                      <div class="title">
                          <i class="fas fa-user fa-xs"></i><span>{{ $post->user->firstname}}</span>
                      </div></a>
                    <div class="date"><i class="fas fa-clock fa-xs"></i>{{ $post->created_at->diffForHumans() }}</div>
                  </footer>
                </div>
              </div>
            @endforeach

            @empty
              Empty
            @endforelse
          </div>
          {{-- {{ $categories->posts->links() }} --}}

          <!-- Pagination -->
          <nav aria-label="Page navigation example">

            <div class="d-flex justify-content-center">
            </div>

          </nav>
        </div>
      </main>

<aside class="col-lg-4">

    <!-- Widget [Categories Widget]-->
    <div class="widget categories"  id="showall">
      <header>
        <h3 class="h6">Categories</h3>
      </header>
      @forelse ( $lists as $category )
      <div class="item d-flex justify-content-between">
      <a href="{{ route('category.show',$category->id) }}">{{ $category->title }}</a>
        <span>({{ count($category->post)}})</span>
      </div>
      @empty
      <div class="item d-flex justify-content-between"><a href="#">No Categories Available</div>
      @endforelse

      <div class=" d-flex justify-content-between">
      <button type="button" id="button" class="btn btn-secondary">
        See All&rarr;
      </button>

      </div>
      {{-- {{ $categories->links() }} --}}
    </div>

  </aside>


      </div>
  </div>

@endsection
