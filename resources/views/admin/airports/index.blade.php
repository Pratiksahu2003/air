@extends('admin.layouts.dashboard')

@section('title', 'Airport Management')
@section('page-title', 'Airport Management')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-plane-departure me-2"></i>Airports</h5>
        <button type="button" class="btn btn-light btn-sm" onclick="openAddModal()">
            <i class="fas fa-plus me-2"></i>Add New Airport
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
                        <div class="col-md-3">
                            <label for="filter_name" class="form-label small">Name</label>
                            <input type="text" class="form-control form-control-sm" id="filter_name" name="filter_name" placeholder="Search by name">
                        </div>
                        <div class="col-md-2">
                            <label for="filter_code" class="form-label small">Code</label>
                            <input type="text" class="form-control form-control-sm" id="filter_code" name="filter_code" placeholder="e.g., JFK" maxlength="10">
                        </div>
                        <div class="col-md-2">
                            <label for="filter_country" class="form-label small">Country</label>
                            <input type="text" class="form-control form-control-sm" id="filter_country" name="filter_country" placeholder="Search country">
                        </div>
                        <div class="col-md-2">
                            <label for="filter_city" class="form-label small">City</label>
                            <input type="text" class="form-control form-control-sm" id="filter_city" name="filter_city" placeholder="Search city">
                        </div>
                        <div class="col-md-2">
                            <label for="filter_continent" class="form-label small">Continent</label>
                            <input type="text" class="form-control form-control-sm" id="filter_continent" name="filter_continent" placeholder="e.g., Asia">
                        </div>
                        <div class="col-md-1">
                            <label for="filter_type" class="form-label small">Type</label>
                            <select class="form-select form-select-sm" id="filter_type" name="filter_type">
                                <option value="">All</option>
                                <option value="0">Domestic</option>
                                <option value="1">International</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-search me-1"></i>Apply Filters
                            </button>
                            <button type="button" class="btn btn-secondary btn-sm" onclick="clearFilters()">
                                <i class="fas fa-times me-1"></i>Clear
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Airports Table -->
        <div class="table-responsive">
            <table class="table table-hover" id="airports-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>City</th>
                        <th>Country</th>
                        <th>Continent</th>
                        <th>Type</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="airports-tbody">
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

<!-- Add/Edit Airport Modal -->
<div class="modal fade" id="airportModal" tabindex="-1" aria-labelledby="airportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="airportModalLabel">Add New Airport</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="airportForm">
                <div class="modal-body">
                    <input type="hidden" id="airport_id" name="airport_id">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Airport Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" required>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="code" class="form-label">Airport Code <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="code" name="code" maxlength="10" required>
                                <small class="text-muted">e.g., JFK, LAX, LHR</small>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="city" name="city" required>
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
                                <label for="continents" class="form-label">Continent</label>
                                <input type="text" class="form-control" id="continents" name="continents">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <select class="form-select" id="type" name="type">
                                    <option value="">Select Type</option>
                                    <option value="0">Domestic</option>
                                    <option value="1">International</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image URL</label>
                        <input type="text" class="form-control" id="image" name="image" placeholder="https://example.com/image.jpg">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="mb-3">
                        <label for="Address" class="form-label">Address</label>
                        <textarea class="form-control" id="Address" name="Address" rows="2"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="mb-3">
                        <label for="Contact" class="form-label">Contact</label>
                        <input type="text" class="form-control" id="Contact" name="Contact" placeholder="Phone, Email, etc.">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="mb-3">
                        <label for="airport_txt" class="form-label">Description</label>
                        <textarea class="form-control" id="airport_txt" name="airport_txt" rows="3"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <span class="spinner-border spinner-border-sm d-none" id="submitSpinner" role="status"></span>
                        Save Airport
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

let airportModal;
let isEditMode = false;
let currentPage = 1;
let currentFilters = {};

// Initialize modal
document.addEventListener('DOMContentLoaded', function() {
    airportModal = new bootstrap.Modal(document.getElementById('airportModal'));
    loadAirports(1, {});
    
    // Handle form submission
    document.getElementById('airportForm').addEventListener('submit', handleFormSubmit);
    
    // Reset form when modal is closed
    document.getElementById('airportModal').addEventListener('hidden.bs.modal', function() {
        resetForm();
    });
});

// Load airports with pagination and filters
function loadAirports(page = 1, filters = null) {
    currentPage = page;
    const tbody = document.getElementById('airports-tbody');
    tbody.innerHTML = '<tr><td colspan="9" class="text-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></td></tr>';
    
    // Use provided filters or current filters
    const filtersToUse = filters !== null ? filters : currentFilters;
    
    // Build params object
    const params = { page: page, per_page: 15 };
    
    // Add filter parameters
    if (filtersToUse.filter_name) params.filter_name = filtersToUse.filter_name;
    if (filtersToUse.filter_code) params.filter_code = filtersToUse.filter_code;
    if (filtersToUse.filter_country) params.filter_country = filtersToUse.filter_country;
    if (filtersToUse.filter_city) params.filter_city = filtersToUse.filter_city;
    if (filtersToUse.filter_continent) params.filter_continent = filtersToUse.filter_continent;
    if (filtersToUse.filter_type !== undefined && filtersToUse.filter_type !== '') params.filter_type = filtersToUse.filter_type;
    
    axios.get('{{ route("admin.api.airports.index") }}', { params: params })
        .then(function(response) {
            const airports = response.data.data;
            const pagination = response.data.pagination;
            
            if (airports.length === 0) {
                tbody.innerHTML = '<tr><td colspan="9" class="text-center">No airports found</td></tr>';
                renderPagination(null);
                return;
            }
            
            tbody.innerHTML = airports.map(airport => `
                <tr>
                    <td>${airport.id}</td>
                    <td>${airport.name || '-'}</td>
                    <td><span class="badge bg-info">${airport.code || '-'}</span></td>
                    <td>${airport.city || '-'}</td>
                    <td>${airport.country || '-'}</td>
                    <td>${airport.continents || '-'}</td>
                    <td>${airport.type === 0 ? 'Domestic' : airport.type === 1 ? 'International' : airport.type !== null && airport.type !== undefined ? airport.type : '-'}</td>
                    <td>${airport.created_at ? new Date(airport.created_at).toLocaleDateString() : '-'}</td>
                    <td>
                        <button class="btn btn-sm btn-primary" onclick="editAirport(${airport.id})" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="deleteAirport(${airport.id})" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `).join('');
            
            renderPagination(pagination);
        })
        .catch(function(error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error loading airports. Please try again.',
                confirmButtonColor: '#0d6efd'
            });
            console.error('Error:', error);
            tbody.innerHTML = '<tr><td colspan="9" class="text-center text-danger">Error loading airports</td></tr>';
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
    paginationInfo.textContent = `Showing ${pagination.from || 0} to ${pagination.to || 0} of ${pagination.total} airports`;
    
    // Build pagination links
    let paginationHTML = '';
    
    // Previous button
    if (pagination.current_page > 1) {
        paginationHTML += `
            <li class="page-item">
                <a class="page-link" href="#" onclick="loadAirports(${pagination.current_page - 1}); return false;">
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
                <a class="page-link" href="#" onclick="loadAirports(1); return false;">1</a>
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
                    <a class="page-link" href="#" onclick="loadAirports(${i}); return false;">${i}</a>
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
                <a class="page-link" href="#" onclick="loadAirports(${totalPages}); return false;">${totalPages}</a>
            </li>
        `;
    }
    
    // Next button
    if (pagination.current_page < pagination.last_page) {
        paginationHTML += `
            <li class="page-item">
                <a class="page-link" href="#" onclick="loadAirports(${pagination.current_page + 1}); return false;">
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
    document.getElementById('airportModalLabel').textContent = 'Add New Airport';
    const submitBtn = document.getElementById('submitBtn');
    if (submitBtn) {
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm d-none" id="submitSpinner" role="status"></span> Save Airport';
    }
    resetForm();
    airportModal.show();
}

// Edit airport
function editAirport(id) {
    isEditMode = true;
    document.getElementById('airportModalLabel').textContent = 'Edit Airport';
    const submitBtn = document.getElementById('submitBtn');
    if (submitBtn) {
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm d-none" id="submitSpinner" role="status"></span> Update Airport';
    }
    
    axios.get('{{ route("admin.api.airports.show", ":id") }}'.replace(':id', id))
        .then(function(response) {
            const airport = response.data.data;
            document.getElementById('airport_id').value = airport.id;
            document.getElementById('name').value = airport.name || '';
            document.getElementById('code').value = airport.code || '';
            document.getElementById('city').value = airport.city || '';
            document.getElementById('country').value = airport.country || '';
            document.getElementById('continents').value = airport.continents || '';
            document.getElementById('type').value = airport.type !== null && airport.type !== undefined ? airport.type : '';
            document.getElementById('image').value = airport.image || '';
            document.getElementById('airport_txt').value = airport.airport_txt || '';
            document.getElementById('Address').value = airport.Address || '';
            document.getElementById('Contact').value = airport.Contact || '';
            airportModal.show();
        })
        .catch(function(error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error loading airport data. Please try again.',
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
    
    const url = isEditMode 
        ? '{{ route("admin.api.airports.update", ":id") }}'.replace(':id', data.airport_id)
        : '{{ route("admin.api.airports.store") }}';
    
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
                airportModal.hide();
                loadAirports(currentPage);
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

// Delete airport
function deleteAirport(id) {
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
            axios.delete('{{ route("admin.api.airports.destroy", ":id") }}'.replace(':id', id))
                .then(function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: response.data.message,
                        confirmButtonColor: '#0d6efd',
                        timer: 2000,
                        timerProgressBar: true
                    }).then(() => {
                        loadAirports(currentPage);
                    });
                })
                .catch(function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.response?.data?.message || 'Error deleting airport. Please try again.',
                        confirmButtonColor: '#0d6efd'
                    });
                    console.error('Error:', error);
                });
        }
    });
}

// Reset form
function resetForm() {
    document.getElementById('airportForm').reset();
    document.getElementById('airport_id').value = '';
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
        filter_country: document.getElementById('filter_country').value.trim(),
        filter_city: document.getElementById('filter_city').value.trim(),
        filter_continent: document.getElementById('filter_continent').value.trim(),
        filter_type: document.getElementById('filter_type').value
    };
    
    // Reset to page 1 when applying filters
    loadAirports(1, currentFilters);
}

// Clear filters
function clearFilters() {
    document.getElementById('filter_name').value = '';
    document.getElementById('filter_code').value = '';
    document.getElementById('filter_country').value = '';
    document.getElementById('filter_city').value = '';
    document.getElementById('filter_continent').value = '';
    document.getElementById('filter_type').value = '';
    
    currentFilters = {};
    loadAirports(1, {});
}
</script>
@endpush

