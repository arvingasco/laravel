@extends('layouts.app')

@section('title', 'Contact page')

@section('content')
<h1>Contact Page</h1>
<div>
    <p>
        Find me at my email: arvin.gasco@wedocode.co.uk <br>
    @can('home.personalContact')
            <a href="{{ route('home.personalContact')  }}">
                For more personal contact details, click me!
            </a>
    @endcan
    </p>
</div>
@endsection
