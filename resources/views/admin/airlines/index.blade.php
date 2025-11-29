@extends('admin.layouts.dashboard')

@section('title', 'Airline Management')
@section('page-title', 'Airline Management')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-plane me-2"></i>Airlines</h5>
        <button type="button" class="btn btn-light btn-sm" onclick="openAddModal()">
            <i class="fas fa-plus me-2"></i>Add New Airline
        </button>
    </div>
    <div class="card-body">
        <!-- Filters -->
        <div class="card mb-3">
            <div class="card-header bg-light">
                <h6 class="mb-0"><i class="fas fa-filter me-2"></i>Filters</h6>
            </div>
            <div class="card-body">
                <form id="filterForm" onsubmit="applyFilters(); return false;">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="filter_name" class="form-label small">Name</label>
                            <input type="text" class="form-control form-control-sm" id="filter_name" name="filter_name" placeholder="Search by name">
                        </div>
                        <div class="col-md-3">
                            <label for="filter_code" class="form-label small">Code</label>
                            <input type="text" class="form-control form-control-sm" id="filter_code" name="filter_code" placeholder="e.g., AI, BA" maxlength="10">
                        </div>
                        <div class="col-md-3">
                            <label for="filter_country" class="form-label small">Country</label>
                            <input type="text" class="form-control form-control-sm" id="filter_country" name="filter_country" placeholder="Search country">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small">&nbsp;</label>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fas fa-search me-1"></i>Filter
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <button type="button" class="btn btn-secondary btn-sm" onclick="clearFilters()">
                                <i class="fas fa-times me-1"></i>Clear
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Airlines Table -->
        <div class="table-responsive">
            <table class="table table-hover" id="airlines-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Country</th>
                        <th>Logo</th>
                        <th>Login ID</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="airlines-tbody">
                    <tr>
                        <td colspan="9" class="text-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-3" id="pagination-container">
            <div class="pagination-info">
                <span id="pagination-info-text">Loading...</span>
            </div>
            <nav>
                <ul class="pagination mb-0" id="pagination-links">
                    <!-- Pagination links will be inserted here -->
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Add/Edit Airline Modal -->
<div class="modal fade" id="airlineModal" tabindex="-1" aria-labelledby="airlineModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="airlineModalLabel">Add New Airline</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="airlineForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="airline_id" name="airline_id">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Airline Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" required>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="code" class="form-label">Airline Code <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="code" name="code" maxlength="10" required>
                                <small class="text-muted">e.g., AI, BA, LH</small>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" class="form-control" id="slug" name="slug">
                                <small class="text-muted">Leave empty to auto-generate from name</small>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="country" class="form-label">Country <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="country" name="country" required>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="logo" class="form-label">Logo File</label>
                                <input type="file" class="form-control" id="logo" name="logo" accept="image/*" onchange="previewLogo(this)">
                                <small class="text-muted">Upload image file (max 2MB). Supported formats: JPEG, PNG, JPG, GIF, SVG, WEBP</small>
                                <div class="invalid-feedback"></div>
                                <div id="logoPreview" class="mt-2" style="display: none;">
                                    <img id="logoPreviewImg" src="" alt="Logo Preview" style="max-height: 100px; width: auto; border: 1px solid #ddd; padding: 5px; border-radius: 4px;">
                                    <button type="button" class="btn btn-sm btn-danger ms-2" onclick="removeLogoPreview()">
                                        <i class="fas fa-times"></i> Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="logo_url" class="form-label">Or Logo URL</label>
                                <input type="text" class="form-control" id="logo_url" name="logo_url" placeholder="https://example.com/logo.png">
                                <small class="text-muted">Alternatively, provide a logo URL</small>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="login_id" class="form-label">Login ID</label>
                                <input type="text" class="form-control" id="login_id" name="login_id" placeholder="Optional login identifier">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <span class="spinner-border spinner-border-sm d-none" id="submitSpinner" role="status"></span>
                        Save Airline
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

const isAdmin = {{ Auth::user()->isAdmin() ? 'true' : 'false' }};
let airlineModal;
let isEditMode = false;
let currentPage = 1;
let currentFilters = {};

// Initialize modal
document.addEventListener('DOMContentLoaded', function() {
    airlineModal = new bootstrap.Modal(document.getElementById('airlineModal'));
    loadAirlines(1, {});
    
    // Handle form submission
    document.getElementById('airlineForm').addEventListener('submit', handleFormSubmit);
    
    // Reset form when modal is closed
    document.getElementById('airlineModal').addEventListener('hidden.bs.modal', function() {
        resetForm();
    });
    
    // Auto-generate slug from name
    document.getElementById('name').addEventListener('input', function() {
        if (!isEditMode && !document.getElementById('slug').value) {
            const slug = this.value.toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, '')
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');
            document.getElementById('slug').value = slug;
        }
    });
});

// Load airlines with pagination and filters
function loadAirlines(page = 1, filters = null) {
    currentPage = page;
    const tbody = document.getElementById('airlines-tbody');
    tbody.innerHTML = '<tr><td colspan="9" class="text-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></td></tr>';
    
    // Use provided filters or current filters
    const filtersToUse = filters !== null ? filters : currentFilters;
    
    // Build params object
    const params = { page: page, per_page: 15 };
    
    // Add filter parameters
    if (filtersToUse.filter_name) params.filter_name = filtersToUse.filter_name;
    if (filtersToUse.filter_code) params.filter_code = filtersToUse.filter_code;
    if (filtersToUse.filter_country) params.filter_country = filtersToUse.filter_country;
    
    axios.get('{{ route("admin.api.airlines.index") }}', { params: params })
        .then(function(response) {
            const airlines = response.data.data;
            const pagination = response.data.pagination;
            
            if (airlines.length === 0) {
                tbody.innerHTML = '<tr><td colspan="9" class="text-center">No airlines found</td></tr>';
                renderPagination(null);
                return;
            }
            
            tbody.innerHTML = airlines.map(airline => `
                <tr>
                    <td>${airline.id}</td>
                    <td><span class="badge bg-info">${airline.code || '-'}</span></td>
                    <td>${airline.name || '-'}</td>
                    <td><code>${airline.slug || '-'}</code></td>
                    <td>${airline.country || '-'}</td>
                    <td>${airline.logo ? `<img src="${airline.logo}" alt="${airline.name}" style="max-height: 30px; width: auto;">` : '-'}</td>
                    <td>${airline.login_id || '-'}</td>
                    <td>${airline.created_at ? new Date(airline.created_at).toLocaleDateString() : '-'}</td>
                    <td>
                        <button class="btn btn-sm btn-primary" onclick="editAirline(${airline.id})" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        ${isAdmin ? `<button class="btn btn-sm btn-danger" onclick="deleteAirline(${airline.id})" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>` : ''}
                    </td>
                </tr>
            `).join('');
            
            renderPagination(pagination);
        })
        .catch(function(error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error loading airlines. Please try again.',
                confirmButtonColor: '#0d6efd'
            });
            console.error('Error:', error);
            tbody.innerHTML = '<tr><td colspan="9" class="text-center text-danger">Error loading airlines</td></tr>';
        });
}

// Render pagination controls
function renderPagination(pagination) {
    const paginationContainer = document.getElementById('pagination-links');
    const paginationInfo = document.getElementById('pagination-info-text');
    
    if (!pagination) {
        paginationContainer.innerHTML = '';
        paginationInfo.textContent = '';
        return;
    }
    
    // Update pagination info
    paginationInfo.textContent = `Showing ${pagination.from || 0} to ${pagination.to || 0} of ${pagination.total} airlines`;
    
    // Build pagination links
    let paginationHTML = '';
    
    // Previous button
    if (pagination.current_page > 1) {
        paginationHTML += `
            <li class="page-item">
                <a class="page-link" href="#" onclick="loadAirlines(${pagination.current_page - 1}); return false;">
                    <i class="fas fa-chevron-left"></i>
                </a>
            </li>
        `;
    } else {
        paginationHTML += `
            <li class="page-item disabled">
                <span class="page-link"><i class="fas fa-chevron-left"></i></span>
            </li>
        `;
    }
    
    // Page numbers
    const totalPages = pagination.last_page;
    const currentPage = pagination.current_page;
    
    // Show first page
    if (currentPage > 3) {
        paginationHTML += `
            <li class="page-item">
                <a class="page-link" href="#" onclick="loadAirlines(1); return false;">1</a>
            </li>
        `;
        if (currentPage > 4) {
            paginationHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
        }
    }
    
    // Show pages around current page
    const startPage = Math.max(1, currentPage - 2);
    const endPage = Math.min(totalPages, currentPage + 2);
    
    for (let i = startPage; i <= endPage; i++) {
        if (i === currentPage) {
            paginationHTML += `
                <li class="page-item active">
                    <span class="page-link">${i}</span>
                </li>
            `;
        } else {
            paginationHTML += `
                <li class="page-item">
                    <a class="page-link" href="#" onclick="loadAirlines(${i}); return false;">${i}</a>
                </li>
            `;
        }
    }
    
    // Show last page
    if (currentPage < totalPages - 2) {
        if (currentPage < totalPages - 3) {
            paginationHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
        }
        paginationHTML += `
            <li class="page-item">
                <a class="page-link" href="#" onclick="loadAirlines(${totalPages}); return false;">${totalPages}</a>
            </li>
        `;
    }
    
    // Next button
    if (pagination.current_page < pagination.last_page) {
        paginationHTML += `
            <li class="page-item">
                <a class="page-link" href="#" onclick="loadAirlines(${pagination.current_page + 1}); return false;">
                    <i class="fas fa-chevron-right"></i>
                </a>
            </li>
        `;
    } else {
        paginationHTML += `
            <li class="page-item disabled">
                <span class="page-link"><i class="fas fa-chevron-right"></i></span>
            </li>
        `;
    }
    
    paginationContainer.innerHTML = paginationHTML;
}

// Open add modal
function openAddModal() {
    isEditMode = false;
    document.getElementById('airlineModalLabel').textContent = 'Add New Airline';
    const submitBtn = document.getElementById('submitBtn');
    if (submitBtn) {
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm d-none" id="submitSpinner" role="status"></span> Save Airline';
    }
    resetForm();
    airlineModal.show();
}

// Edit airline
function editAirline(id) {
    isEditMode = true;
    document.getElementById('airlineModalLabel').textContent = 'Edit Airline';
    const submitBtn = document.getElementById('submitBtn');
    if (submitBtn) {
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm d-none" id="submitSpinner" role="status"></span> Update Airline';
    }
    
    axios.get('{{ route("admin.api.airlines.show", ":id") }}'.replace(':id', id))
        .then(function(response) {
            const airline = response.data.data;
            document.getElementById('airline_id').value = airline.id;
            document.getElementById('name').value = airline.name || '';
            document.getElementById('code').value = airline.code || '';
            document.getElementById('slug').value = airline.slug || '';
            document.getElementById('country').value = airline.country || '';
            document.getElementById('logo_url').value = airline.logo || '';
            document.getElementById('login_id').value = airline.login_id || '';
            
            // Show existing logo preview if available
            const previewDiv = document.getElementById('logoPreview');
            const previewImg = document.getElementById('logoPreviewImg');
            if (airline.logo) {
                previewImg.src = airline.logo;
                previewDiv.style.display = 'block';
            } else {
                previewDiv.style.display = 'none';
            }
            
            // Clear file input
            document.getElementById('logo').value = '';
            
            airlineModal.show();
        })
        .catch(function(error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error loading airline data. Please try again.',
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
    
    // Remove empty slug if it's empty (let backend generate it)
    if (!formData.get('slug') || formData.get('slug').trim() === '') {
        formData.delete('slug');
    }
    
    // Remove logo_url if a file is uploaded
    if (formData.get('logo') && formData.get('logo').size > 0) {
        formData.delete('logo_url');
    }
    
    const url = isEditMode 
        ? '{{ route("admin.api.airlines.update", ":id") }}'.replace(':id', formData.get('airline_id'))
        : '{{ route("admin.api.airlines.store") }}';
    
    const method = isEditMode ? 'post' : 'post'; // Use POST for file uploads, Laravel will handle PUT via _method
    
    // For PUT requests with file uploads, we need to use POST with _method
    if (isEditMode) {
        formData.append('_method', 'PUT');
    }
    
    axios.post(url, formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
        .then(function(response) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: response.data.message,
                confirmButtonColor: '#0d6efd',
                timer: 2000,
                timerProgressBar: true
            }).then(() => {
                airlineModal.hide();
                loadAirlines(currentPage);
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
                        if (feedback && feedback.classList.contains('invalid-feedback')) {
                            feedback.textContent = errors[key][0];
                        } else {
                            // Find the next invalid-feedback element
                            const nextFeedback = input.parentElement.querySelector('.invalid-feedback');
                            if (nextFeedback) {
                                nextFeedback.textContent = errors[key][0];
                            }
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

// Delete airline
function deleteAirline(id) {
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
            axios.delete('{{ route("admin.api.airlines.destroy", ":id") }}'.replace(':id', id))
                .then(function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: response.data.message,
                        confirmButtonColor: '#0d6efd',
                        timer: 2000,
                        timerProgressBar: true
                    }).then(() => {
                        loadAirlines(currentPage);
                    });
                })
                .catch(function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.response?.data?.message || 'Error deleting airline. Please try again.',
                        confirmButtonColor: '#0d6efd'
                    });
                    console.error('Error:', error);
                });
        }
    });
}

// Preview logo
function previewLogo(input) {
    const previewDiv = document.getElementById('logoPreview');
    const previewImg = document.getElementById('logoPreviewImg');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            previewDiv.style.display = 'block';
        };
        
        reader.readAsDataURL(input.files[0]);
        
        // Clear logo_url when file is selected
        document.getElementById('logo_url').value = '';
    } else {
        previewDiv.style.display = 'none';
    }
}

// Remove logo preview
function removeLogoPreview() {
    const previewDiv = document.getElementById('logoPreview');
    const previewImg = document.getElementById('logoPreviewImg');
    const logoInput = document.getElementById('logo');
    previewDiv.style.display = 'none';
    logoInput.value = '';
    previewImg.src = '';
}

// Reset form
function resetForm() {
    document.getElementById('airlineForm').reset();
    document.getElementById('airline_id').value = '';
    document.getElementById('logoPreview').style.display = 'none';
    document.getElementById('logoPreviewImg').src = '';
    document.querySelectorAll('.is-invalid').forEach(el => {
        el.classList.remove('is-invalid');
    });
    document.querySelectorAll('.invalid-feedback').forEach(el => {
        el.textContent = '';
    });
}

// Apply filters
function applyFilters() {
    currentFilters = {
        filter_name: document.getElementById('filter_name').value.trim(),
        filter_code: document.getElementById('filter_code').value.trim(),
        filter_country: document.getElementById('filter_country').value.trim()
    };
    
    // Reset to page 1 when applying filters
    loadAirlines(1, currentFilters);
}

// Clear filters
function clearFilters() {
    document.getElementById('filter_name').value = '';
    document.getElementById('filter_code').value = '';
    document.getElementById('filter_country').value = '';
    
    currentFilters = {};
    loadAirlines(1, {});
}
</script>
@endpush

