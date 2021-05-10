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
                <input type="text" class="form-control" name="" disabled value="{{ Auth::user()->firstname . " " . Auth::user()->lastname }}" placeholder="">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
                <label>Upload Image</label>
                <div class="file-drop-area">
                     <span class="choose-file-button">Choose Files</span>
                     <span class="file-message">or drag and drop files here</span>
                      <input type="file" class="file-input" accept=".jfif,.jpg,.jpeg,.png,.gif" multiple>
                </div>
                <div id="divImageMediaPreview"> </div>
              <!-- /.form-group -->

              <!-- /.form-group -->
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <div class="row">
            <div class="col-12 col-sm-6">
              <div class="form-group">
                <label>Category</label>

                <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                    @foreach ($category as $category)}
                    <option value="{{ $category->id}}">{{ $category->title}}</option>
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
             <div class="editor">

            </div>

          </div>
        </div>
        <!-- /.col-->
      </div>

    </div>
</section>


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
