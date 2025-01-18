@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
@endsection

@section('content')
<div class="container">
<!--    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>-->


    <div class="mt-2">
        <a href="{{ route('index') }}" class="text-green-600 no-underline">
            ← Back
        </a>
    </div>

    <div class="mt-5">
        <h2 class="text-2xl">
            Create New Tutorial
        </h2>
    </div>

    <form action="{{ route('posts.store') }}" method="POST" id="postForm">
        @csrf

        <div class="mb-4">
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2 border-slate-300">
                Title
            </label>

            <input type="text" name="title" id="title"
                   class="form-control focus:outline-none focus:shadow-outline"
                   value="{{ old('title') }}" required>

            @error('title')
            <p class="text-red-500 text-xs italic">
                {{ $message }}
            </p>
            @enderror
        </div>

        <div class="mb-0">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">
                Description
            </label>

            <textarea name="description" id="description"
                      class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                      rows="10">{{ old('description') }}</textarea>

            @error('description')
            <p class="text-red-500 text-xs italic">
                {{ $message }}
            </p>
            @enderror
        </div>

        {{-- Submit button --}}
        <div class="flex items-center justify-between">
{{--            <button type="submit"--}}
{{--                    class="btn btn-outline-primary">--}}
{{--                ➤ Save Tutorial--}}
{{--            </button>--}}
            <button type="submit"
                    class="btn btn-primary bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline border-0 cursor-pointer">
                ➤ Save
            </button>
            <button type="button" id="previewButton"
                    class="btn btn-secondary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline border-0 cursor-pointer">
                Preview
            </button>
        </div>
    </form>
    <script>
        document.getElementById('previewButton').addEventListener('click', function () {
            // Change the form's action to the preview route
            let form = document.getElementById('postForm');
            form.action = "{{ route('posts.preview') }}"; // Set the preview route
            form.method = "POST"; // Use POST for preview as well
            form.submit();
        });
    </script>
</div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script>
        var bodyEditor = new SimpleMDE({
            element: document.getElementById("description"),
            tabSize: 4,
            showIcons: ["code", "table"],
            toolbar: [
                "bold",
                "italic",
                "heading",
                "|",
                "quote",
                "unordered-list",
                "ordered-list",
                "|",
                "link",
                "image",
                "|",
                "preview",
                "side-by-side",
                "fullscreen",
                "|",
                "guide"
            ]
        });
    </script>
@endsection
