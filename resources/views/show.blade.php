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

        @if(is_array($post->stacks ?? null) && count($post->stacks))
            <p><strong>Stack:</strong> {{ implode(', ', $post->stacks) }}</p>
        @endif

        <!-- Display post description with HTML already converted -->
        <div class="">{!! $post->description !!}</div>

        @if(is_array($post->images ?? null) && count($post->images))
            <hr>
            <h4>Project Images</h4>
            <div class="row g-3">
                @foreach($post->images as $img)
                    <div class="col-12 col-md-6">
                        <img src="{{ $img }}" alt="Project image" style="border-radius: 12px;">
                    </div>
                @endforeach
            </div>
        @endif

        <hr>

    </div>
@endsection
