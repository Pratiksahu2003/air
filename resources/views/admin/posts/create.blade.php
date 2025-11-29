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
                        <textarea class="form-control" id="content" name="content" rows="15"></textarea>
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
                        <div class="card-header bg-black">
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
                        <div class="card-header bg-black d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Tags</h6>
                            <button type="button" class="btn btn-sm btn-primary" onclick="openAddTagModal()">
                                <i class="fas fa-plus me-1"></i>Add New Tag
                            </button>
                        </div>
                        <div class="card-body">
                            <select class="form-select" id="tags" name="tags[]" multiple size="8" style="min-height: 200px;">
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </select>
                            <small class="text-muted">Hold Ctrl (Windows) or Cmd (Mac) to select multiple tags</small>
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

<!-- Add Tag Modal -->
<div class="modal fade" id="addTagModal" tabindex="-1" aria-labelledby="addTagModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTagModalLabel">Add New Tag</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addTagForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="new_tag_name" class="form-label">Tag Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="new_tag_name" name="name" required>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="addTagSubmitBtn">
                        <span class="spinner-border spinner-border-sm d-none" id="addTagSpinner" role="status"></span>
                        Add Tag
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script>
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Initialize CKEditor
let editor;
ClassicEditor
    .create(document.querySelector('#content'), {
        toolbar: {
            items: [
                'heading', '|',
                'bold', 'italic', 'underline', 'strikethrough', '|',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                'bulletedList', 'numberedList', '|',
                'alignment', '|',
                'link', 'insertImage', 'insertTable', 'blockQuote', 'codeBlock', '|',
                'undo', 'redo', '|',
                'removeFormat'
            ]
        },
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
            ]
        },
        fontSize: {
            options: [9, 11, 13, 'default', 17, 19, 21]
        }
    })
    .then(editorInstance => {
        editor = editorInstance;
        // Remove required attribute from hidden textarea to prevent validation errors
        const contentTextarea = document.querySelector('#content');
        if (contentTextarea) {
            contentTextarea.removeAttribute('required');
        }
    })
    .catch(error => {
        console.error('Error initializing CKEditor:', error);
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

// Add Tag Modal
let addTagModal;
document.addEventListener('DOMContentLoaded', function() {
    addTagModal = new bootstrap.Modal(document.getElementById('addTagModal'));
    
    document.getElementById('addTagForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const submitBtn = document.getElementById('addTagSubmitBtn');
        const spinner = document.getElementById('addTagSpinner');
        const tagName = document.getElementById('new_tag_name').value.trim();
        
        if (!tagName) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please enter a tag name',
                confirmButtonColor: '#0d6efd'
            });
            return;
        }
        
        submitBtn.disabled = true;
        spinner.classList.remove('d-none');
        
        axios.post('{{ route('admin.api.tags.store') }}', { name: tagName })
            .then(function(response) {
                const newTag = response.data.data;
                
                // Add new tag to the select dropdown
                const tagsSelect = document.getElementById('tags');
                const newOption = document.createElement('option');
                newOption.value = newTag.id;
                newOption.textContent = newTag.name;
                newOption.selected = true;
                tagsSelect.appendChild(newOption);
                
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Tag created and added to post',
                    confirmButtonColor: '#0d6efd',
                    timer: 1500,
                    timerProgressBar: true
                });
                
                addTagModal.hide();
                document.getElementById('addTagForm').reset();
            })
            .catch(function(error) {
                if (error.response && error.response.status === 422) {
                    const errors = error.response.data.errors;
                    let errorMessage = Object.values(errors).flat().join('<br>');
                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        html: errorMessage,
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
});

function openAddTagModal() {
    document.getElementById('addTagForm').reset();
    addTagModal.show();
}

// Form submission
document.getElementById('postForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Check if editor is ready
    if (!editor) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Editor is not ready. Please wait a moment and try again.',
            confirmButtonColor: '#0d6efd'
        });
        return;
    }
    
    // Validate required fields
    const title = document.getElementById('title').value.trim();
    const content = editor.getData().trim();
    
    if (!title) {
        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            text: 'Please enter a title for the post.',
            confirmButtonColor: '#0d6efd'
        });
        document.getElementById('title').focus();
        return;
    }
    
    if (!content) {
        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            text: 'Please enter content for the post.',
            confirmButtonColor: '#0d6efd'
        });
        editor.focus();
        return;
    }
    
    const submitBtn = document.getElementById('submitBtn');
    const spinner = document.getElementById('submitSpinner');
    
    submitBtn.disabled = true;
    spinner.classList.remove('d-none');
    
    // Build FormData manually to ensure all fields are included
    const formData = new FormData();
    
    // Validate that we have the required values
    if (!title || title.trim() === '') {
        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            text: 'Title is required and cannot be empty.',
            confirmButtonColor: '#0d6efd'
        });
        submitBtn.disabled = false;
        spinner.classList.add('d-none');
        return;
    }
    
    if (!content || content.trim() === '') {
        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            text: 'Content is required and cannot be empty.',
            confirmButtonColor: '#0d6efd'
        });
        submitBtn.disabled = false;
        spinner.classList.add('d-none');
        return;
    }
    
    // Add all form fields explicitly - ensure values are strings
    formData.append('title', String(title).trim());
    formData.append('content', String(content).trim());
    
    const slugEl = document.getElementById('slug');
    const excerptEl = document.getElementById('excerpt');
    const categoryEl = document.getElementById('category_id');
    const metaTitleEl = document.getElementById('meta_title');
    const metaDescEl = document.getElementById('meta_description');
    const publishedAtEl = document.getElementById('published_at');
    
    if (slugEl) formData.append('slug', slugEl.value ? String(slugEl.value).trim() : '');
    if (excerptEl) formData.append('excerpt', excerptEl.value ? String(excerptEl.value).trim() : '');
    if (categoryEl && categoryEl.value) formData.append('category_id', String(categoryEl.value));
    if (metaTitleEl) formData.append('meta_title', metaTitleEl.value ? String(metaTitleEl.value).trim() : '');
    if (metaDescEl) formData.append('meta_description', metaDescEl.value ? String(metaDescEl.value).trim() : '');
    if (publishedAtEl && publishedAtEl.value) formData.append('published_at', String(publishedAtEl.value));
    
    const isPublishedEl = document.getElementById('is_published');
    formData.append('is_published', isPublishedEl && isPublishedEl.checked ? '1' : '0');
    
    // Add tags
    const tagsSelect = document.getElementById('tags');
    if (tagsSelect) {
        const selectedTags = Array.from(tagsSelect.selectedOptions).map(option => option.value);
        selectedTags.forEach(tagId => {
            if (tagId) {
                formData.append('tags[]', String(tagId));
            }
        });
    }
    
    // Add featured image if a file is selected
    const featuredImageInput = document.getElementById('featured_image');
    if (featuredImageInput && featuredImageInput.files && featuredImageInput.files.length > 0) {
        const file = featuredImageInput.files[0];
        if (file) {
            formData.append('featured_image', file, file.name);
            console.log('Featured image added:', file.name, 'Size:', file.size, 'Type:', file.type);
        }
    } else {
        console.log('No featured image file selected');
    }
    
    // Debug: Log FormData contents (remove in production)
    console.log('FormData contents:');
    for (let pair of formData.entries()) {
        if (pair[1] instanceof File) {
            console.log(pair[0] + ': [File] ' + pair[1].name + ' (' + pair[1].size + ' bytes, ' + pair[1].type + ')');
        } else {
            console.log(pair[0] + ': ' + pair[1]);
        }
    }
    
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

