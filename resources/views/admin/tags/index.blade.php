@extends('admin.layouts.dashboard')

@section('title', 'Tag Management')
@section('page-title', 'Tag Management')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-tags me-2"></i>Tags</h5>
        <button type="button" class="btn btn-light btn-sm" onclick="openAddModal()">
            <i class="fas fa-plus me-2"></i>Add New Tag
        </button>
    </div>
    <div class="card-body">
        <!-- Tags Table -->
        <div class="table-responsive">
            <table class="table table-hover" id="tags-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Posts</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="tags-tbody">
                    <tr>
                        <td colspan="6" class="text-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add/Edit Tag Modal -->
<div class="modal fade" id="tagModal" tabindex="-1" aria-labelledby="tagModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tagModalLabel">Add New Tag</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="tagForm">
                <div class="modal-body">
                    <input type="hidden" id="tag_id" name="tag_id">
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" placeholder="Auto-generated from name">
                        <small class="text-muted">Leave empty to auto-generate from name</small>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <span class="spinner-border spinner-border-sm d-none" id="submitSpinner" role="status"></span>
                        Save Tag
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

const isAdmin = {{ Auth::user()->isAdmin() ? 'true' : 'false' }};
let tagModal;
let isEditMode = false;

document.addEventListener('DOMContentLoaded', function() {
    tagModal = new bootstrap.Modal(document.getElementById('tagModal'));
    loadTags();
    
    document.getElementById('tagForm').addEventListener('submit', handleFormSubmit);
    
    document.getElementById('tagModal').addEventListener('hidden.bs.modal', function() {
        resetForm();
    });

    // Auto-generate slug from name
    document.getElementById('name').addEventListener('input', function() {
        if (!document.getElementById('slug').value) {
            const slug = this.value.toLowerCase()
                .replace(/[^\w\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim();
            document.getElementById('slug').value = slug;
        }
    });
});

function loadTags() {
    axios.get('{{ route('admin.api.tags.index') }}')
        .then(function(response) {
            const tags = response.data.data;
            const tbody = document.getElementById('tags-tbody');
            
            if (tags.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" class="text-center">No tags found</td></tr>';
                return;
            }
            
            tbody.innerHTML = tags.map(tag => `
                <tr>
                    <td>${tag.id}</td>
                    <td><strong>${tag.name}</strong></td>
                    <td><code>${tag.slug}</code></td>
                    <td><span class="badge bg-info">${tag.posts_count || 0}</span></td>
                    <td>${new Date(tag.created_at).toLocaleDateString()}</td>
                    <td>
                        <button class="btn btn-sm btn-primary" onclick="editTag(${tag.id})" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        ${isAdmin ? `<button class="btn btn-sm btn-danger" onclick="deleteTag(${tag.id})" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>` : ''}
                    </td>
                </tr>
            `).join('');
        })
        .catch(function(error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error loading tags. Please try again.',
                confirmButtonColor: '#0d6efd'
            });
        });
}

function openAddModal() {
    isEditMode = false;
    document.getElementById('tagModalLabel').textContent = 'Add New Tag';
    document.getElementById('submitBtn').innerHTML = '<span class="spinner-border spinner-border-sm d-none" id="submitSpinner" role="status"></span> Save Tag';
    resetForm();
    tagModal.show();
}

function editTag(id) {
    isEditMode = true;
    document.getElementById('tagModalLabel').textContent = 'Edit Tag';
    document.getElementById('submitBtn').innerHTML = '<span class="spinner-border spinner-border-sm d-none" id="submitSpinner" role="status"></span> Update Tag';
    
    axios.get(`{{ route('admin.api.tags.show', ':id') }}`.replace(':id', id))
        .then(function(response) {
            const tag = response.data.data;
            document.getElementById('tag_id').value = tag.id;
            document.getElementById('name').value = tag.name;
            document.getElementById('slug').value = tag.slug;
            tagModal.show();
        })
        .catch(function(error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error loading tag data. Please try again.',
                confirmButtonColor: '#0d6efd'
            });
        });
}

function handleFormSubmit(e) {
    e.preventDefault();
    
    const submitBtn = document.getElementById('submitBtn');
    const spinner = document.getElementById('submitSpinner');
    
    submitBtn.disabled = true;
    spinner.classList.remove('d-none');
    
    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData);
    
    const url = isEditMode 
        ? `{{ route('admin.api.tags.update', ':id') }}`.replace(':id', data.tag_id)
        : '{{ route('admin.api.tags.store') }}';
    
    const method = isEditMode ? 'put' : 'post';
    
    axios[method](url, data)
        .then(function(response) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: response.data.message,
                confirmButtonColor: '#0d6efd',
                timer: 2000,
                timerProgressBar: true
            }).then(() => {
                tagModal.hide();
                loadTags();
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
}

function deleteTag(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e74c3c',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete(`{{ route('admin.api.tags.destroy', ':id') }}`.replace(':id', id))
                .then(function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: response.data.message,
                        confirmButtonColor: '#0d6efd',
                        timer: 2000,
                        timerProgressBar: true
                    }).then(() => {
                        loadTags();
                    });
                })
                .catch(function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.response?.data?.message || 'Error deleting tag. Please try again.',
                        confirmButtonColor: '#0d6efd'
                    });
                });
        }
    });
}

function resetForm() {
    document.getElementById('tagForm').reset();
    document.getElementById('tag_id').value = '';
    document.querySelectorAll('.is-invalid').forEach(el => {
        el.classList.remove('is-invalid');
    });
    document.querySelectorAll('.invalid-feedback').forEach(el => {
        el.textContent = '';
    });
}
</script>
@endpush

