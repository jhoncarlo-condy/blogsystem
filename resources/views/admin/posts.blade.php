@extends('layouts.app')

@section('content-header')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Posts</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('users.dashboard') }}">Administrator</a></li>
            <li class="breadcrumb-item active">Posts</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>
@endsection

@section('content-wrapper')
{{-- success message --}}
@if (Session::has('message'))
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
  Add new post
</button>
@endif
<div class="container">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Category</th>
                <th>Author</th>
                <th>Description</th>
                <th>Date&Time Published</th>
                <th>Comments</th>


                @if(Auth::user()->usertype == '1')
                <th>Action</th>
                @endif
            </tr>
        </thead>
        <tbody>

            @forelse ($posts as $key=>$post)
            <tr>
                <td scope="row">{{ $post->id}}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->category->title }}</td>
                <td>{{ $post->user->firstname }}</td>
                <td>{{ $post->description }}</td>
                <td>{{ $post->description }}</td>
                <td>{{ $post->description }}</td>
                @if(Auth::user()->usertype != '1')

                @else
                <td>
                    <!-- Button trigger edit modal -->
                    <div class="form-row">

                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editModal{{ $post->id }}">
                            <i class="fas fa-edit"></i>Edit
                        </button>

                        <form action="{{ route('post.destroy',$post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" id="delete">
                            <i class="fas fa-eraser"></i>Delete
                            </button>
                        </form>
                        @endif
                    </div>
                    {{-- EDIT MODAL --}}
                    <!-- Modal -->
                    <div class="modal fade" id="editModal{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit post: {{ $post->title }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('post.update', $post->id)  }} }}" method="post">
                                        @method('PUT')
                                        @csrf
                                        <div class="form-group">
                                          <label for="title"></label>
                                          <input type="text" class="form-control" name="title"  aria-describedby="helpId" placeholder="" value="{{ $post->title }}">
                                        </div>
                                        <div class="form-group">
                                          <label for="description"></label>
                                          <textarea class="form-control" name="description" id="" col="60" rows="5" maxlength="100">{{ $post->description }}</textarea>
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
                <td> Empty post </td>
             </tr>


            @endforelse

        </tbody>

    </table>
    {{ $posts->links() }}
</div>

<!-- ADD Modal -->
{{-- <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add new post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('post.store') }}" method="POST" id="post">
                    @method('POST')
                    @csrf
                    <div class="form-group">
                      <label for="title">post Title</label>
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
                    {{-- </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
            </div>
        </div>
    </div>
</div>  --}}


{{-- <button type="button" id="sample">sweetalert</button> --}}
@endsection
