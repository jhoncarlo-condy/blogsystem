@extends('users.layouts.app')
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function()
    {
        $('#button').click(function()
        {
            $('#showall').load('{{ route('commentshow',$post->id) }}').fadeIn("slow");
            $('#button').hide();

        });
        $('#catbutton').click(function()
        {
            $('#showcat').load('{{ route('list') }}').fadeIn("slow");
            $('#catbutton').hide();

        });
    });
</script>
@endpush
@section('link')
<li class="nav-item"><a href="{{ route('post.index') }}" class="nav-link active">Home</a>
</li>
<li class="nav-item"><a href="{{ route('category.index') }}" class="nav-link">Categories</a>
</li>
@if (Auth::user())
<li class="nav-item"><a href="{{ route('profile.index') }}" class="nav-link ">Profile</a>
</li>
@endif
@endsection
@section('content')
@if (Session::has('message'))
 <div class="alert alert-success alert-dismissible fade show" role="alert">
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         <span class="sr-only">Close</span>
     </button>
     <strong>{{ session('message') }}</strong>
 </div>
 @endif
 @if ($errors->any())
 <div class="alert alert-danger">
     <ul>
         @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
         @endforeach
     </ul>
 </div>
@endif
<div class="container">
    <div class="row">
      <!-- Latest Posts -->
      <main class="post blog-post col-lg-8">
        <div class="container">
          <div class="post-single">
              <div class="back mb-2">
                <a name="" id="" class="btn btn-secondary" href="{{ route('post.index')}}" role="button">Back</a>
                <div class="edit-post float-right">
                   @if (Auth::user())
                   @if ($post->user_id == Auth::user()->id)
                   <a name="" id="" class="btn btn-secondary" href="{{ route('post.edit',$post->id) }}" role="button">Edit Post</a>
                   @else
                   @endif
                   @endif
                  </div>
              </div>

            <div class="post-thumbnail">
                @if ($post->image)
                <img src="{{ asset('storage/'. $post->image) }}" alt="..." class="img-fluid">
                @else
                <img style="height: 400px;" src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg" alt="" class="img-fluid">
                @endif
            </div>
            <div class="post-details">
              <div class="post-meta d-flex justify-content-between">
                <div class="category">
                    <a href="#">
                        {{ $post->title }}
                    </a>
                </div>
              </div>
              <h1><a href="#"><i class="fa fa-bookmark-o"></i></a></h1>
              <div class="post-footer d-flex align-items-center flex-column flex-sm-row">
                  <a href="" class="author d-flex align-items-center flex-wrap">
                  {{-- <div class="avatar"><img src="img/avatar-1.jpg" alt="..." class="img-fluid"></div> --}}
                  <i class="fas fa-user fa-sm"></i><div class="title">

                    <span>
                        {{ $post->user->firstname . " " . $post->user->lastname }}
                    </span></div></a>
                <div class="d-flex align-items-center flex-wrap">
                  <div class="date"><i class="fas fa-calendar fa-xs"></i>{{ $post->created_at->format('m/d/Y') }}</div>
                  <div class="date"><i class="fas fa-clock fa-xs"></i>{{ $post->created_at->format('H:i A') }}</div>
                  {{-- <div class="views"></div> --}}
                  <div class="comments meta-last"><i class="fas fa-comment fa-xs"></i>{{ count($post->comments) }}</div>
                </div>
              </div>
              <div class="post-body mb-6">
                <div class="container col-12">
                    {!! $post->description !!}
                </div>
                {{-- <h3>Lorem Ipsum Dolor</h3>
                <p>div Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda temporibus iusto voluptates deleniti similique rerum ducimus sint ex odio saepe. Sapiente quae pariatur ratione quis perspiciatis deleniti accusantium</p> --}}

              </div>
              <div class="post-tags mt-6"><a href="#" class="tag">#{{ $post->category->title }}</a></div>
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
              <div class="post-comments" >
                <header>
                  <h3 class="h6">Comments<span class="no-of-comments">({{ count($post->comments) }})</span></h3>
                </header>

                <div class="comment" id="showall">
                @forelse ($post->comments->take(2) as $postcomment)

                  <div class="comment-header d-flex justify-content-between">
                    <div class="user d-flex align-items-center">
                      {{-- <div class="image"><img src="img/user.sv  g" alt="..." class="img-fluid rounded-circle"></div> --}}

                      <div class="title"><strong>{{ $postcomment->user->firstname }}</strong>
                        <span class="date">{{ $postcomment->created_at->diffForHumans() }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="comment-body">
                    <p>{{ $postcomment->comment }}</p>
                  </div>
                  @empty
                  {{-- if empty --}}
                  <div class="comment">
                    <div class="comment-header d-flex justify-content-between">
                      <div class="user d-flex align-items-center">
                        {{-- <div class="image"><img src="img/user.sv  g" alt="..." class="img-fluid rounded-circle"></div> --}}

                        <div class="title"><strong></strong>
                          <span class="date"></span>
                        </div>
                      </div>
                    </div>
                    <div class="comment-body">
                      <p></p>
                    </div>
                  @endforelse
                </div>

                @if (count($post->comments)>0)
                <div class="seemore-button">
                    <a style="color:blue" name="" id="button" role="button">See all Comments&rarr;</a>
                </div>
                @endif

              </div>
              @guest
              <div class="add-comment">
                <header>
                  <h3 class="h6">You must login to leave a reply</h3>
                </header>

                <form action="" method="POST" class="commenting-form">

                    <div class="row">
                    <div class="form-group col-md-6">
                        <input type="hidden" name="user_id" value="">
                        <input type="hidden" name="post_id" value="">
                    </div>
                    <div class="form-group col-md-12">
                    <label for=""></label>
                      <textarea name="comment" id="usercomment" placeholder="Type your comment" class="form-control"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                      <a name="" id="" class="btn btn-secondary" href="{{ route('login') }}" role="button">Add Comment</a>
                    </div>
                  </div>
                </form>

              </div>
              @endguest
              @auth
              <div class="add-comment">
                <header>
                  <h3 class="h6">Leave a reply</h3>
                </header>

                <form action="{{ route('comment.store') }}" method="POST" class="commenting-form">
                    @csrf
                    @method('POST')
                    <div class="row">
                    <div class="form-group col-md-6">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                    </div>
                    <div class="form-group col-md-12">
                    <label for="">Comment as {{ Auth::user()->firstname }}</label>
                      <textarea name="comment" id="usercomment" placeholder="Type your comment" class="form-control"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                      <button type="submit" class="btn btn-secondary">Submit Comment</button>
                    </div>
                  </div>
                </form>

              </div>
              @endauth

            </div>
          </div>
        </div>
      </main>

      <aside class="col-lg-4">


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
                    <div class="comments"><i class="fas fa-clock fa-xs"></i>{{ $latest->created_at->format('H:i A')  }}</div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          @empty

          @endforelse
        </div>
        <!-- Widget [Categories Widget]-->
        <div class="widget categories" id="showcat">
          <header>
            <h3 class="h6">Categories</h3>
          </header>
          @forelse ( $category as $category )
          <div class="item d-flex justify-content-between">
              <a href="{{ route('category.show',$category->id) }}">{{ $category->title }}</a>
              <span>({{ count($category->post) }})</span>
          </div>
          @empty
          <div class="item d-flex justify-content-between"><a href="#">No Categories Available</div>
          @endforelse
          <div class=" d-flex justify-content-between">
            <button type="button" id="catbutton" class="btn btn-secondary">
              See All&rarr;
            </button>

            </div>
            {{-- {{ $categories->links() }} --}}
        </div>

      </aside>

    </div>
  </div>
@endsection
