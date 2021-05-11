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
<div class="">
    <a name="" id="" class="btn btn-primary float-right mr-5 mb-2" href="{{ route('post.create') }}" role="button">
    <i class="fas fa-plus-circle">Add New Post</i>
    </a>
</div>
@endif
<div class="container">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Category</th>
                <th>Author</th>
                <th>Date Published</th>
                <th>Time</th>
                <th>View</th>
                @if(Auth::user()->usertype == '1')
                <th>Edit</th>
                <th>Delete</th>



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
                <td>{{ $post->created_at->format('d/m/Y') }}</td>
                <td>{{ $post->created_at->format('H:i A') }}</td>
                <td>
                    <a name="" id="" href="{{ route('post.show', $post->id) }}" role="button">
                        <i class="fas fa-eye    "></i>
                        View
                    </a>
                </td>
                @if(Auth::user()->usertype != '1')

                @else
                <td>
                    <!-- Button trigger edit modal -->
                    <div class="form-row">
                        <a href="{{ route('post.edit',$post->id) }}">
                        <button type="button" class="btn btn-primary">

                            <i class="fas fa-edit">Edit</i>
                        </button>
                        </a>
                        <form action="{{ route('post.destroy',$post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" id="delete" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();">
                            <i class="fas fa-eraser"></i>Delete
                            </button>
                        </form>
                        @endif
                    </div>

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

@endsection
