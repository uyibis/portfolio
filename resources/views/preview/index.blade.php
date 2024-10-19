@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Preview: {{ $post->title }}</h1>
        <div class="description">
            {!! $post->description !!}
        </div>

        @if($post->featured_image)
            <div class="featured-image">
                <img src="{{ $post->featured_image }}" alt="Featured Image">
            </div>
        @endif

        <a href="{{ route('posts.create') }}" class="btn btn-primary">Edit</a>
        <a href="{{ route('posts.store') }}" class="btn btn-success">Publish</a>

    </div>
@endsection
