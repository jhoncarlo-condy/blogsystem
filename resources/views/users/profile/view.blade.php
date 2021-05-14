@extends('users.layouts.app')
@push('css')
<style>
    .image img
    {
        width:400px;
    }
</style>
@endpush
@section('link')
<li class="nav-item"><a href="{{ route('blog.index') }}" class="nav-link">Home</a>
</li>
<li class="nav-item"><a href="{{ route('categories') }}" class="nav-link">Categories</a>
</li>
<li class="nav-item"><a href="{{ route('profile') }}" class="nav-link active">Profile</a>
</li>
@endsection
@section('content')
<section style="background: url('https://images.unsplash.com/photo-1481627834876-b7833e8f5570?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=541&q=80'); background-size: cover; background-position: center bottom" class="divider">
    <div class="container">
      <div class="row">
        <div class="col-md-7">
          <h2>Welcome to your blog profile</h2><a href="#" class="hero-link">Create Post</a>
        </div>
        <div class="col-md-7">
        </div>
      </div>
    </div>
  </section>
  <!-- Intro Section-->
 <div style=" height:10px;background-color: #e3dff0;">

 </div>
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
    {{-- <div class="row d-flex align-items-stretch">
            <div class="image col-lg-5"><img src="img/featured-pic-2.jpeg" alt="..."></div>
            <div class="text col-lg-7">
              <div class="text-inner d-flex align-items-center">
                <div class="content">
                  <header class="post-header">
                    <div class="category"><a href="#">Business</a><a href="#">Technology</a></div><a href="post.html">
                      <h2 class="h4">{{ $post->title }}</h2></a>
                  </header>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrude consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                  <footer class="post-footer d-flex align-items-center"><a href="#" class="author d-flex align-items-center flex-wrap">
                      <div class="avatar"><img src="img/avatar-2.jpg" alt="..." class="img-fluid"></div>
                      <div class="title"><span>John Doe</span></div></a>
                    <div class="date"><i class="icon-clock"></i> 2 months ago</div>
                    <div class="comments"><i class="icon-comment"></i>12</div>
                  </footer>
                </div>
              </div>
            </div>
          </div> --}}
          <section class="addpost">
            <div class="container-fluid">
              <!-- SELECT2 EXAMPLE -->

              <div class="card card-gray">
                <div class="card-header">
                  <h3 class="card-title">Add Post</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="remove" id="close">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                     <div class="form-group">
                       <label for="">Title</label>
                       <input type="text"
                         class="form-control" name="title" id="" aria-describedby="helpId" placeholder="Enter title here">
                     </div>
                      <!-- /.form-group -->
                      <div class="form-group">
                        <label>Author</label>
                        <input type="text" class="form-control" name="" disabled value="{{ Auth::user()->firstname . " " . Auth::user()->lastname }}" placeholder="">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    </div>
                      <!-- /.form-group -->
                    </div>
                    <!-- /.col -->

                      <!-- /.form-group -->
                      <div class="mt-4 ml-4">
                        <label>Upload Image</label>
                        <div class="file-drop-area bordered">
                             <span class="choose-file-button">Choose Files</span>
                             <span class="file-message">or drag and drop files here</span>
                              <input type="file" name="image" class="file-input" accept=".jfif,.jpg,.jpeg,.png,.gif" >
                        </div>
                        <div  id="divImageMediaPreview"> </div>
                      </div>
                      <!-- /.form-group -->
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->

                  <div class="row">
                    <div class="col-12 col-sm-6">
                      <div class="form-group">
                        <label>Category</label>

                        <select class="form-control " name="category_id" data-dropdown-css-class="select2-danger" style="width: 100%;">
                            @foreach ($category as $category)}
                            <option value="{{ $category->id}}">{{ $category->title}}</option>
                            @endforeach
                        </select>

                      </div>
                      <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-10 col-sm-4">

                      {{-- <div class="form-group">
                        <label>Multiple (.select2-purple)</label>
                        <div class="select2-purple">
                          <select class="select2" multiple="multiple" data-placeholder="Select a State" data-dropdown-css-class="select2-purple" style="width: 100%;">
                            <option>Alabama</option>
                            <option>Alaska</option>
                            <option>California</option>
                            <option>Delaware</option>
                            <option>Tennessee</option>
                            <option>Texas</option>
                            <option>Washington</option>
                          </select>
                        </div>
                      </div> --}}
                      <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
                <!-- /.card-body -->
                <div class="container mb-3">
                <textarea id="summernote" name="description"></textarea>

                </div>
                <!-- /.card -->
                {{-- ckeditor --}}
              {{-- <div class="row">
                <div class="col-md-12">
                  <div class="card card-outline card-info">
                    <div class="card-header">
                      <h3 class="card-title">
                        Content
                      </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                     <div class="editor">

                    </div>

                  </div>
                </div>
                <!-- /.col-->
              </div> --}}
              <div class="form-group text-right mr-4">
                <button type="submit" class="btn btn-primary">Add Post</button>
              </div>
            </form>
            </div>
        </section>


  <section class="featured-posts no-padding-top mt-4">
    <div class="container">
        <div class="col-lg-8">
            <h3>YOUR RECENT POSTS</h3>
            {{-- <p class="text-big">Place a nice <strong>introduction</strong> here <strong>to catch reader's attention</strong>. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderi.</p> --}}
        </div>
      <!-- Post-->
        @forelse ($posts->take(3) as $index=>$post)
        @if ($index == 0)
        <div class="row d-flex align-items-stretch">
            <div class="text col-lg-7">
              <div class="text-inner d-flex align-items-center">
                <div class="content">
                  <header class="post-header">
                    <div class="category"><a href="{{ route('post.show',$post->id) }}">{{ $post->category->title }}</a></div><a href="{{ route('post.show',$post->id) }}">
                      <h2 class="h4">{{ $post->title }}</h2></a>
                  </header>
                  <p class="text-muted">See more ..</p>
                  <footer class="post-footer d-flex align-items-center"><a href="#" class="author d-flex align-items-center flex-wrap">
                      {{-- <div class="avatar"></div> --}}
                      <div class="title"><i class="fas fa-user-alt fa-xs"></i><span>{{ $post->user->firstname . " " . $post->user->lastname }}</span></div></a>
                    <div class="date"><i class="fas fa-clock fa-xs"></i>{{ $post->created_at->diffForHumans() }}</div>
                    <div class="comments"><i class="icon-comment"></i>12</div>
                  </footer>
                </div>
              </div>
            </div>
            <div class="image col-lg-5">
            @if ($post->image)
           <img src="{{ asset('storage/'. $post->image) }}">
            @endif
            </div>
        </div>
        @elseif($index % 4 <2)
            <div class="row d-flex align-items-stretch">
                <div class="image col-lg-5">
                @if ($post->image)
                <img src="{{ asset('storage/'.$post->image) }}" alt="...">
                @endif
                </div>
                <div class="text col-lg-7">
                  <div class="text-inner d-flex align-items-center">
                    <div class="content">
                      <header class="post-header">
                        <div class="category"><a href="{{ route('post.show',$post->id) }}">{{ $post->category->title }}</a></div><a href="{{ route('post.show',$post->id) }}">
                          <h2 class="h4">{{ $post->title }}</h2></a>
                      </header>
                      <p class="text-muted">See more ..</p>
                      <footer class="post-footer d-flex align-items-center"><a href="#" class="author d-flex align-items-center flex-wrap">
                          <div class="title"><i class="fas fa-user fa-xs"></i><span>{{ $post->user->firstname . " " . $post->user->lastname }}</span></div></a>
                        <div class="date"><i class="fas fa-clock fa-xs"></i>{{ $post->created_at->diffForHumans() }}</div>
                        <div class="comments"><i class="icon-comment"></i>12</div>
                      </footer>
                    </div>
                  </div>
                </div>
              </div>
        @else
        <div class="row d-flex align-items-stretch">
            <div class="text col-lg-7">
              <div class="text-inner d-flex align-items-center">
                <div class="content">
                  <header class="post-header">
                    <div class="category"><a href="{{ route('post.show',$post->id) }}">{{ $post->category->title }}</a></div><a href="{{ route('post.show',$post->id) }}">
                      <h2 class="h4">{{ $post->title }}</h2></a>
                  </header>
                  <p class="text-muted">See more ..</p>
                  <footer class="post-footer d-flex align-items-center"><a href="#" class="author d-flex align-items-center flex-wrap">
                      {{-- <div class="avatar"></div> --}}
                      <div class="title"><i class="fas fa-user-alt fa-xs"></i><span>{{ $post->user->firstname . " " . $post->user->lastname }}</span></div></a>
                    <div class="date"><i class="fas fa-clock fa-xs"></i>{{ $post->created_at->diffForHumans() }}</div>
                    <div class="comments"><i class="icon-comment"></i>12</div>
                  </footer>
                </div>
              </div>
            </div>
            <div class="image col-lg-5">
            @if ($post->image)
            <img src="{{ asset('storage/'. $post->image) }}">
            @endif
            </div>
        </div>
        @endif
        @empty

        @endforelse
      <!-- Post        -->

      <!-- Post                            -->

    <div class="text-right">
        <button type="button" class="btn btn-primary">View all</button>
    </div>
    </div>
  </section>

@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2();
        $('#summernote').summernote({
            placeholder: 'Enter some text here',
            height: 300,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true,               // set focus to editable area after initializing summernote

        });
    });
</script>
<script>
$(document).ready(function()
{
    $(".addpost").hide();
    $(".hero-link").on('click',function()
    {
        $(".addpost").show();
    });
    $("#close").on('click',function()
    {
        $(".addpost").hide();
    })
});
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
