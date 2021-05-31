 <!-- post -->
 @forelse ($posts as $post)
 <div class="post col-xl-6">
     <div class="post-thumbnail">
         @if($post->image)
         <a href="{{ route('post.show',$post->id) }}">
          <img src="{{ asset('storage/'. $post->image) }}"  class="img-thumbnail" style="height: 200px;width:400px;">
         </a>
         @else
         <a href="{{ route('post.show', $post->id) }}">
         <img class="img-thumbnail" style="width:400px;height:200px;" src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg" alt="">
         </a>
         @endif
     </div>
     <div class="post-details">
       <div class="post-meta d-flex justify-content-between">
             <div class="date meta-last">{{ $post->created_at->format('m d') . "|" . $post->created_at->format('Y') }}</div>
             <div class="category"><a href="{{ route('post.show', $post->id) }}">{{ $post->category->title }}</a></div>
       </div><a href="{{ route('post.show', $post->user->id) }}">
         <h3 class="h4">{{ $post->title }}</h3></a>
       <p class="text-muted">See more ..</p>
       @auth
       @if ($post->user->id == Auth::user()->id)
       <footer class="post-footer d-flex align-items-center"><a href="#" class="author d-flex align-items-center flex-wrap">
           {{-- <div class="avatar"><img src="img/avatar-3.jpg" alt="..." class="img-fluid"></div> --}}
           <a href="{{ route('profile.index') }}">
           <div class="title">
               <i class="fas fa-user fa-xs"></i><span>Me</span>
           </div></a>
       <div class="date"><i class="fas fa-clock fa-xs"></i>{{ $post->created_at->diffForHumans() }}</div>
       <div class="comments meta-last"><i class="fas fa-comment fa-xs"></i></i>{{ count($post->comments) }}</div>
       </footer>
       @else
       <footer class="post-footer d-flex align-items-center"><a href="#" class="author d-flex align-items-center flex-wrap">
             {{-- <div class="avatar"><img src="img/avatar-3.jpg" alt="..." class="img-fluid"></div> --}}
             <a href="{{ route('profile.show',$post->user_id) }}">
             <div class="title">
                 <i class="fas fa-user fa-xs"></i><span>{{ $post->user->firstname }}</span>
             </div></a>
         <div class="date"><i class="fas fa-clock fa-xs"></i>{{ $post->created_at->diffForHumans() }}</div>
         <div class="comments meta-last"><i class="fas fa-comment fa-xs"></i></i>{{ count($post->comments) }}</div>
       </footer>
       @endif
       @endauth
       @guest
       <footer class="post-footer d-flex align-items-center"><a href="#" class="author d-flex align-items-center flex-wrap">
         {{-- <div class="avatar"><img src="img/avatar-3.jpg" alt="..." class="img-fluid"></div> --}}
         <a href="{{ route('profile.show',$post->user_id) }}">
         <div class="title">
             <i class="fas fa-user fa-xs"></i><span>{{ $post->user->firstname }}</span>
         </div></a>
         <div class="date"><i class="fas fa-clock fa-xs"></i>{{ $post->created_at->diffForHumans() }}</div>
         <div class="comments meta-last"><i class="fas fa-comment fa-xs"></i></i>{{ count($post->comments) }}</div>
      </footer>
       @endguest

     </div>
 </div>
 @empty
   Empty
 @endforelse
