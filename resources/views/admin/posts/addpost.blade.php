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
            <li class="breadcrumb-item active">Add Post</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>
@endsection
@section('content-wrapper')

    <section class="content">
        <div class="container-fluid">
          <!-- SELECT2 EXAMPLE -->
          @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add Post</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
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

                    <select class="form-control " name="category_id" data-dropdown-css-class="select2-danger" style="width: 100%;">
                        @foreach ($category as $category)}
                        <option value="{{ $category->id}}">{{ $category->title}}</option>
                        @endforeach
                    </select>

                  </div>
                  <!-- /.form-group -->
                </div>
                <!-- /.col -->

                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.card-body -->
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



@endsection
@push('addpost')

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
