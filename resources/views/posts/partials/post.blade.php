<h3><a href = '{{ route('posts.show', ['post' => $post->id]) }}'>{{ $post->title }}</a></h3>

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



