@extends('layouts.app')
@push('scripts')
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
            var total  = data.categorycount + parseInt($("#categorycount").text());
            $("#categorycount").text(total);
        });
        channel.bind('post-event', function(data)
        {
            var total  = data.postcount + parseInt($("#postcount").text()) - data.delete;
            $("#postcount").text(total);
        });
        channel.bind('user-event', function(data)
        {
            var total  = data.usercount + parseInt($("#usercount").text());
            $("#usercount").text(total);
        });channel.bind('comment-event', function(data)
        {
            var total  = data.commentcount + parseInt($("#commentcount").text());
            $("#commentcount").text(total);
        });
    </script>
@endpush
@section('content-header')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('users.dashboard') }}">Administrator</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>
@endsection
@section('content-wrapper')
<section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3 id="usercount">{{ $countusers }}</h3>

              <p>Registered Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('users.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3 id="categorycount">{{ $countcat }}<sup style="font-size: 20px"></sup></h3>

              <p>Total Categories</p>
            </div>
            <div class="icon">
                <i class="fas fa-tags    "></i>
            </div>
            <a href="{{ route('categories.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3 id="postcount">{{ $countpost }}</h3>

              <p>Total Posts</p>
            </div>
            <div class="icon">
              <i class="fas fa-comment-alt    "></i>
            </div>
            <a href="{{ route('posts.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3 id="commentcount">{{ $commentcount }}</h3>

              <p>Total Comments</p>
            </div>
            <div class="icon">
                <i class="fas fa-comment-dots    "></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
    </div>
</section>


@endsection
