@extends('layouts.app')

@section('title', 'Memes')

@section('content')
<div class="row">
    <div class="col-8">

    <h1>Memes</h1>
    @forelse ($posts as $post)
        @include ('posts/partials/post', [])
    @empty
        <div>No memes found!</div>
    @endforelse
    </div>
    <div class="col-4">
        <div class="container"></div>
            <div class="row">
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">
                            Trending Posts
                        </h5>
                        <h6 class="card-subtitle mb-2 text-muted">
                            The posts that are currently trending!
                        </h6>
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach ($mostCommented as $post)
                        <li class="list-group-item">
                            <a href="{{ route('posts.show', ['post' => $post->id]) }}">
                                {{ $post->title }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="row mt-4">
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">
                            Most Active Users
                        </h5>
                        <h6 class="card-subtitle mb-2 text-muted">
                            The users who have written the most posts!
                        </h6>
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach ($mostActive as $user)
                            <li class="list-group-item">
                                {{ $user->name }} - {{ $user->blogPosts->count() }} posts
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
