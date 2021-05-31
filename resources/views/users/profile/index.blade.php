@extends('users.layouts.app')
@push('css')
<style>
        .image img
        {
            width:400px;
        }
        .file-upload {
    background-color: #ffffff;
    width: 600px;
    margin: 0 auto;
    padding: 20px;
    }

    .file-upload-btn {
    width: 100%;
    margin: 0;
    color: #fff;
    background: #1FB264;
    border: none;
    padding: 10px;
    border-radius: 4px;
    border-bottom: 4px solid #15824B;
    transition: all .2s ease;
    outline: none;
    text-transform: uppercase;
    font-weight: 700;
    }

    .file-upload-btn:hover {
    background: #1AA059;
    color: #ffffff;
    transition: all .2s ease;
    cursor: pointer;
    }

    .file-upload-btn:active {
    border: 0;
    transition: all .2s ease;
    }

    .file-upload-content {
    display: none;
    text-align: center;
    }

    .file-upload-input {
    position: absolute;
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
    outline: none;
    opacity: 0;
    cursor: pointer;
    }

    .image-upload-wrap {
    margin-top: 20px;
    border: 4px dashed #1FB264;
    position: relative;
    }

    .image-dropping,
    .image-upload-wrap:hover {
    background-color: #1FB264;
    border: 4px dashed #ffffff;
    }

    .image-title-wrap {
    padding: 0 15px 15px 15px;
    color: #222;
    }

    .drag-text {
    text-align: center;
    }

    .drag-text h3 {
    font-weight: 100;
    text-transform: uppercase;
    color: #15824B;
    padding: 60px 0;
    }

    .file-upload-image {
    max-height: 200px;
    max-width: 200px;
    margin: auto;
    padding: 20px;
    }

    .remove-image {
    width: 200px;
    margin: 0;
    color: #fff;
    background: #cd4535;
    border: none;
    padding: 10px;
    border-radius: 4px;
    border-bottom: 4px solid #b02818;
    transition: all .2s ease;
    outline: none;
    text-transform: uppercase;
    font-weight: 700;
    }

    .remove-image:hover {
    background: #c13b2a;
    color: #ffffff;
    transition: all .2s ease;
    cursor: pointer;
    }

    .remove-image:active {
    border: 0;
    transition: all .2s ease;
    }

</style>
@endpush
@push('scripts')
<script>
    $(document).ready(function(){
        $("#search").keyup(function(){
            $("#result").html('');
            var searchfield = $("#search").val();
            $.ajax({
                url: "search",
                method: "get",
                data:{name:searchfield},
                success:function(data){
                    $("#result").html(data);
                }

            });
        });
    });
</script>
@endpush
@section('link')
<li class="nav-item"><a href="{{ route('post.index') }}" class="nav-link">Home</a>
</li>
<li class="nav-item"><a href="{{ route('category.index') }}" class="nav-link">Categories</a>
</li>
<li class="nav-item"><a href="{{ route('profile.index') }}" class="nav-link active">Profile</a>
</li>
@endsection
@section('content')
<section style="background: url('https://images.unsplash.com/photo-1481627834876-b7833e8f5570?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=541&q=80'); background-size: cover; background-position: center bottom" class="divider">
    <div class="container">
      <div class="row">
        <div class="col-md-7">
          <h2>PROFILE</h2><a href="#" class="hero-link"></a>
        </div>
        <div class="col-md-7">
        </div>
      </div>
    </div>
</section>
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
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          @include('users.profile.info')
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Recent Posts</a></li>
                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Add Post</a></li>
                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Change Password</a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="activity">
                  <!-- Post -->
                    @forelse ($posts as $post)
                    <div class="post">
                        <div class="user-block">
                            <img style="width:20px;height:20px;" class="rounded-circle" src="https://thumbs.dreamstime.com/b/default-avatar-profile-icon-vector-social-media-user-portrait-176256935.jpg" alt="user image">
                          <span class="username">
                            <a href="#">{{ $post->user->firsname ." ".$post->user->lastname }}</a>
                          </span>
                          <span class="description">{{ $post->created_at->diffForHumans() ." | ".$post->created_at->format('h:i A')}}</span>
                        </div>
                        <!-- /.user-block -->
                        <a href="{{ route('post.show',$post->id) }}"><h4>Title: {{ $post->title }}</h4></a>
                        <div class="widget tags">
                        @if ($post->image)
                        <a href="{{ route('post.show',$post->id) }}">
                        <img style="width:200px;height:150px;" src="{{ asset('storage/'.$post->image) }}" alt="">
                        </a>
                        @else
                        <a href="{{ route('post.show',$post->id) }}">
                        <img style="width:200px;height:150px;" src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg" alt="">
                        </a>
                        @endif
                                <div class="container">
                                <a href="{{ route('post.show',$post->id) }}">

                                    {!! $post->description !!}
                                </a>
                                </div>

                            <li class="list-inline-item"><a href="{{ route('category.show',$post->category->id) }}" class="tag">#{{ $post->category->title }}</a></li>

                        </div>


                        {{-- <input class="form-control form-control-sm" type="text" placeholder="Type a comment"> --}}
                      </div>
                    @empty
                    You don't have any posts yet.
                    @endforelse
                  <!-- /.post -->
                  <div class="d-flex justify-content-center">
                   {{ $posts->links() }}
                  </div>

                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="timeline">

                          <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
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

                                <!-- /.form-group -->
                              <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row">
                              <div class="col-12 col-sm-6">
                                <div class="form-group">
                                  <label>Category</label>

                                  {{-- <select id="select"  class="form-control" style="width: 100%;">
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    @endforeach
                                  </select> --}}
                                    <input type="text" class="form-control" name="search" id="search" aria-describedby="helpId" placeholder="">
                                    <div id="result"></div>

                                </div>
                                <!-- /.form-group -->
                              </div>
                              <!-- /.col -->
                              <div class="col-10 col-sm-4">


                              </div>
                              <!-- /.col -->
                            </div>
                            <!-- /.row -->
                          </div>
                          <div class="file-upload">
                            <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>

                            <div class="image-upload-wrap">
                              <input class="file-upload-input" name="image" type='file' onchange="readURL(this);" accept="image/*" />
                              <div class="drag-text">
                                <h3>Drag and drop a file or select add Image</h3>
                              </div>
                            </div>
                            <div class="file-upload-content">
                              <img class="file-upload-image" src="#" alt="your image" />
                              <div class="image-title-wrap">
                                <button type="button" onclick="removeUpload()" class="remove-image">Remove <span class="image-title">Uploaded Image</span></button>
                              </div>
                            </div>
                          </div>


                          <!-- /.card-body -->
                          <div class="container mb-3">
                          <textarea id="summernote" name="description"></textarea>

                          </div>

                        <div class="form-group text-right mr-4">
                          <button type="submit" class="btn btn-primary">Add Post</button>
                        </div>
                      </form>

                </div>
                <!-- /.tab-pane -->

                <div class="tab-pane" id="settings">
                  <form method="POST" action="{{ route('profile.store') }}" class="form-horizontal">
                    @csrf
                    @method('POST')
                    @if ($errors->has('oldpassword'))
                    <span class="text-danger" role="alert">
                        {{ $errors->first('oldpassword') }}
                    </span><br>
                    @endif
                    @if ($errors->has('newpassword'))
                    <span class="text-danger" role="alert">
                        {{ $errors->first('newpassword') }}
                    </span><br>
                    @endif
                    @if ($errors->has('confirmpassword'))
                    <span class="text-danger" role="alert">
                        {{ $errors->first('confirmpassword') }}
                    </span><br>
                    @endif
                    <div class="form-group row">
                      <label for="inputName" class="col-sm-2 col-form-label">Old Password</label>
                      <div class="col-sm-10">
                        <input type="password" name="oldpassword" class="form-control" placeholder="Old Password">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail" class="col-sm-2 col-form-label">New Password</label>
                      <div class="col-sm-10">
                        <input type="password" name="newpassword" class="form-control"  placeholder="New Password">
                      </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Confirm Password</label>
                        <div class="col-sm-10">
                          <input type="password" name="confirmpassword" class="form-control"  placeholder="Confirm Password">
                        </div>
                      </div>
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-danger">Submit</button>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- Intro Section-->

 </div>







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

@endpush
