@extends('layouts.app')
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
@if (Session::has('message'))
<script>
$(document).ready(function(){
    $(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });


    $(function() {
      Toast.fire({
        icon: 'success',
        title: 'Message: Operation Success',
      })
    });
  });
})
</script>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    <strong>{{ session('message') }}</strong>
</div>
@endif
<!-- Button trigger modal -->
@if(Auth::user()->usertype == '1')
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
                @if(Auth::user()->usertype == '1')
                <th>Edit</th>
                <th>Delete</th>
                @endif
            </tr>
        </thead>
        <tbody>

            @forelse ($category as $key=>$cat)
            <tr>
                <td scope="row">{{ $key+1}}</td>
                <td>{{ $cat->title }}</td>
                <td>{{ $cat->description }}</td>
                @if(Auth::user()->usertype != '1')

                @else
                <td>
                    <!-- Button trigger edit modal -->
                    <div class="form-row">

                        <a name="" style="color:green;" id="" href="#" role="button" data-toggle="modal" data-target="#editModal{{ $cat->id }}">
                            <i class="fas fa-edit"></i>
                        </a>
                </td>
                <td>
                        <form id="deleteform" action="{{ route('category.destroy',$cat->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            {{-- <button class="btn"><i class="fa fa-close"></i></button> --}}
                                <button type="submit"  style="border: 0; background: none;color:red;">
                                 <i class="fas fa-trash    "></i>
                                </button>

                            <button  id="delete" disabled="disabled" type="submit" hidden="hidden"></button>
                        </form>
                        @endif
                    </div>
                    {{-- EDIT MODAL --}}
                    <!-- Modal -->
                    <div class="modal fade" id="editModal{{ $cat->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Category: {{ $cat->title }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body">
                                    <form  action="{{ route('category.update', $cat->id)  }}" id="editcategory" method="post">
                                        @method('PUT')
                                        @csrf
                                        <div class="form-group">
                                          <label for="title"></label>
                                          <input type="text" class="form-control" name="title"  aria-describedby="helpId" placeholder="" value="{{ $cat->title }}">
                                        </div>
                                        <div class="form-group">
                                          <label for="description"></label>
                                          <textarea class="form-control" name="description" col="60" rows="5" maxlength="100">{{ $cat->description }}</textarea>
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

                </td>

            </tr>
            @empty
            <tr>
                <td> Empty Category </td>
             </tr>


            @endforelse

        </tbody>

    </table>
    {{ $category->links() }}
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
                <form action="{{ route('category.store') }}" method="POST" id="addcategory">
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

                    {{-- @if ($errors->has('description'))
                          <strong class="text-danger">{{ $errors->first('description') }}</strong>

                    @endif --}}
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
