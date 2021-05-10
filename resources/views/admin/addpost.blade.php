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
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
             <div class="form-group">
               <label for="">Title</label>
               <input type="text"
                 class="form-control" name="" id="" aria-describedby="helpId" placeholder="">
             </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>Author</label>
                <input type="text" class="form-control" name="" id="" disabled>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
              <div class="form-group">

                {{-- <label>Category</label>
                <select class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                @foreach ($posts as $post)
                    <option>{{ $post->category->id }}</option>
                @endforeach

                </select> --}}

              </div>
              <!-- /.form-group -->

              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <div class="row">
            <div class="col-12 col-sm-6">
              <div class="form-group">
                <label>Category</label>

                <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                    @foreach ($posts as $post)}
                    <option value="{{ $post->category->id}}">{{ $post->category->id}}</option>
                    @endforeach
                </select>

              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6">
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

      </div>
      <!-- /.card -->

      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-info">
            <div class="card-header">
              <h3 class="card-title">
                Content
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <textarea id="summernote">
                Place <em>some</em> <u>text</u> <strong>here</strong>
              </textarea>
            </div>

          </div>
        </div>
        <!-- /.col-->
      </div>
</section>


@endsection
@push('addpost')

<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            height: 300,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true                  // set focus to editable area after initializing summernote
        });
    });
    </script>
@endpush
