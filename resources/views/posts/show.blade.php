@extends('layouts.app')

@section('title', $post -> title)

@section('content')
<h1>{{  $post -> title }}</h1>
<p>{{  $post -> content }}</p>
<p class = "text-muted">
    Posted {{  $post -> created_at -> diffForHumans() }}
    by {{  $post->user->name }}. <br>
    Last updated {{ $post ->updated_at->diffForHumans() }}.
</p>

@if(now() -> diffInMinutes($post->created_at) < 60)
    <div class ='alert alert-info'>New Meme!</div>
@endif

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

<h4>Comments Section</h4>
@forelse($post->comment as $comm)
    <p>
        {{ $comm->content }} <br>

    </p>
    <p class="text-muted">
        Added {{  $comm -> created_at -> diffForHumans() }}.
    </p>
@empty
    <p>No comments yet!</p>
@endforelse

@endsection
