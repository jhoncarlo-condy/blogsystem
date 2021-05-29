@extends('layouts.app')
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>

      // Enable pusher logging - don't include this in production
      Pusher.logToConsole = true;

      var pusher = new Pusher('deedc206526db9726e72', {
        cluster: 'ap1'
      });

      var channel = pusher.subscribe('my-channel');

        channel.bind('category-event', function(data)
        {
            $('#categorytable').load('{{ route('realtimecategory') }}').fadeIn("slow");

        });
        channel.bind('delete-category-event', function(data)
        {
            $('#categorytable').load('{{ route('realtimecategory') }}').fadeIn("slow");

        });
    </script>
@endpush
@section('content-header')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Category</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('users.dashboard') }}">Administrator</a></li>
            <li class="breadcrumb-item active">Category</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>
@endsection
@section('content-wrapper')
@php
$auth = Auth::user();
@endphp
@if ($errors->has('title'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    <strong>{{ $errors->first('title') }}</strong>
</div>
@endif

{{-- success message --}}
@if (Session::has('error'))

<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    <strong>{{ session('error') }}</strong>
</div>
@endif
<!-- Button trigger modal -->
@if($auth->usertype == '1')
<button type="button" class="btn btn-primary float-right my-2 mx-5" data-toggle="modal" data-target="#modelId">
  Add new category
</button>
@endif
<div class="container">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Posts Left</th>
                @if($auth->usertype == '1')
                <th>Edit</th>
                <th>Delete</th>
                @endif
            </tr>
        </thead>
        <tbody id="categorytable">

            @forelse ($categories as $key=>$category)
            <tr>
                <td scope="row">{{ $key+1}}</td>
                <td>{{ $category->title }}</td>
                <td>{{ $category->description }}</td>
                <td>{{ $category->blogmax }}</td>
                @if($auth->usertype != '1')

                @else
                <td>
                    <!-- Button trigger edit modal -->
                    <div class="form-row">
                        <a name="" style="color:green;" id="" href="#" role="button"
                         data-toggle="modal" data-target="#editModal{{ $category->id }}">
                            <i class="fas fa-edit"></i>
                        </a>
                </td>
                <td>
                    {{-- delete category --}}
                        <form id="deleteform"
                        action="{{ route('categories.destroy',$category->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                                <button type="submit"  style="border: 0; background: none;color:red;">
                                 <i class="fas fa-trash    "></i>
                                </button>
                            <button  id="delete" disabled="disabled" type="submit" hidden="hidden"></button>
                        </form>
                        @endif
                    </div>
                </td>
                {{-- EDIT MODAL --}}
                    <!-- Modal -->
                    <div class="modal fade" id="editModal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Category: {{ $category->title }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body">
                                    <form  action="{{ route('categories.update', $category->id)  }}" id="editcategory" method="post">
                                        @method('PUT')
                                        @csrf
                                        <div class="form-group">
                                          <label for="title"></label>
                                          <input type="text" class="form-control" name="title"  aria-describedby="helpId" placeholder="" value="{{ $category->title }}">
                                        </div>
                                        <div class="form-group">
                                          <label for="description"></label>
                                          <textarea class="form-control" name="description" col="60" rows="5" maxlength="100">{{ $category->description }}</textarea>
                                        </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
            </tr>
            @empty
            <tr>
                <td> Empty Category </td>
             </tr>


            @endforelse

        </tbody>

    </table>
    {{ $categories->links() }}
</div>

<!-- ADD Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add new category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('categories.store') }}" method="POST" id="addcategory">
                    @method('POST')
                    @csrf
                    <div class="form-group">
                      <label for="title">Category Title</label>
                      <input type="text" class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="">
                    </div>
                    @if ($errors->has('title'))
                            <strong class="text-danger">{{ $errors->first('title') }}</strong>
                    @endif
                    <div class="form-group">
                      <label for="description">Description</label>
                      <textarea class="form-control" name="description" id="description" cols="60" rows="5" maxlength="100"></textarea>
                    @if ($errors->has('description'))
                          <strong class="text-danger">{{ $errors->first('description') }}</strong>

                    @endif
                    </div>
                    <div class="form-group">
                        <label for="blogmax">Max Blog Post</label>
                        <input type="text" class="form-control" name="blogmax" id="blogmax" aria-describedby="helpId" placeholder="">

                      @if ($errors->has('blogmax'))
                              <strong class="text-danger">{{ $errors->first('blogmax') }}</strong>
                      @endif
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
            </div>
        </div>
    </div>
</div>


{{-- <button type="button" id="sample">sweetalert</button> --}}
@endsection
@push('scripts')
@if ($errors->has('title'))

<script>
    $(document).ready(function()
    {
        swal({
        title: "Error Adding Category",
        text: "The title has already been taken",
        type: "error",
        closeOnConfirm: false
        })
    });
</script>
@endif
@if (Session::has('error'))

<script>
    $(document).ready(function()
    {
        swal({
        title: "Error Deleting Category",
        text: "There's still existing post with the category you selected",
        type: "error",
        closeOnConfirm: false
        })
    });
</script>
@elseif(Session::has('message'))

<script>
    $(document).ready(function()
    {
        swal({
        title: "Success!",
        text: "Operation Success",
        type: "success",
        closeOnConfirm: false
        })
    });
</script>
@endif
<script>
    $(document).ready(function()
    {
        $("#addcategory").validate(
            {
                rules:
                {
                    title: "required",
                    description:
                    {
                        required:true,
                        maxlength:100,
                    },
                    blogmax: "required",

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
            $("#editcategory").validate(
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
        $("#delete").click(function(){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {


                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                }
                })

        });


    });
</script>
@endpush
