<!-- resources/views/show.blade.php -->

@extends('layouts.project') <!-- or any layout you're using -->
@section('styles')
    <style>
        img{
            width: 100%;
        }
    </style>
@endsection
@section('content_title')
    <h3>{{ $post->title }}</h3>
@endsection
@section('content')
    <div class="container">
        <!-- Show any flash messages -->
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <p><strong>Author:</strong> {{ env('AUTHOR') ?? 'Unknown' }}</p>
        <p><strong>Portfolio:</strong> <a href="{{asset('')}}">View</a></p>

        <p><small>Posted on: {{ $post->created_at->format('M d, Y') }}</small></p>

        <!-- Display post description with HTML already converted -->
        <div class="">{!! $post->description !!}</div>

        <hr>

    </div>
@endsection
