@php
    $auth = Auth::user();
@endphp
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
    @if($auth->usertype != '1')

    @else
    <td>
        <!-- Button trigger edit modal -->
        <a name="" id="" style="color:green;" href="{{ route('posts.edit', $post->id) }}" role="button">
            <i class="fas fa-edit    "></i>
        </a>
    </td>
    <td>
        <a name="" style="color:red;" id="" href="#" role="button"
        data-toggle="modal" data-target="#deleteModal{{ $post->id }}">
           <i class="fas fa-trash"></i>
       </a>
       <!-- Modal -->
       <div class="modal fade" data-backdrop="static" id="deleteModal{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
           <div class="modal-dialog" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title"><i class="fas fa-exclamation-triangle" style="color:yellow;"></i>Are you sure you want to delete?<i class="fas fa-exclamation-triangle" style="color:yellow;"></i></h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                           </button>
                   </div>
                   <div class="modal-body">
                       <strong>Note: Post will be deleted permanently!</strong>
                       <form id="deleteform"
                       action="{{ route('posts.destroy',$post->id) }}" method="POST">
                           @csrf
                           @method('DELETE')
                           <div class="container text-right">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                           <button type="submit" class="btn btn-danger">Delete</button>
                           </div>
                           </form>
                   </div>

               </div>
           </div>
       </div>
    </td>
    @endif

</tr>
@empty
<tr>
    <td> Empty post </td>
    </tr>


@endforelse
