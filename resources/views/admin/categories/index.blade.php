@extends('admin.layouts.dashboard')

@section('title', 'Category Management')
@section('page-title', 'Category Management')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-folder me-2"></i>Categories</h5>
        <button type="button" class="btn btn-light btn-sm" onclick="openAddModal()">
            <i class="fas fa-plus me-2"></i>Add New Category
        </button>
    </div>
    <div class="card-body">
        <!-- Categories Table -->
        <div class="table-responsive">
            <table class="table table-hover" id="categories-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Posts</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="categories-tbody">
                    <tr>
                        <td colspan="7" class="text-center">
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

<!-- Add/Edit Category Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalLabel">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="categoryForm">
                <div class="modal-body">
                    <input type="hidden" id="category_id" name="category_id">
                    
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

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
                            <label class="form-check-label" for="is_active">Active</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <span class="spinner-border spinner-border-sm d-none" id="submitSpinner" role="status"></span>
                        Save Category
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

let categoryModal;
let isEditMode = false;

document.addEventListener('DOMContentLoaded', function() {
    categoryModal = new bootstrap.Modal(document.getElementById('categoryModal'));
    loadCategories();
    
    document.getElementById('categoryForm').addEventListener('submit', handleFormSubmit);
    
    document.getElementById('categoryModal').addEventListener('hidden.bs.modal', function() {
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

function loadCategories() {
    axios.get('{{ route('admin.api.categories.index') }}')
        .then(function(response) {
            const categories = response.data.data;
            const tbody = document.getElementById('categories-tbody');
            
            if (categories.length === 0) {
                tbody.innerHTML = '<tr><td colspan="7" class="text-center">No categories found</td></tr>';
                return;
            }
            
            tbody.innerHTML = categories.map(category => `
                <tr>
                    <td>${category.id}</td>
                    <td><strong>${category.name}</strong></td>
                    <td><code>${category.slug}</code></td>
                    <td>${category.description || '-'}</td>
                    <td><span class="badge bg-info">${category.posts_count || 0}</span></td>
                    <td>
                        <span class="badge ${category.is_active ? 'bg-success' : 'bg-secondary'}">
                            ${category.is_active ? 'Active' : 'Inactive'}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-primary" onclick="editCategory(${category.id})" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="deleteCategory(${category.id})" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `).join('');
        })
        .catch(function(error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error loading categories. Please try again.',
                confirmButtonColor: '#0d6efd'
            });
        });
}

function openAddModal() {
    isEditMode = false;
    document.getElementById('categoryModalLabel').textContent = 'Add New Category';
    document.getElementById('submitBtn').innerHTML = '<span class="spinner-border spinner-border-sm d-none" id="submitSpinner" role="status"></span> Save Category';
    resetForm();
    categoryModal.show();
}

function editCategory(id) {
    isEditMode = true;
    document.getElementById('categoryModalLabel').textContent = 'Edit Category';
    document.getElementById('submitBtn').innerHTML = '<span class="spinner-border spinner-border-sm d-none" id="submitSpinner" role="status"></span> Update Category';
    
    axios.get(`{{ route('admin.api.categories.show', ':id') }}`.replace(':id', id))
        .then(function(response) {
            const category = response.data.data;
            document.getElementById('category_id').value = category.id;
            document.getElementById('name').value = category.name;
            document.getElementById('slug').value = category.slug;
            document.getElementById('description').value = category.description || '';
            document.getElementById('is_active').checked = category.is_active;
            categoryModal.show();
        })
        .catch(function(error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error loading category data. Please try again.',
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
    data.is_active = document.getElementById('is_active').checked ? 1 : 0;
    
    const url = isEditMode 
        ? `{{ route('admin.api.categories.update', ':id') }}`.replace(':id', data.category_id)
        : '{{ route('admin.api.categories.store') }}';
    
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
                categoryModal.hide();
                loadCategories();
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

function deleteCategory(id) {
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
            axios.delete(`{{ route('admin.api.categories.destroy', ':id') }}`.replace(':id', id))
                .then(function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: response.data.message,
                        confirmButtonColor: '#0d6efd',
                        timer: 2000,
                        timerProgressBar: true
                    }).then(() => {
                        loadCategories();
                    });
                })
                .catch(function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.response?.data?.message || 'Error deleting category. Please try again.',
                        confirmButtonColor: '#0d6efd'
                    });
                });
        }
    });
}

function resetForm() {
    document.getElementById('categoryForm').reset();
    document.getElementById('category_id').value = '';
    document.getElementById('is_active').checked = true;
    document.querySelectorAll('.is-invalid').forEach(el => {
        el.classList.remove('is-invalid');
    });
    document.querySelectorAll('.invalid-feedback').forEach(el => {
        el.textContent = '';
    });
}
</script>
@endpush

