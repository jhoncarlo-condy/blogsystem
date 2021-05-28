
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

    </tr>
    @empty
    <tr>
        <td> Empty post </td>
     </tr>


    @endforelse
