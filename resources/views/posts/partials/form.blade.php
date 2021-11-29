<div class = 'form-group'>
    <label for = 'title'>Meme</label>
    <input id = 'title' type ='text' class = 'form-control' name = 'title' value ='{{  old('title', optional($post ?? null) -> title) }}'>
</div>
@error('title')
    <div class = 'alert alert-danger'>{{ $message }}</div>
@enderror

<div class = 'form-group'>
    <label for = 'content'>Meme Content</label>
    <textarea class = 'form-control' name='content'>{{ old('content', optional($post ?? null) -> content) }}</textarea>
</div>
@error('content')
    <div class = 'alert alert-danger'> {{ $message }}</div>
@enderror

@if($errors->any())
    <div class = 'mb-3'>
        <ul class = 'list-group'>
            @foreach ($errors -> all() as $error)
            <li class = 'list-group-item list-group-item-danger'> {{ $error }} </li>
            @endforeach
        </ul>
    </div>
@endif