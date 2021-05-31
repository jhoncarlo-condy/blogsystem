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
