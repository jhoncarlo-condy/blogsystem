@extends('layouts.app')
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
            <li class="breadcrumb-item active"><a href="{{ route('posts.index') }}">Posts</a></li>
            <li class="breadcrumb-item active">Edit Post</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>
@endsection
@section('content-wrapper')
@if ($errors->any())
@foreach ($errors->all() as $error)

<div class="alert alert-danger">
            {{ $error }}


</div>
@endforeach
@endif
    <section class="content">
        <div class="container-fluid">
          <!-- SELECT2 EXAMPLE -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit Post</h3>


            </div>
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
                    <input type="text" class="form-control" name="" disabled value="{{ Auth::user()->firstname . " " . Auth::user()->lastname }}" placeholder="">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                </div>
                <div class="form-group">
                    <label>Category</label>

                    <select class="form-control select2 select2-danger" name="category_id" data-dropdown-css-class="select2-danger" style="width: 100%;">
                        <option value="{{ $post->category_id }}" selected="selected">{{ $post->category->title }}</option>
                        @foreach ($categories as $category)}
                        <option value="{{ $category->id}}">{{ $category->title}}</option>
                        @endforeach
                    </select>

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
    </section>



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
