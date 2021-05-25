
          <!-- Profile Image -->
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="profile-user-img img-fluid img-circle" src="https://thumbs.dreamstime.com/b/default-avatar-profile-icon-vector-social-media-user-portrait-176256935.jpg" alt="User profile picture">
              </div>

              <h3 class="profile-username text-center">{{ Auth::user()->firstname . " " . Auth::user()->lastname }}</h3>

              <p class="text-muted text-center">
                  @if (Auth::user()->usertype  == 3)
                    User
                  @else
                    Admin
                  @endif
              </p>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Posts</b> <p class="float-right">{{count(Auth::user()->post)}}</p>
                </li>
                <li class="list-group-item">
                    <b>Last Post</b> <p class="float-right">
                   @if (count(Auth::user()->post) > 0)
                   {{ Auth::user()->post->last()->created_at->diffForHumans() }}
                   @else
                   n/a
                   @endif
                    </p>
                </li>
                <li class="list-group-item">
                    <b>Your total Comments</b> <p class="float-right">
                    @if (count(Auth::user()->comment) > 0 )
                       {{ count(Auth::user()->comment)}}
                    @else
                    0
                    @endif
                    </p>
                </li>
              </ul>



              {{-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> --}}
            </div>
            <!-- /.card-body -->
          </div>
