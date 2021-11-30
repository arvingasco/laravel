<h3><a href = '{{ route('posts.show', ['post' => $post->id]) }}' style = 'color:light blue'>{{ $post->title }}</a></h3>

<div>
    <p class="text-muted">
        Posted {{  $post->created_at->diffForHumans() }}
        by {{  $post->user->name }}.
    </p>
    <p>
        @if($post->comment_count>1)
            {{ $post->comment_count }} comments
        @elseif($post->comment_count==1)
            {{ $post->comment_count }} comment
        @else
            No comments
        @endif
    </p>
</div>
<div class = 'mb-3'>
    @can('update', $post)
        <a href = '{{ route('posts.edit', ['post' => $post->id]) }}' class = 'btn btn-primary'>
            Edit
        </a>
    @endcan
    @can('delete', $post)
        <form class = 'd-inline' action = '{{  route('posts.destroy', ['post' => $post->id]) }}' method = 'POST'>
            @csrf
            @method('DELETE')
            <input type = 'submit' value = 'Delete' onclick = "return confirm('Are you sure you want to delete this meme?')" class = 'btn btn-primary'>
        </form>
    @endcan
</div>


