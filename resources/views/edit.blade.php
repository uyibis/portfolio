@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mt-2 d-flex gap-3 flex-wrap">
        <a href="{{ route('home') }}" class="text-decoration-none">← Back to Dashboard</a>
        <a href="{{ route('projects.show', $post->slug) }}" class="text-decoration-none">View</a>
    </div>

    <div class="mt-4">
        <h2 class="h4">Edit Project</h2>
        <p class="text-muted mb-3">Update content, stacks, images, and publish state.</p>
    </div>

    <form action="{{ route('projects.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label fw-bold">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $post->title) }}"
                required>
            @error('title')
            <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="link" class="form-label fw-bold">Project link</label>
            <input type="text" name="link" id="link" class="form-control" value="{{ old('link', $post->link) }}"
                placeholder="e.g. https://example.com">
            @error('link')
            <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
            <div class="form-text">Optional. This is used by the “Open” button on the Projects slide.</div>
        </div>

        <div class="mb-3">
            <label for="stacks" class="form-label fw-bold">Stack list</label>
            @php
            $stackValue = '';
            if (is_array(old('stacks'))) {
            $stackValue = implode(', ', array_filter(old('stacks')));
            } elseif (is_string(old('stacks'))) {
            $stackValue = old('stacks');
            } elseif (is_array($post->stacks ?? null)) {
            $stackValue = implode(', ', array_filter($post->stacks));
            }
            @endphp
            <input type="text" name="stacks" id="stacks" class="form-control" value="{{ $stackValue }}"
                placeholder="e.g. Laravel, MySQL, Bootstrap, .NET">
            @error('stacks')
            <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
            <div class="form-text">Comma-separated list.</div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label fw-bold">Description</label>
            <textarea name="description" id="description" class="form-control"
                rows="10">{{ old('description', $post->description) }}</textarea>
            @error('description')
            <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="images_files" class="form-label fw-bold">Project images (optional)</label>
            <input type="file" name="images_files[]" id="images_files" class="form-control" accept="image/*" multiple>
            @error('images_files')
            <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
            @error('images_files.*')
            <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
            <div class="form-text">Uploads via AJAX. You can add/remove images before saving.</div>

            <div id="uploadStatus" class="small text-muted mt-2"></div>

            <div id="uploadedImages" class="row g-2 mt-2">
                @php
                $existingImages = old('images');
                if (!is_array($existingImages)) {
                $existingImages = $post->images ?? [];
                }
                if (!is_array($existingImages)) {
                $existingImages = [];
                }
                @endphp

                @foreach($existingImages as $img)
                @if(is_string($img) && trim($img) !== '')
                <div class="col-6 col-md-3" data-image-path="{{ $img }}">
                    <div class="border rounded p-1">
                        <img src="{{ $img }}" alt="Project image"
                            style="width: 100%; height: 120px; object-fit: cover; border-radius: 6px;">
                        <button type="button" class="btn btn-sm btn-outline-danger w-100 mt-1"
                            data-remove-image="{{ $img }}">Remove</button>
                    </div>
                </div>
                @endif
                @endforeach
            </div>

            <div id="imagesHiddenWrap">
                @foreach($existingImages as $img)
                @if(is_string($img) && trim($img) !== '')
                <input type="hidden" name="images[]" value="{{ $img }}">
                @endif
                @endforeach
            </div>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="publish" id="publish" value="1" {{ old('publish',
                $post->publish) ? 'checked' : '' }}>
            <label class="form-check-label" for="publish">Published</label>
        </div>

        <div class="d-flex gap-2 flex-wrap">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="{{ route('home') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>

    <script>
        (function () {
            var uploadUrl = "{{ route('projects.uploadImages') }}";
            var form = document.querySelector('form');
            var fileInput = document.getElementById('images_files');
            var statusEl = document.getElementById('uploadStatus');
            var uploadedWrap = document.getElementById('uploadedImages');
            var hiddenWrap = document.getElementById('imagesHiddenWrap');
            var csrfToken = document.querySelector('input[name="_token"]').value;
            var isUploading = false;

            function setStatus(text) {
                statusEl.textContent = text || '';
            }

            function removeImage(path) {
                var inputs = hiddenWrap.querySelectorAll('input[type="hidden"][name="images[]"]');
                for (var i = inputs.length - 1; i >= 0; i--) {
                    if (inputs[i].value === path) {
                        inputs[i].remove();
                    }
                }
                var cards = uploadedWrap.querySelectorAll('[data-image-path]');
                for (var j = cards.length - 1; j >= 0; j--) {
                    if (cards[j].dataset.imagePath === path) {
                        cards[j].remove();
                    }
                }
            }

            function addUploadedImage(path) {
                var hidden = document.createElement('input');
                hidden.type = 'hidden';
                hidden.name = 'images[]';
                hidden.value = path;
                hiddenWrap.appendChild(hidden);

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
                    removeImage(path);
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

                fileInput.value = '';
                setStatus(imgs.length ? 'Upload complete.' : 'No images uploaded.');
            }

            // Wire up existing remove buttons
            uploadedWrap.addEventListener('click', function (e) {
                var target = e.target;
                if (target && target.dataset && target.dataset.removeImage) {
                    removeImage(target.dataset.removeImage);
                }
            });

            fileInput.addEventListener('change', function () {
                uploadSelectedFiles().catch(function (err) {
                    console.error(err);
                    setStatus('Upload error. Please try again.');
                }).finally(function () {
                    isUploading = false;
                    form.querySelector('button[type="submit"]').disabled = false;
                });
            });

            form.addEventListener('submit', function (e) {
                if (isUploading) {
                    e.preventDefault();
                    setStatus('Please wait for uploads to finish.');
                    return;
                }
                if (fileInput.files && fileInput.files.length > 0) {
                    e.preventDefault();
                    uploadSelectedFiles().then(function () {
                        form.submit();
                    }).catch(function (err) {
                        console.error(err);
                        setStatus('Upload error. Please try again.');
                    });
                }
            });
        })();
    </script>
</div>
@endsection
