<h3><a href = '{{ route('posts.show', ['post' => $post -> id]) }}' style = 'color:light blue'>{{ $post -> title }}</a></h3>

<div class = 'mb-3'>
    <a href = '{{ route('posts.edit', ['post' => $post -> id]) }}' class = 'btn btn-primary'>Edit</a>
    <form class = 'd-inline' action = '{{  route('posts.destroy', ['post' => $post -> id]) }}' method = 'POST'>
        @csrf
        @method('DELETE')
        <input type = 'submit' value = 'Delete' onclick = "return confirm('Are you sure you want to delete this meme?')" class = 'btn btn-primary'>
    </form>
</div>

@if($post->comment_count>1)
    <p>{{ $post->comment_count }} comments.</p>
@elseif($post->comment_count==1)
    <p>{{ $post->comment_count }} comment.</p>
@else
    <p>No comments.</p>
@endif
