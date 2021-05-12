@extends('layouts.app')
@push('css')
<style>
.file-drop-area {
    position: relative;
    display: flex;
    align-items: center;
    max-width: 100%;
    padding: 25px;
    border: 1px dashed rgba(255, 255, 255, 0.4);
    border-radius: 3px;
    transition: .2s
}

.choose-file-button {
    flex-shrink: 0;
    background-color: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 3px;
    padding: 8px 15px;
    margin-right: 10px;
    font-size: 12px;
    text-transform: uppercase
}

.file-message {
    font-size: small;
    font-weight: 300;
    line-height: 1.4;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis
}

.file-input {
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    widows: 100%;
    cursor: pointer;
    opacity: 0
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
            <li class="breadcrumb-item active">Edit Post</li>
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
              <h3 class="card-title">Edit Post</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <form action="{{ route('post.update',$posts->id) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                 <div class="form-group">
                   <label for="">Title</label>
                   <input type="text"
                     class="form-control" name="title" id="" aria-describedby="helpId" value="{{ $posts->title }}">
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
                        <label>Recent Image:</label>
                        <div class="container">
                            @if ($posts->image)
                            <img style="height:100px;width:200px;"src="{{ asset('storage/'.$posts->image) }}" class="img-thumbnail" alt="">
                            @else
                            <span>None</span>
                            @endif

                        </div>
                            @if ($posts->image)
                            <label>Replace Image</label>
                            @else
                            <label>Upload Image</label>
                            @endif


                    <div class="file-drop-area bordered">
                         <span class="choose-file-button">Choose Files</span>
                         <span class="file-message">or drag and drop files here</span>
                          <input type="file" name="image" class="file-input" accept=".jfif,.jpg,.jpeg,.png,.gif" value="{{  $posts->image }}">
                    </div>
                    <div  id="divImageMediaPreview">



                    </div>
                  </div>
                  <!-- /.form-group -->
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <label>Category</label>

                    <select class="form-control select2 select2-danger" name="category_id" data-dropdown-css-class="select2-danger" style="width: 100%;">
                        <option value="{{ $posts->category_id }}" selected="selected">{{ $find->title }}</option>
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
            <div class="mb-3 ml-2 mr-2">
            <textarea id="summernote" name="description">{{$posts->description }}</textarea>

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
