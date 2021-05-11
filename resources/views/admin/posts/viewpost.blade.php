@extends('layouts.app')
@section('content-header')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          {{-- <h1>Add Post</h1> --}}
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('users.dashboard') }}">Administrator</a></li>
            <li class="breadcrumb-item">Post</li>
            <li class="breadcrumb-item">{{ $find->title }}</li>
            <li class="breadcrumb-item active">{{ $posts->title }}</li>
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
            <div class="post-thumbnail"><img src="img/blog-post-3.jpeg" alt="..." class="img-fluid"></div>
            <div class="post-details">
              <div class="post-meta d-flex justify-content-between">
                <div class="category"><a href="#">{{ $find->title }}</a></div>
              </div>
              <h1>{{ $posts->title }}<a href="#"><i class="fa fa-bookmark-o"></i></a></h1>
              <div class="post-footer d-flex align-items-center flex-column flex-sm-row"><a href="#" class="author d-flex align-items-center flex-wrap">
                  {{-- <div class="avatar"><img src="img/avatar-1.jpg" alt="..." class="img-fluid"></div> --}}
                  <i class="fas fa-user fa-sm"></i><div class="title"><span>{{ Auth::user()->firstname . " ". Auth::user()->lastname . " "}} </span></div></a>
                <div class="d-flex align-items-center flex-wrap">
                  <div class="date"><i class="fas fa-calendar fa-xs"></i>{{ $posts->created_at->format('d/m/Y')  }}</div>
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
              <div class="post-tags mt-6"><a href="#" class="tag">#{{ $find->title }}</a></div>
              <div class="posts-nav d-flex justify-content-between align-items-stretch flex-column flex-md-row"><a href="#" class="prev-post text-left d-flex align-items-center">
                  <div class="icon prev"><i class="fa fa-angle-left"></i></div>
                  <div class="text"><strong class="text-primary">Previous Post </strong>
                    {{-- <h6>I Bought a Wedding Dress.</h6> --}}
                  </div></a><a href="#" class="next-post text-right d-flex align-items-center justify-content-end">
                  <div class="text"><strong class="text-primary">Next Post </strong>
                    {{-- <h6>I Bought a Wedding Dress.</h6> --}}
                  </div>
                  <div class="icon next"><i class="fa fa-angle-right">   </i></div></a></div>
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
          <div class="blog-posts"><a href="#">
              <div class="item d-flex align-items-center">
                <div class="image"><img src="img/small-thumbnail-1.jpg" alt="..." class="img-fluid"></div>
                <div class="title"><strong>Alberto Savoia Can Teach You About</strong>
                  <div class="d-flex align-items-center">
                    <div class="views"><i class="icon-eye"></i> 500</div>
                    <div class="comments"><i class="icon-comment"></i>12</div>
                  </div>
                </div>
              </div></a><a href="#">
              <div class="item d-flex align-items-center">
                <div class="image"><img src="img/small-thumbnail-2.jpg" alt="..." class="img-fluid"></div>
                <div class="title"><strong>Alberto Savoia Can Teach You About</strong>
                  <div class="d-flex align-items-center">
                    <div class="views"><i class="icon-eye"></i> 500</div>
                    <div class="comments"><i class="icon-comment"></i>12</div>
                  </div>
                </div>
              </div></a><a href="#">
              <div class="item d-flex align-items-center">
                <div class="image"><img src="img/small-thumbnail-3.jpg" alt="..." class="img-fluid"></div>
                <div class="title"><strong>Alberto Savoia Can Teach You About</strong>
                  <div class="d-flex align-items-center">
                    <div class="views"><i class="icon-eye"></i> 500</div>
                    <div class="comments"><i class="icon-comment"></i>12</div>
                  </div>
                </div>
              </div></a></div>
        </div>
        <!-- Widget [Categories Widget]-->
        <div class="widget categories">
          <header>
            <h3 class="h6">Categories</h3>
          </header>
          <div class="item d-flex justify-content-between"><a href="#">Growth</a><span>12</span></div>
          <div class="item d-flex justify-content-between"><a href="#">Local</a><span>25</span></div>
          <div class="item d-flex justify-content-between"><a href="#">Sales</a><span>8</span></div>
          <div class="item d-flex justify-content-between"><a href="#">Tips</a><span>17</span></div>
          <div class="item d-flex justify-content-between"><a href="#">Local</a><span>25</span></div>
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
