@extends('admin.layouts.dashboard')

@section('title', 'User Management')
@section('page-title', 'User Management')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-users me-2"></i>Users</h5>
        <button type="button" class="btn btn-light btn-sm" onclick="openAddModal()">
            <i class="fas fa-plus me-2"></i>Add New User
        </button>
    </div>
    <div class="card-body">
        <!-- Users Table -->
        <div class="table-responsive">
            <table class="table table-hover" id="users-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="users-tbody">
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

<!-- Add/Edit User Modal -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="userForm">
                <div class="modal-body">
                    <input type="hidden" id="user_id" name="user_id">
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">
                            Password <span class="text-danger">*</span>
                            <small id="password-help" class="text-muted">(Leave blank to keep current password)</small>
                        </label>
                        <input type="password" class="form-control" id="password" name="password">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="">Select Role</option>
                            <option value="admin">Admin</option>
                            <option value="sub_admin">Sub Admin</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <span class="spinner-border spinner-border-sm d-none" id="submitSpinner" role="status"></span>
                        Save User
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
// Set up Axios defaults
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

let userModal;
let isEditMode = false;

// Initialize modal
document.addEventListener('DOMContentLoaded', function() {
    userModal = new bootstrap.Modal(document.getElementById('userModal'));
    loadUsers();
    
    // Handle form submission
    document.getElementById('userForm').addEventListener('submit', handleFormSubmit);
    
    // Reset form when modal is closed
    document.getElementById('userModal').addEventListener('hidden.bs.modal', function() {
        resetForm();
    });
});

// Load all users
function loadUsers() {
    axios.get('{{ route("admin.api.users.index") }}')
        .then(function(response) {
            const users = response.data.data;
            const tbody = document.getElementById('users-tbody');
            
            if (users.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" class="text-center">No users found</td></tr>';
                return;
            }
            
            tbody.innerHTML = users.map(user => `
                <tr>
                    <td>${user.id}</td>
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td>
                        <span class="badge ${user.role === 'admin' ? 'bg-primary' : 'bg-secondary'}">
                            ${user.role.replace('_', ' ').toUpperCase()}
                        </span>
                    </td>
                    <td>${new Date(user.created_at).toLocaleDateString()}</td>
                    <td>
                        <button class="btn btn-sm btn-primary" onclick="editUser(${user.id})" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="deleteUser(${user.id})" title="Delete" ${user.id === {{ auth()->id() }} ? 'disabled' : ''} ${user.id === {{ auth()->id() }} ? 'style="opacity: 0.5; cursor: not-allowed;"' : ''}>
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
                text: 'Error loading users. Please try again.',
                confirmButtonColor: '#0d6efd'
            });
            console.error('Error:', error);
        });
}

// Open add modal
function openAddModal() {
    isEditMode = false;
    document.getElementById('userModalLabel').textContent = 'Add New User';
    const submitBtn = document.getElementById('submitBtn');
    if (submitBtn) {
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm d-none" id="submitSpinner" role="status"></span> Save User';
    }
    document.getElementById('password').required = true;
    document.getElementById('password-help').classList.add('d-none');
    resetForm();
    userModal.show();
}

// Edit user
function editUser(id) {
    isEditMode = true;
    document.getElementById('userModalLabel').textContent = 'Edit User';
    const submitBtn = document.getElementById('submitBtn');
    if (submitBtn) {
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm d-none" id="submitSpinner" role="status"></span> Update User';
    }
    document.getElementById('password').required = false;
    document.getElementById('password-help').classList.remove('d-none');
    
    axios.get('{{ route("admin.api.users.show", ":id") }}'.replace(':id', id))
        .then(function(response) {
            const user = response.data.data;
            document.getElementById('user_id').value = user.id;
            document.getElementById('name').value = user.name;
            document.getElementById('email').value = user.email;
            document.getElementById('role').value = user.role;
            userModal.show();
        })
        .catch(function(error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error loading user data. Please try again.',
                confirmButtonColor: '#0d6efd'
            });
            console.error('Error:', error);
        });
}

// Handle form submission
function handleFormSubmit(e) {
    e.preventDefault();
    
    const submitBtn = document.getElementById('submitBtn');
    const spinner = document.getElementById('submitSpinner');
    
    if (!submitBtn) {
        console.error('Submit button not found');
        return;
    }
    
    submitBtn.disabled = true;
    if (spinner) {
        spinner.classList.remove('d-none');
    }
    
    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData);
    
    // Remove password if empty in edit mode
    if (isEditMode && !data.password) {
        delete data.password;
    }
    
    const url = isEditMode 
        ? '{{ route("admin.api.users.update", ":id") }}'.replace(':id', data.user_id)
        : '{{ route("admin.api.users.store") }}';
    
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
                userModal.hide();
                loadUsers();
            });
        })
        .catch(function(error) {
            if (error.response && error.response.status === 422) {
                // Validation errors
                const errors = error.response.data.errors;
                let errorMessages = [];
                
                Object.keys(errors).forEach(key => {
                    const input = document.getElementById(key);
                    if (input) {
                        input.classList.add('is-invalid');
                        const feedback = input.nextElementSibling;
                        if (feedback) {
                            feedback.textContent = errors[key][0];
                        }
                    }
                    errorMessages.push(errors[key][0]);
                });
                
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    html: errorMessages.join('<br>'),
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
            if (submitBtn) {
                submitBtn.disabled = false;
            }
            if (spinner) {
                spinner.classList.add('d-none');
            }
        });
}

// Delete user
function deleteUser(id) {
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
            axios.delete('{{ route("admin.api.users.destroy", ":id") }}'.replace(':id', id))
                .then(function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: response.data.message,
                        confirmButtonColor: '#0d6efd',
                        timer: 2000,
                        timerProgressBar: true
                    }).then(() => {
                        loadUsers();
                    });
                })
                .catch(function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.response?.data?.message || 'Error deleting user. Please try again.',
                        confirmButtonColor: '#0d6efd'
                    });
                    console.error('Error:', error);
                });
        }
    });
}

// Reset form
function resetForm() {
    document.getElementById('userForm').reset();
    document.getElementById('user_id').value = '';
    document.querySelectorAll('.is-invalid').forEach(el => {
        el.classList.remove('is-invalid');
    });
    document.querySelectorAll('.invalid-feedback').forEach(el => {
        el.textContent = '';
    });
}

// Show alert message (kept for backward compatibility, but using SweetAlert2)
function showAlert(message, type) {
    const icon = type === 'success' ? 'success' : type === 'danger' ? 'error' : 'info';
    Swal.fire({
        icon: icon,
        title: type === 'success' ? 'Success!' : type === 'danger' ? 'Error!' : 'Info',
        text: message,
        confirmButtonColor: '#0d6efd',
        timer: 3000,
        timerProgressBar: true
    });
}
</script>
@endpush

