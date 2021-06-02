@extends('layouts.app')
@push('scripts')
    @include('common.pusher')
@endpush
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
@php
$auth = Auth::user();
@endphp
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
@if (Session::has('errorcategory'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    <strong>{{ session('errorcategory') }}</strong>
</div>
@endif
<!-- Button trigger modal -->
@if($auth->usertype == '1')
<div class="">
    <a name="" id="" class="btn btn-primary float-right mr-5 mb-2" href="{{ route('posts.create') }}" role="button">
     Add New Post
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
                @if($auth->usertype == '1')
                <th>Edit</th>
                <th>Delete</th>



                @endif
            </tr>
        </thead>
        <tbody id="posttable">
            @include('admin.posts.realtimeposts')
        </tbody>

    </table>
    {{ $posts->links() }}

</div>

@endsection
@push('scripts')
@if(Session::has('message'))
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
@if(Session::has('errorcategory'))
<script>
    $(document).ready(function()
    {
        swal({
        title: "Error!",
        text: "Please double check category field",
        type: "error",
        closeOnConfirm: false
        })
    });
</script>
@endif
@endpush
