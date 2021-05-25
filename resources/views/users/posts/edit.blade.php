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
          <h2>EDIT POST</h2><a href="#" class="hero-link"></a>
        </div>
        <div class="col-md-7">
        </div>
      </div>
    </div>
  </section>
  <div class="container"><br></div>
        <div class="container-fluid">
          <!-- SELECT2 EXAMPLE -->
          <div class="card card-primary">

            <form action="{{ route('post.update',$post->id) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                 <div class="form-group">
                   <label for="">Title</label>
                   <input type="text"
                     class="form-control" name="title" id="" aria-describedby="helpId"
                     value="{{ $post->title }}">
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
                <div class="col-10 col-sm-6">

                  <!-- /.form-group -->
                </div>



                <div class="file-upload py-6">
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
            <div class="mb-3 ml-2 mr-2">
            <textarea id="summernote" name="description">{{$post->description }}</textarea>

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
            <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();">Edit Post</button>
          </div>
        </form>
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
@endpush
