@extends('users.layouts.app')
@push('css')
@include('common.imagedesign')
@endpush
@push('scripts')
    @include('common.search')
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
@php
    $auth = Auth::user();
@endphp
<section style="background: url('https://images.unsplash.com/photo-1481627834876-b7833e8f5570?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=541&q=80'); background-size: cover; background-position: center bottom" class="divider">
    <div class="container">
      <div class="row">
        <div class="col-md-7">
          <h2>EDIT POST</h2><a href="#" class="hero-link"></a>
        </div>
        <div class="col-md-7">
        </div>
      </div>
    </div>
  </section>
  <div class="container"><br></div>
        <div class="container-fluid">
          <div class="card card-primary">
            <form id="editpost" action="{{ route('posts.update',$post->id) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                 <div class="form-group">
                   <label for="">Title</label>
                   <input type="text" class="form-control" name="title"
                    id="" aria-describedby="helpId" value="{{ $post->title }}">
                 </div>
                  <!-- /.form-group -->
                  <div class="form-group">
                    <label>Author</label>
                    <input type="text" class="form-control" name="" disabled
                    value="{{ $auth->firstname . " " . $auth->lastname }}" placeholder="">
                    <input type="hidden" name="user_id" value="{{ $auth->id }}">
                </div>
                <div class="form-group">
                    <label>Category</label>

                    <input type="text" class="form-control"
                      name="category" id="category-search"
                      aria-describedby="helpId" placeholder="Search category..." value="{{ $post->category->title }}">
                      <div class="card search-card">
                        <div class="card-header" style="background-color:rgb(134, 125, 125)">Recent</div>
                        <li class="list-group-item result found">{{ $post->category->title }}</li>

                          <div class="card-header" style="background-color:rgb(134, 125, 125)">Search Result</div>
                          <div class="list-group list-group-flush search-result" id="category-result">
                          </div>
                      </div>

                  </div>
                  <!-- /.form-group -->
                </div>
                <!-- /.col -->

                  <!-- /.form-group -->

                  <div class="mt-4 ml-4">
                        <label>Recent Image:</label>
                        <div class="container">
                            @if ($post->image)
                            <img style="height:100px;width:200px;"src="{{ asset('storage/'.$post->image) }}" class="img-thumbnail" alt="">
                            @else
                            <span>None</span>
                            @endif

                        </div>
                            @if ($post->image)
                            <label>Replace Image</label>
                            @else
                            <label>Upload Image</label>
                            @endif





                    </div>
                  </div>
                  <!-- /.form-group -->
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">



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
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.card-body -->
            <div class="form-group">
            <div class="mb-3 ml-2 mr-2">
                <textarea id="summernote" name="description">{{$post->description }}</textarea>
            </div>
            </div>
          <div class="form-group text-right mr-4">
            <button type="submit" class="btn btn-primary">Edit Post</button>
          </div>
        </form>

        </div>



@endsection
@push('scripts')

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
<script>
    $(document).ready(function()
    {
        $("#editpost").validate(
            {
                rules:
                {
                    title: "required",
                    description:
                    {
                        required:true,
                        maxlength:100,
                    }
                },
                messages:
                {
                    description:
                    {
                        required: "Please enter description",
                        maxlength: "description must be 100 characters or below"
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
                }


            });



    });
</script>
@endpush
