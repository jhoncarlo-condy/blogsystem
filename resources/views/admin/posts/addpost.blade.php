@extends('layouts.app')
@push('css')
    @include('common.imagedesign')
@endpush
@push('scripts')
    @include('common.search')
@endpush
@section('content-header')
@php
    $auth = Auth::user();
@endphp
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
            <li class="breadcrumb-item active">Add Post</li>
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
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
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
                      <input type="text" class="form-control"
                      name="category" id="category-search"
                      aria-describedby="helpId" placeholder="Search category...">
                      <div class="card search-card">
                          <div class="card-header" style="color:gray">Search Result</div>
                          <div class="list-group list-group-flush search-result" id="category-result">
                          </div>
                      </div>
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
        $("#addpost").validate(
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
