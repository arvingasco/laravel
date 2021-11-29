@extends('layouts.app')

@section('title', $post -> title)

@section('content')
<h1>{{  $post -> title }}</h1>
<p>{{  $post -> content }}</p>
<p class = "text-muted"> 
    Posted {{  $post -> created_at -> diffForHumans() }}. <br>
    Last updated {{ $post ->updated_at->diffForHumans() }}.
</p>

@if(now() -> diffInMinutes($post->created_at) < 60)
    <div class ='alert alert-info'>New Meme!</div>
@endif

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

{{-- <form action='{{ route('posts.store') }}' method ='POST'>
    @csrf
    @include('posts.partials.comment_form')
    <div><input type = 'submit' value ='Create' class = 'btn btn-primary btn-block'></div>
</form> --}}

@endsection