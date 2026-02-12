@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mt-2">
        <a href="{{ route('home') }}" class="text-decoration-none">
            ← Back to Dashboard
        </a>
    </div>

    <div class="mt-4">
        <h2 class="h4">Create New Project</h2>
        <p class="text-muted mb-3">Add a portfolio project. Simple fields (no Markdown editor).</p>
    </div>

    <form action="{{ route('projects.store') }}" method="POST" id="postForm" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label fw-bold">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
            @error('title')
            <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="link" class="form-label fw-bold">Project link</label>
            <input type="text" name="link" id="link" class="form-control" value="{{ old('link') }}"
                placeholder="e.g. https://example.com">
            @error('link')
            <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
            <div class="form-text">Optional. This is used by the “Open” button on the Projects slide.</div>
        </div>

        <div class="mb-3">
            <label for="stacks" class="form-label fw-bold">Stack list</label>
            <input type="text" name="stacks" id="stacks" class="form-control" value="{{ old('stacks') }}"
                placeholder="e.g. Laravel, MySQL, Bootstrap, .NET">
            @error('stacks')
            <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
            <div class="form-text">Comma-separated list.</div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label fw-bold">Description</label>
            <textarea name="description" id="description" class="form-control"
                rows="10">{{ old('description') }}</textarea>
            @error('description')
            <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="images_files" class="form-label fw-bold">Project images</label>
            <input type="file" name="images_files[]" id="images_files" class="form-control" accept="image/*" multiple>
            @error('images_files')
            <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
            @error('images_files.*')
            <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
            <div class="form-text">Upload one or more images. The first image becomes the thumbnail.</div>

            <div id="uploadStatus" class="small text-muted mt-2"></div>

            <div id="uploadedImages" class="row g-2 mt-2"></div>

            <div id="imagesHiddenWrap">
                @php
                $oldImages = old('images');
                if (is_array($oldImages)) {
                foreach ($oldImages as $img) {
                if (is_string($img) && trim($img) !== '') {
                echo '<input type="hidden" name="images[]" value="' . e($img) . '">';
                }
                }
                }
                @endphp
            </div>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="publish" id="publish" value="1" {{ old('publish')
                ? 'checked' : '' }}>
            <label class="form-check-label" for="publish">Published</label>
        </div>

        <div class="d-flex gap-2 flex-wrap">
            <button type="submit" class="btn btn-primary">Save Project</button>
            <button type="button" id="previewButton" class="btn btn-outline-info">Preview</button>
        </div>
    </form>

    <script>
        (function () {
            var uploadUrl = "{{ route('projects.uploadImages') }}";
            var form = document.getElementById('postForm');
            var fileInput = document.getElementById('images_files');
            var statusEl = document.getElementById('uploadStatus');
            var uploadedWrap = document.getElementById('uploadedImages');
            var hiddenWrap = document.getElementById('imagesHiddenWrap');
            var csrfToken = document.querySelector('input[name="_token"]').value;
            var isUploading = false;
            var previewButton = document.getElementById('previewButton');

            function setStatus(text) {
                statusEl.textContent = text || '';
            }

            function hasUploadedImages() {
                return hiddenWrap.querySelectorAll('input[type="hidden"][name="images[]"]').length > 0;
            }

            function addUploadedImage(path) {
                // Hidden input
                var hidden = document.createElement('input');
                hidden.type = 'hidden';
                hidden.name = 'images[]';
                hidden.value = path;
                hiddenWrap.appendChild(hidden);

                // Thumbnail + remove
                var col = document.createElement('div');
                col.className = 'col-6 col-md-3';
                col.dataset.imagePath = path;

                var card = document.createElement('div');
                card.className = 'border rounded p-1';

                var img = document.createElement('img');
                img.src = path;
                img.alt = 'Uploaded image';
                img.style.width = '100%';
                img.style.height = '120px';
                img.style.objectFit = 'cover';
                img.style.borderRadius = '6px';

                var btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'btn btn-sm btn-outline-danger w-100 mt-1';
                btn.textContent = 'Remove';
                btn.addEventListener('click', function () {
                    // remove hidden input(s) for this path
                    var inputs = hiddenWrap.querySelectorAll('input[type="hidden"][name="images[]"]');
                    for (var i = inputs.length - 1; i >= 0; i--) {
                        if (inputs[i].value === path) {
                            inputs[i].remove();
                        }
                    }
                    col.remove();
                });

                card.appendChild(img);
                card.appendChild(btn);
                col.appendChild(card);
                uploadedWrap.appendChild(col);
            }

            async function uploadSelectedFiles() {
                if (!fileInput.files || fileInput.files.length === 0) {
                    return;
                }

                isUploading = true;
                form.querySelector('button[type="submit"]').disabled = true;
                document.getElementById('previewButton').disabled = true;
                setStatus('Uploading images...');

                var fd = new FormData();
                for (var i = 0; i < fileInput.files.length; i++) {
                    fd.append('images_files[]', fileInput.files[i]);
                }

                var resp = await fetch(uploadUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: fd
                });

                if (!resp.ok) {
                    var text = await resp.text();
                    throw new Error(text || ('Upload failed (' + resp.status + ')'));
                }

                var json = await resp.json();
                var imgs = (json && json.images) ? json.images : [];
                for (var j = 0; j < imgs.length; j++) {
                    addUploadedImage(imgs[j]);
                }

                // Clear selection to avoid double-upload on submit.
                fileInput.value = '';
                setStatus(imgs.length ? 'Upload complete.' : 'No images uploaded.');
            }

            fileInput.addEventListener('change', function () {
                uploadSelectedFiles().catch(function (err) {
                    console.error(err);
                    setStatus('Upload error. Please try again.');
                }).finally(function () {
                    isUploading = false;
                    form.querySelector('button[type="submit"]').disabled = false;
                    previewButton.disabled = false;
                });
            });

            previewButton.addEventListener('click', function (e) {
                e.preventDefault();

                if (isUploading) {
                    setStatus('Please wait for uploads to finish.');
                    return;
                }

                var goPreview = function () {
                    form.action = "{{ route('projects.preview') }}";
                    form.method = "POST";
                    form.submit();
                };

                if (fileInput.files && fileInput.files.length > 0) {
                    uploadSelectedFiles().then(goPreview).catch(function (err) {
                        console.error(err);
                        setStatus('Upload error. Please try again.');
                    });
                    return;
                }

                if (!hasUploadedImages()) {
                    setStatus('Please upload at least one image.');
                    return;
                }

                goPreview();
            });

            form.addEventListener('submit', function (e) {
                if (isUploading) {
                    e.preventDefault();
                    setStatus('Please wait for uploads to finish.');
                    return;
                }

                // If user selected files but didn't trigger upload (rare), upload first.
                if (fileInput.files && fileInput.files.length > 0) {
                    e.preventDefault();
                    uploadSelectedFiles().then(function () {
                        form.submit();
                    }).catch(function (err) {
                        console.error(err);
                        setStatus('Upload error. Please try again.');
                    });
                    return;
                }

                if (!hasUploadedImages()) {
                    e.preventDefault();
                    setStatus('Please upload at least one image.');
                }
            });
        })();
    </script>
</div>
@endsection
