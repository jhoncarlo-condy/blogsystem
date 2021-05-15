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
                          <img class="img-circle img-bordered-sm" src="https://thumbs.dreamstime.com/b/default-avatar-profile-icon-vector-social-media-user-portrait-176256935.jpg" alt="user image">
                          <span class="username">
                            <a href="#">{{ $post->user->firsname ." ".$post->user->lastname }}</a>
                          </span>
                          <span class="description">{{ $post->created_at->diffForHumans() ." | ".$post->created_at->format('h:i A')}}</span>
                        </div>
                        <!-- /.user-block -->
                        <h4>Title: {{ $post->title }}</h4>
                        <div class="widget tags">
                        @if ($post->image)
                        <img style="width:200px;height:150px;" src="{{ asset('storage/'.$post->image) }}" alt="">
                        @else
                        <img style="width:200px;height:150px;" src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg" alt="">
                        @endif
                            {!! $post->description !!}
                            <li class="list-inline-item"><a href="#" class="tag">#{{ $post->category->title }}</a></li>

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
                                    @foreach ($category as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->title }}</option>
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
                <!-- /.tab-pane -->

                <div class="tab-pane" id="settings">
                  <form class="form-horizontal">
                    <div class="form-group row">
                      <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputName" placeholder="Name">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName2" placeholder="Name">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                      <div class="col-sm-10">
                        <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="offset-sm-2 col-sm-10">
                        <div class="checkbox">
                          <label>
                            <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                          </label>
                        </div>
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
