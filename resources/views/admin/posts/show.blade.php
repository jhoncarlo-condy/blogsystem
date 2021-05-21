@extends('layouts.app')
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function()
    {
        $('#button').click(function()
        {
            $('#showall').load('{{ route('allcomments',$post->id) }}').fadeIn("slow");
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
@section('content-header')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="ml-2">
          {{-- <h1>Add Post</h1> --}}
        </div>
        <div class="col-sm-8">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('users.dashboard') }}">Administrator</a></li>
            <li class="breadcrumb-item active">Post</li>
            <li class="breadcrumb-item active">{{ $post->category->title }}</li>
            <li class="breadcrumb-item active">{{ $post->title }}</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>
@endsection
@section('content-wrapper')
<div class="container">
    <div class="row">
      <!-- Latest Posts -->
      <main class="post blog-post col-lg-8">
        <div class="container">
          <div class="post-single">
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
                    <a href="{{ route('posts.show',$post->category->id) }}">{{ $post->category->title }}</a>
                </div>
              </div>
              <h1>{{ $post->title }}<a href="{{ route('posts.show',$post->category->id) }}"><i class="fa fa-bookmark-o"></i></a></h1>
              <div class="post-footer d-flex align-items-center flex-column flex-sm-row">
                  <a href="{{ route('users.show', $post->user_id) }}" class="author d-flex align-items-center flex-wrap">
                  {{-- <div class="avatar"><img src="img/avatar-1.jpg" alt="..." class="img-fluid"></div> --}}
                  <i class="fas fa-user fa-sm"></i><div class="title">
                      <span>{{ $post->user->firstname . " ". $post->user->lastname . " "}} </span>
               </div></a>
                <div class="d-flex align-items-center flex-wrap">
                  <div class="date"><i class="fas fa-calendar fa-xs"></i>{{ $post->created_at->format('m/d/Y')  }}</div>
                  <div class="date"><i class="fas fa-clock fa-xs"></i>{{ $post->created_at->format('H:i A') }}</div>
                  {{-- <div class="views"></div> --}}
                  <div class="comments meta-last"><i class="fas fa-comment fa-xs"></i>
                    {{ $comments->count() }}
                  </div>
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
             <div class="post-comments">
                <header>
                  <h3 class="h6">Post Comments<span class="no-of-comments">({{ $comments->count() }})</span></h3>
                </header>

                @forelse ($comments as $comment)
                <div class="comment">
                  <div class="comment-header d-flex justify-content-between">
                    <div class="user d-flex align-items-center">
                      {{-- <div class="image"><img src="img/user.sv  g" alt="..." class="img-fluid rounded-circle"></div> --}}

                      <div class="title"><strong>{{ $comment->user->firstname }}</strong>
                        <span class="date">{{ $comment->created_at->diffForHumans() }}</span>
                      </div>
                    </div>
                  </div>
                  <div class="comment-body">
                    <p>{{ $comment->comment }}</p>
                  </div>
                  @empty
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


              </div>
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
            </div>
          </div>
        </div>
      </main>

<aside class="col-lg-4">


    <div class="widget latest-posts">
      <header>
        <h3 class="h6">Latest Posts</h3>
      </header>
      @forelse ($latest->take(3) as $latest)
      <div class="blog-posts">
        <a href="{{ route('blog.show',$latest->id) }}">
          <div class="item d-flex align-items-center">
            <div class="image">
                @if ($latest->image)
                <img src="{{ url('storage/'.$latest->image) }}" alt="..." class="img-fluid">
                @else

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
    <div class="widget categories">
      <header>
        <h3 class="h6">Categories</h3>
      </header>
      @forelse ( $categories->take(7) as $category )
      <div class="item d-flex justify-content-between"><a href="#">{{ $category->title }}</a></div>
      @empty
      <div class="item d-flex justify-content-between"><a href="#">No Categories Available</div>
      @endforelse
      <a href="{{ route('categories.index') }}"><div class=" d-flex justify-content-between">See All&rarr;</a></div>
      {{-- {{ $categories->links() }} --}}
    </div>

  </aside>

    </div>
  </div>

@endsection
@push('addpost')
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Enter some text here',
            height: 300,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true,               // set focus to editable area after initializing summernote

        });
    });
</script>
<script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
<script>
          ClassicEditor
                                .create( document.querySelector( '.editor' ) )
                                .then( editor => {
                                        console.log( editor );
                                } )
                                .catch( error => {
                                        console.error( error );
                                } );
</script>
<script>
$(document).on('change', '.file-input', function() {


var filesCount = $(this)[0].files.length;

var textbox = $(this).prev();

if (filesCount === 1) {
var fileName = $(this).val().split('\\').pop();
textbox.text(fileName);
} else {
textbox.text(filesCount + ' files selected');
}



if (typeof (FileReader) != "undefined") {
var dvPreview = $("#divImageMediaPreview");
dvPreview.html("");
$($(this)[0].files).each(function () {
var file = $(this);
var reader = new FileReader();
reader.onload = function (e) {
var img = $("<img />");
img.attr("style", "width: 150px; height:100px; padding: 10px");
img.attr("src", e.target.result);
dvPreview.append(img);
}
reader.readAsDataURL(file[0]);
});
} else {
alert("This browser does not support HTML5 FileReader.");
}


});
</script>
@endpush
