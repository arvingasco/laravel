@extends('layouts.app')

@section('title', 'Add a meme')

@section('content')
<h1>Add Meme</h1>
<form action='{{ route('posts.store') }}' method ='POST'>
    @csrf
    @include('posts.partials.form')
    <div><input type = 'submit' value ='Create' class = 'btn btn-primary btn-block'></div>
</form>
@endsection
