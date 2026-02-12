<!-- resources/views/show.blade.php -->

@extends('layouts.project') <!-- or any layout you're using -->
@section('styles')
    <style>
        img{
            /*width: 100%;*/
        }
    </style>
@endsection
@section('content_title')
    <h3>Projects</h3>
@endsection
@section('content')
    <div class="container">
        <div class="row portfolio-wrapper">
            <!-- portfolio item -->

            <!-- portfolio item -->
            @foreach($posts as $post)
                <div class="col-md-4 col-sm-6 grid-item creative design">
                    <a href="{{ route('projects.show', $post->slug) }}">
                        <div class="portfolio-item">
                            <div class="details">
                                <h4 class="title">{{ $post->title }}</h4>
                                <!--                                <span class="term">Project, Tags</span> -->
                                <!-- Adjust as needed for categories/tags -->
                            </div>
                            <span class="plus-icon">+</span>
                            <div class="thumb">
                                <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" />
                                <div class="mask"></div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    </div>
@endsection
