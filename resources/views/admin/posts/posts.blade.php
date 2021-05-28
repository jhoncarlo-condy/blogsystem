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

        channel.bind('post-event', function(data)
        {
            $('#posttable').load('{{ route('realtimepost') }}').fadeIn("slow");

        });
    </script>
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
<!-- Button trigger modal -->
@if(Auth::user()->usertype == '1')
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
                @if(Auth::user()->usertype == '1')
                <th>Edit</th>
                <th>Delete</th>



                @endif
            </tr>
        </thead>
        <tbody id="posttable">

            @forelse ($posts as $key=>$post)
            <tr>
                <td scope="row">{{ $key+1}}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->category->title }}</td>
                <td>{{ $post->user->firstname }}</td>
                <td>{{ $post->created_at->format('m-d-Y') }}</td>
                <td>{{ $post->created_at->format('h:i A') }}</td>
                <td>
                    <a name="" id="" href="{{ route('posts.show', $post->id) }}" role="button">
                        <i class="fas fa-eye    "></i>
                    </a>
                </td>
                @if(Auth::user()->usertype != '1')

                @else
                <td>
                    <!-- Button trigger edit modal -->
                    <a name="" id="" style="color:green;" href="{{ route('posts.edit', $post->id) }}" role="button">
                        <i class="fas fa-edit    "></i>
                    </a>
                </td>
                <td>
                        <form id="deleteform" action="{{ route('posts.destroy',$post->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit"  style="border: 0; background: none;color:red;">
                                <i class="fas fa-trash    "></i>
                            </button>
                        </form>
                </td>
                @endif

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
@endpush
