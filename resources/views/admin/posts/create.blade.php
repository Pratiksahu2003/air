@extends('admin.layouts.dashboard')

@section('title', 'Create Post')
@section('page-title', 'Create New Post')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-plus me-2"></i>Create New Post</h5>
    </div>
    <div class="card-body">
        <form id="postForm" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" required>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" placeholder="Auto-generated from title">
                        <small class="text-muted">Leave empty to auto-generate from title</small>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Excerpt</label>
                        <textarea class="form-control" id="excerpt" name="excerpt" rows="3" placeholder="Short description of the post"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Content <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="content" name="content" rows="15" required></textarea>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="mb-3">
                        <label for="featured_image" class="form-label">Featured Image</label>
                        <input type="file" class="form-control" id="featured_image" name="featured_image" accept="image/*">
                        <small class="text-muted">Max size: 2MB. Formats: JPEG, PNG, JPG, GIF, WEBP</small>
                        <div id="image-preview" class="mt-2"></div>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">Publish</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="is_published" name="is_published" value="1">
                                    <label class="form-check-label" for="is_published">Publish immediately</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="published_at" class="form-label">Publish Date</label>
                                <input type="datetime-local" class="form-control" id="published_at" name="published_at">
                            </div>
                            <button type="submit" class="btn btn-primary w-100" id="submitBtn">
                                <span class="spinner-border spinner-border-sm d-none" id="submitSpinner" role="status"></span>
                                Create Post
                            </button>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">Category</h6>
                        </div>
                        <div class="card-body">
                            <select class="form-select" id="category_id" name="category_id">
                                <option value="">Uncategorized</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">Tags</h6>
                        </div>
                        <div class="card-body">
                            @foreach($tags as $tag)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" id="tag_{{ $tag->id }}">
                                    <label class="form-check-label" for="tag_{{ $tag->id }}">{{ $tag->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">SEO Settings</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="meta_title" class="form-label">Meta Title</label>
                                <input type="text" class="form-control" id="meta_title" name="meta_title">
                                <small class="text-muted">Leave empty to use post title</small>
                            </div>
                            <div class="mb-3">
                                <label for="meta_description" class="form-label">Meta Description</label>
                                <textarea class="form-control" id="meta_description" name="meta_description" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
<script>
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Initialize Quill editor
const quill = new Quill('#content', {
    theme: 'snow',
    modules: {
        toolbar: [
            [{ 'header': [1, 2, 3, false] }],
            ['bold', 'italic', 'underline', 'strike'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'color': [] }, { 'background': [] }],
            ['link', 'image', 'video'],
            ['blockquote', 'code-block'],
            ['clean']
        ]
    }
});

// Auto-generate slug from title
document.getElementById('title').addEventListener('input', function() {
    if (!document.getElementById('slug').value) {
        const slug = this.value.toLowerCase()
            .replace(/[^\w\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .trim();
        document.getElementById('slug').value = slug;
    }
});

// Image preview
document.getElementById('featured_image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('image-preview');
            preview.innerHTML = `<img src="${e.target.result}" class="img-thumbnail" style="max-width: 300px; max-height: 200px;">`;
        };
        reader.readAsDataURL(file);
    }
});

// Form submission
document.getElementById('postForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const submitBtn = document.getElementById('submitBtn');
    const spinner = document.getElementById('submitSpinner');
    
    submitBtn.disabled = true;
    spinner.classList.remove('d-none');
    
    const formData = new FormData(this);
    
    // Get Quill content
    const content = quill.root.innerHTML;
    formData.append('content', content);
    
    // Convert is_published checkbox
    formData.append('is_published', document.getElementById('is_published').checked ? 1 : 0);
    
    axios.post('{{ route('admin.api.posts.store') }}', formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
    .then(function(response) {
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: response.data.message,
            confirmButtonColor: '#0d6efd'
        }).then(() => {
            window.location.href = '{{ route('admin.posts.index') }}';
        });
    })
    .catch(function(error) {
        if (error.response && error.response.status === 422) {
            const errors = error.response.data.errors;
            Object.keys(errors).forEach(key => {
                const input = document.getElementById(key);
                if (input) {
                    input.classList.add('is-invalid');
                    const feedback = input.nextElementSibling;
                    if (feedback && feedback.classList.contains('invalid-feedback')) {
                        feedback.textContent = errors[key][0];
                    }
                }
            });
            
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                html: Object.values(errors).flat().join('<br>'),
                confirmButtonColor: '#0d6efd'
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.response?.data?.message || 'An error occurred. Please try again.',
                confirmButtonColor: '#0d6efd'
            });
        }
    })
    .finally(function() {
        submitBtn.disabled = false;
        spinner.classList.add('d-none');
    });
});
</script>
@endpush

