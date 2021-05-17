@extends('users.layouts.app')
@push('css')
<style>
    .image img
    {
        width:400px;
    }
    .file-upload {
  background-color: #ffffff;
  width: 600px;
  margin: 0 auto;
  padding: 20px;
}

.file-upload-btn {
  width: 100%;
  margin: 0;
  color: #fff;
  background: #1FB264;
  border: none;
  padding: 10px;
  border-radius: 4px;
  border-bottom: 4px solid #15824B;
  transition: all .2s ease;
  outline: none;
  text-transform: uppercase;
  font-weight: 700;
}

.file-upload-btn:hover {
  background: #1AA059;
  color: #ffffff;
  transition: all .2s ease;
  cursor: pointer;
}

.file-upload-btn:active {
  border: 0;
  transition: all .2s ease;
}

.file-upload-content {
  display: none;
  text-align: center;
}

.file-upload-input {
  position: absolute;
  margin: 0;
  padding: 0;
  width: 100%;
  height: 100%;
  outline: none;
  opacity: 0;
  cursor: pointer;
}

.image-upload-wrap {
  margin-top: 20px;
  border: 4px dashed #1FB264;
  position: relative;
}

.image-dropping,
.image-upload-wrap:hover {
  background-color: #1FB264;
  border: 4px dashed #ffffff;
}

.image-title-wrap {
  padding: 0 15px 15px 15px;
  color: #222;
}

.drag-text {
  text-align: center;
}

.drag-text h3 {
  font-weight: 100;
  text-transform: uppercase;
  color: #15824B;
  padding: 60px 0;
}

.file-upload-image {
  max-height: 200px;
  max-width: 200px;
  margin: auto;
  padding: 20px;
}

.remove-image {
  width: 200px;
  margin: 0;
  color: #fff;
  background: #cd4535;
  border: none;
  padding: 10px;
  border-radius: 4px;
  border-bottom: 4px solid #b02818;
  transition: all .2s ease;
  outline: none;
  text-transform: uppercase;
  font-weight: 700;
}

.remove-image:hover {
  background: #c13b2a;
  color: #ffffff;
  transition: all .2s ease;
  cursor: pointer;
}

.remove-image:active {
  border: 0;
  transition: all .2s ease;
}



</style>
@endpush
@section('link')
<li class="nav-item"><a href="{{ route('blog.index') }}" class="nav-link">Home</a>
</li>
<li class="nav-item"><a href="{{ route('categories') }}" class="nav-link">Categories</a>
</li>
<li class="nav-item"><a href="{{ route('profile') }}" class="nav-link active">Profile</a>
</li>
@endsection
@section('content')
<section style="background: url('https://images.unsplash.com/photo-1481627834876-b7833e8f5570?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=541&q=80'); background-size: cover; background-position: center bottom" class="divider">
    <div class="container">
      <div class="row">
        <div class="col-md-7">
          <h2>PROFILE</h2><a href="#" class="hero-link"></a>
        </div>
        <div class="col-md-7">
        </div>
      </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle" src="https://thumbs.dreamstime.com/b/default-avatar-profile-icon-vector-social-media-user-portrait-176256935.jpg" alt="User profile picture">
              </div>
              @forelse ($posts as $post)

              <h3 class="profile-username text-center">{{ $post->user->firstname . " " . $post->user->lastname }}</h3>

              <p class="text-muted text-center">
                  @if ($post->user->usertype  == 3)
                    User
                  @elseif ($post->user->usertype  == 2)
                    Admin
                  @else
                    SuperAdmin
                  @endif
              </p>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Posts</b> <p class="float-right">{{$count}}</p>
                </li>
                <li class="list-group-item">
                    <b>Last Post</b> <p class="float-right">
                    @forelse ($last->take(1) as $last)
                    {{ $last->created_at->diffForHumans()}}
                    @empty
                    n/a
                    @endforelse
                    </p>
                </li>
                <li class="list-group-item">
                    <b>Total Comments</b> <p class="float-right">
                    @if ($commentcount > 0 )
                        {{ $commentcount }}
                    @else
                    0
                    @endif
                    </p>
                </li>
              </ul>



              <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <!-- About Me Box -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">About Me</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <strong><i class="fas fa-book mr-1"></i> Education</strong>

              <p class="text-muted">
                B.S. in Computer Science from the University of Tennessee at Knoxville
              </p>

              <hr>

              <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

              <p class="text-muted">Malibu, California</p>

              <hr>

              <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

              <p class="text-muted">
                <span class="tag tag-danger">UI Design</span>
                <span class="tag tag-success">Coding</span>
                <span class="tag tag-info">Javascript</span>
                <span class="tag tag-warning">PHP</span>
                <span class="tag tag-primary">Node.js</span>
              </p>

              <hr>

              <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

              <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
            </div>
            <!-- /.card-body -->
          </div>

          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Recent Posts</a></li>
             </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active" id="activity">
                  <!-- Post -->
                    <div class="post">
                        <div class="user-block">
                          <img class="img-circle img-bordered-sm" src="https://thumbs.dreamstime.com/b/default-avatar-profile-icon-vector-social-media-user-portrait-176256935.jpg" alt="user image">
                          <span class="username">
                            <a href="#">{{ $post->user->firstname ." ".$post->user->lastname }}</a>
                          </span>
                          <span class="description">{{ $post->created_at->diffForHumans() ." | ".$post->created_at->format('h:i A')}}</span>
                        </div>
                        <!-- /.user-block -->
                        <a href="{{ route('blog.show',$post->id) }}"><h4>Title: {{ $post->title }}</h4></a>
                        <div class="widget tags">
                        @if ($post->image)
                        <a href="{{ route('blog.show',$post->id) }}">
                        <img style="width:200px;height:150px;" src="{{ asset('storage/'.$post->image) }}" alt="">
                        </a>
                        @else
                        <a href="{{ route('blog.show',$post->id) }}">
                        <img style="width:200px;height:150px;" src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg" alt="">
                        </a>
                        @endif
                                <div class="container">
                                <a href="{{ route('blog.show',$post->id) }}">

                                    {!! $post->description !!}
                                </a>
                                </div>

                            <li class="list-inline-item"><a href="{{ route('categories') }}" class="tag">#{{ $post->category->title }}</a></li>

                        </div>


                        {{-- <input class="form-control form-control-sm" type="text" placeholder="Type a comment"> --}}
                      </div>
                    @empty
                    You don't have any posts yet.
                    @endforelse
                  <!-- /.post -->
                  <div class="d-flex justify-content-center">
                   {{ $posts->links() }}
                  </div>

                </div>

              </div>
              <!-- /.tab-content -->
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- Intro Section-->

 </div>







@endsection
