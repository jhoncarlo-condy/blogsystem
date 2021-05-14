@extends('users.layouts.app')
@section('link')
<li class="nav-item"><a href="{{ route('blog.index') }}" class="nav-link active">Home</a>
</li>
<li class="nav-item"><a href="{{ route('categories') }}" class="nav-link">Categories</a>
</li>
<li class="nav-item"><a href="{{ route('profile') }}" class="nav-link ">Profile</a>
</li>
@endsection
@section('content')
<div class="container">
    <div class="row">
      <!-- Latest Posts -->
      <main class="post blog-post col-lg-8">
        <div class="container">
          <div class="post-single">
            <div class="post-thumbnail">
                @if ($posts->image)
                <img src="{{ asset('storage/'. $posts->image) }}" alt="..." class="img-fluid">
                @else
                @endif
            </div>
            <div class="post-details">
              <div class="post-meta d-flex justify-content-between">
                <div class="category">
                    <a href="#">
                        {{ $posts->category->title }}
                    </a>
                </div>
              </div>
              <h1><a href="#"><i class="fa fa-bookmark-o"></i></a></h1>
              <div class="post-footer d-flex align-items-center flex-column flex-sm-row"><a href="#" class="author d-flex align-items-center flex-wrap">
                  {{-- <div class="avatar"><img src="img/avatar-1.jpg" alt="..." class="img-fluid"></div> --}}
                  <i class="fas fa-user fa-sm"></i><div class="title">
                    <span>
                        {{ $posts->user->firstname . " " . $posts->user->lastname }}
                    </span></div></a>
                <div class="d-flex align-items-center flex-wrap">
                  <div class="date"><i class="fas fa-calendar fa-xs"></i>{{ $posts->created_at->format('m/d/Y') }}</div>
                  <div class="date"><i class="fas fa-clock fa-xs"></i>{{ $posts->created_at->format('H:i A') }}</div>
                  {{-- <div class="views"></div> --}}
                  <div class="comments meta-last"><i class="fas fa-comment fa-xs"></i>12</div>
                </div>
              </div>
              <div class="post-body mb-6">
                <div class="container col-12">
                    {!! $posts->description !!}
                </div>
                {{-- <h3>Lorem Ipsum Dolor</h3>
                <p>div Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda temporibus iusto voluptates deleniti similique rerum ducimus sint ex odio saepe. Sapiente quae pariatur ratione quis perspiciatis deleniti accusantium</p> --}}

              </div>
              <div class="post-tags mt-6"><a href="#" class="tag">#</a></div>
              {{-- <div class="posts-nav d-flex justify-content-between align-items-stretch flex-column flex-md-row"><a href="#" class="prev-post text-left d-flex align-items-center">
                  <div class="icon prev"><i class="fa fa-angle-left"></i></div>
                  <div class="text"><strong class="text-primary">Previous Post </strong>
                    <h6>I Bought a Wedding Dress.</h6>
                  </div></a><a href="#" class="next-post text-right d-flex align-items-center justify-content-end">
                  <div class="text"><strong class="text-primary">Next Post </strong>
                    <h6>I Bought a Wedding Dress.</h6>
                  </div>
                  <div class="icon next"><i class="fa fa-angle-right">   </i></div></a>
             </div> --}}
              <div class="post-comments">
                <header>
                  <h3 class="h6">Post Comments<span class="no-of-comments">(3)</span></h3>
                </header>
                <div class="comment">
                  <div class="comment-header d-flex justify-content-between">
                    <div class="user d-flex align-items-center">
                      {{-- <div class="image"><img src="img/user.sv  g" alt="..." class="img-fluid rounded-circle"></div> --}}
                      <div class="title"><strong>Jabi Hernandiz</strong><span class="date">May 2016</span></div>
                    </div>
                  </div>
                  <div class="comment-body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                  </div>
                </div>

              </div>
              <div class="add-comment">
                <header>
                  <h3 class="h6">Leave a reply</h3>
                </header>
                <form action="#" class="commenting-form">
                  <div class="row">
                    <div class="form-group col-md-6">
                      <input type="text" name="username" id="username" placeholder="Name" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                      <input type="email" name="username" id="useremail" placeholder="Email Address (will not be published)" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                      <textarea name="usercomment" id="usercomment" placeholder="Type your comment" class="form-control"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                      <button type="submit" class="btn btn-secondary">Submit Comment</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </main>
      <aside class="col-lg-4">
        <!-- Widget [Search Bar Widget]-->
        {{-- <div class="widget search">
          <header>
            <h3 class="h6">Search the blog</h3>
          </header>
          <form action="#" class="search-form">
            <div class="form-group">
              <input type="search" placeholder="What are you looking for?">
              <button type="submit" class="submit"><i class="icon-search"></i></button>
            </div>
          </form>
        </div> --}}
        <!-- Widget [Latest Posts Widget]        -->
    <div class="widget latest-posts">
          <header>
            <h3 class="h6">Latest Posts</h3>
          </header>
          @foreach ($latest->take(3) as $count=>$latest)


            <div class="blog-posts"><a href="{{ url('post/'.$latest->id) }}">
            <div class="item d-flex align-items-center">
            @if ($latest->image)
            <div class="image"><img src="{{ asset('storage/'.$latest->image) }}" alt="..." class="img-fluid"></div>
            @else

            @endif
            <div class="title"><strong>{{ $latest->title }}</strong>
                <div class="d-flex align-items-center">
                <div class="views"><i class="fas fa-calendar fa-xs"></i>{{ $latest->created_at->format('d/m/Y')  }}</div>
                <div class="comments"><i class="fas fa-clock fa-xs"></i>{{ $latest->created_at->format('H:i A')  }}</div>
                </div>
            </div>
            </div></a><a href="#">
            </div>



        @endforeach



    </div>
    <!-- Widget [Categories Widget]-->
        <div class="widget categories">
          <header>
            <h3 class="h6">Categories <h3>
          </header>

          @foreach ($category as $cat)
          <div class="item d-flex justify-content-between"><a href="#">{{ $cat->title }}</a><span>1</span></div>
          @endforeach
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
    </div>
  </div>
@endsection
