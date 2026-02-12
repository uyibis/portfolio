@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mt-2 d-flex gap-3 flex-wrap">
        <a href="{{ route('home') }}" class="text-decoration-none">← Back to Dashboard</a>
        <a href="{{ route('projects.create') }}" class="text-decoration-none">Create New Project</a>
    </div>

    <h1 class="mt-4">Preview: {{ $post->title }}</h1>

    @if(is_array($post->stacks ?? null) && count($post->stacks))
    <div class="mb-3">
        <div class="text-muted small">Stack</div>
        <div>{{ implode(', ', $post->stacks) }}</div>
    </div>
    @endif

    <div class="description">
        {!! nl2br(e($post->description)) !!}
    </div>

    @if($post->featured_image)
    <div class="featured-image">
        <img src="{{ $post->featured_image }}" alt="Featured Image">
    </div>
    @endif

    @if(is_array($post->images ?? null) && count($post->images))
    <div class="mt-4">
        <h3 class="h5">Project Images</h3>
        <div class="row g-3">
            @foreach($post->images as $img)
            <div class="col-12 col-md-6">
                <img src="{{ $img }}" alt="Project image" style="width: 100%; border-radius: 12px;">
            </div>
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection
