@extends('layouts.app')

@section('title', 'Memes')

@section('content')
<h1>Memes</h1>
@forelse ($posts as $post)
    @include ('posts/partials/post', [])
@empty
    <div>No memes found!</div>
@endforelse
@endsection
