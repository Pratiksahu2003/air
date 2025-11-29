@extends('admin.layouts.dashboard')

@section('title', 'Flight Enquiries')
@section('page-title', 'Flight Enquiries')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-plane me-2"></i>Flight Enquiries</h5>
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
                            <label for="filter_email" class="form-label small">Email</label>
                            <input type="text" class="form-control form-control-sm" id="filter_email" name="filter_email" placeholder="Search by email">
                        </div>
                        <div class="col-md-3">
                            <label for="filter_from_city" class="form-label small">From City</label>
                            <input type="text" class="form-control form-control-sm" id="filter_from_city" name="filter_from_city" placeholder="Search from city">
                        </div>
                        <div class="col-md-3">
                            <label for="filter_to_city" class="form-label small">To City</label>
                            <input type="text" class="form-control form-control-sm" id="filter_to_city" name="filter_to_city" placeholder="Search to city">
                        </div>
                        <div class="col-md-3">
                            <label for="filter_trip_type" class="form-label small">Trip Type</label>
                            <select class="form-select form-select-sm" id="filter_trip_type" name="filter_trip_type">
                                <option value="">All</option>
                                <option value="one-way">One Way</option>
                                <option value="round-trip">Round Trip</option>
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
        
        <!-- Flight Enquiries Table -->
        <div class="table-responsive">
            <table class="table table-hover" id="enquiries-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Trip Type</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Departure</th>
                        <th>Return</th>
                        <th>Passengers</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="enquiries-tbody">
                    <tr>
                        <td colspan="11" class="text-center">
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

<!-- View Enquiry Modal -->
<div class="modal fade" id="enquiryModal" tabindex="-1" aria-labelledby="enquiryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="enquiryModalLabel">Flight Enquiry Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="enquiryDetails">
                <!-- Details will be inserted here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
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

let enquiryModal;
let currentPage = 1;
let currentFilters = {};

// Initialize modal
document.addEventListener('DOMContentLoaded', function() {
    enquiryModal = new bootstrap.Modal(document.getElementById('enquiryModal'));
    loadEnquiries(1, {});
});

// Load enquiries with pagination and filters
function loadEnquiries(page = 1, filters = null) {
    currentPage = page;
    const tbody = document.getElementById('enquiries-tbody');
    tbody.innerHTML = '<tr><td colspan="11" class="text-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></td></tr>';
    
    const filtersToUse = filters !== null ? filters : currentFilters;
    const params = { page: page, per_page: 15 };
    
    if (filtersToUse.filter_email) params.filter_email = filtersToUse.filter_email;
    if (filtersToUse.filter_from_city) params.filter_from_city = filtersToUse.filter_from_city;
    if (filtersToUse.filter_to_city) params.filter_to_city = filtersToUse.filter_to_city;
    if (filtersToUse.filter_trip_type) params.filter_trip_type = filtersToUse.filter_trip_type;
    
    axios.get('{{ route("admin.api.flight-enquiries.index") }}', { params: params })
        .then(function(response) {
            const enquiries = response.data.data;
            const pagination = response.data.pagination;
            
            if (enquiries.length === 0) {
                tbody.innerHTML = '<tr><td colspan="11" class="text-center">No enquiries found</td></tr>';
                renderPagination(null);
                return;
            }
            
            tbody.innerHTML = enquiries.map(enquiry => {
                const passengers = [];
                if (enquiry.adults) passengers.push(`${enquiry.adults} Adult${enquiry.adults > 1 ? 's' : ''}`);
                if (enquiry.children) passengers.push(`${enquiry.children} Child${enquiry.children > 1 ? 'ren' : ''}`);
                if (enquiry.infants) passengers.push(`${enquiry.infants} Infant${enquiry.infants > 1 ? 's' : ''}`);
                const passengerText = passengers.length > 0 ? passengers.join(', ') : '-';
                
                return `
                <tr>
                    <td>${enquiry.id}</td>
                    <td><span class="badge bg-info">${enquiry.trip_type || '-'}</span></td>
                    <td>${enquiry.from_city || '-'}</td>
                    <td>${enquiry.to_city || '-'}</td>
                    <td>${enquiry.departure_date ? new Date(enquiry.departure_date).toLocaleDateString() : '-'}</td>
                    <td>${enquiry.return_date ? new Date(enquiry.return_date).toLocaleDateString() : '-'}</td>
                    <td>${passengerText}</td>
                    <td>${enquiry.contact_number || '-'}</td>
                    <td>${enquiry.email || '-'}</td>
                    <td>${enquiry.created_at ? new Date(enquiry.created_at).toLocaleDateString() : '-'}</td>
                    <td>
                        <button class="btn btn-sm btn-info" onclick="viewEnquiry(${enquiry.id})" title="View">
                            <i class="fas fa-eye"></i>
                        </button>
                        ${isAdmin ? `<button class="btn btn-sm btn-danger" onclick="deleteEnquiry(${enquiry.id})" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>` : ''}
                    </td>
                </tr>
            `;
            }).join('');
            
            renderPagination(pagination);
        })
        .catch(function(error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error loading enquiries. Please try again.',
                confirmButtonColor: '#0d6efd'
            });
            console.error('Error:', error);
            tbody.innerHTML = '<tr><td colspan="11" class="text-center text-danger">Error loading enquiries</td></tr>';
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
    
    paginationInfo.textContent = `Showing ${pagination.from || 0} to ${pagination.to || 0} of ${pagination.total} enquiries`;
    
    let paginationHTML = '';
    
    if (pagination.current_page > 1) {
        paginationHTML += `<li class="page-item"><a class="page-link" href="#" onclick="loadEnquiries(${pagination.current_page - 1}); return false;"><i class="fas fa-chevron-left"></i></a></li>`;
    } else {
        paginationHTML += `<li class="page-item disabled"><span class="page-link"><i class="fas fa-chevron-left"></i></span></li>`;
    }
    
    const totalPages = pagination.last_page;
    const currentPage = pagination.current_page;
    const startPage = Math.max(1, currentPage - 2);
    const endPage = Math.min(totalPages, currentPage + 2);
    
    if (currentPage > 3) {
        paginationHTML += `<li class="page-item"><a class="page-link" href="#" onclick="loadEnquiries(1); return false;">1</a></li>`;
        if (currentPage > 4) {
            paginationHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
        }
    }
    
    for (let i = startPage; i <= endPage; i++) {
        if (i === currentPage) {
            paginationHTML += `<li class="page-item active"><span class="page-link">${i}</span></li>`;
        } else {
            paginationHTML += `<li class="page-item"><a class="page-link" href="#" onclick="loadEnquiries(${i}); return false;">${i}</a></li>`;
        }
    }
    
    if (currentPage < totalPages - 2) {
        if (currentPage < totalPages - 3) {
            paginationHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
        }
        paginationHTML += `<li class="page-item"><a class="page-link" href="#" onclick="loadEnquiries(${totalPages}); return false;">${totalPages}</a></li>`;
    }
    
    if (pagination.current_page < pagination.last_page) {
        paginationHTML += `<li class="page-item"><a class="page-link" href="#" onclick="loadEnquiries(${pagination.current_page + 1}); return false;"><i class="fas fa-chevron-right"></i></a></li>`;
    } else {
        paginationHTML += `<li class="page-item disabled"><span class="page-link"><i class="fas fa-chevron-right"></i></span></li>`;
    }
    
    paginationContainer.innerHTML = paginationHTML;
}

// View enquiry details
function viewEnquiry(id) {
    axios.get('{{ route("admin.api.flight-enquiries.show", ":id") }}'.replace(':id', id))
        .then(function(response) {
            const enquiry = response.data.data;
            const passengers = [];
            if (enquiry.adults) passengers.push(`${enquiry.adults} Adult${enquiry.adults > 1 ? 's' : ''}`);
            if (enquiry.children) passengers.push(`${enquiry.children} Child${enquiry.children > 1 ? 'ren' : ''}`);
            if (enquiry.infants) passengers.push(`${enquiry.infants} Infant${enquiry.infants > 1 ? 's' : ''}`);
            
            document.getElementById('enquiryDetails').innerHTML = `
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Trip Type:</strong> <span class="badge bg-info">${enquiry.trip_type || '-'}</span>
                    </div>
                    <div class="col-md-6">
                        <strong>Email:</strong> ${enquiry.email || '-'}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>From City:</strong> ${enquiry.from_city || '-'}
                    </div>
                    <div class="col-md-6">
                        <strong>To City:</strong> ${enquiry.to_city || '-'}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Departure Date:</strong> ${enquiry.departure_date ? new Date(enquiry.departure_date).toLocaleDateString() : '-'}
                    </div>
                    <div class="col-md-6">
                        <strong>Return Date:</strong> ${enquiry.return_date ? new Date(enquiry.return_date).toLocaleDateString() : '-'}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Passengers:</strong> ${passengers.length > 0 ? passengers.join(', ') : '-'}
                    </div>
                    <div class="col-md-6">
                        <strong>Contact Number:</strong> ${enquiry.contact_number || '-'}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>IP Address:</strong> ${enquiry.ip_address || '-'}
                    </div>
                    <div class="col-md-6">
                        <strong>Created At:</strong> ${enquiry.created_at ? new Date(enquiry.created_at).toLocaleString() : '-'}
                    </div>
                </div>
                ${enquiry.user_agent ? `<div class="mb-3"><strong>User Agent:</strong> ${enquiry.user_agent}</div>` : ''}
            `;
            enquiryModal.show();
        })
        .catch(function(error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error loading enquiry details. Please try again.',
                confirmButtonColor: '#0d6efd'
            });
            console.error('Error:', error);
        });
}

// Delete enquiry
function deleteEnquiry(id) {
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
            axios.delete('{{ route("admin.api.flight-enquiries.destroy", ":id") }}'.replace(':id', id))
                .then(function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: response.data.message,
                        confirmButtonColor: '#0d6efd',
                        timer: 2000,
                        timerProgressBar: true
                    }).then(() => {
                        loadEnquiries(currentPage);
                    });
                })
                .catch(function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.response?.data?.message || 'Error deleting enquiry. Please try again.',
                        confirmButtonColor: '#0d6efd'
                    });
                    console.error('Error:', error);
                });
        }
    });
}

// Apply filters
function applyFilters() {
    currentFilters = {
        filter_email: document.getElementById('filter_email').value.trim(),
        filter_from_city: document.getElementById('filter_from_city').value.trim(),
        filter_to_city: document.getElementById('filter_to_city').value.trim(),
        filter_trip_type: document.getElementById('filter_trip_type').value
    };
    loadEnquiries(1, currentFilters);
}

// Clear filters
function clearFilters() {
    document.getElementById('filter_email').value = '';
    document.getElementById('filter_from_city').value = '';
    document.getElementById('filter_to_city').value = '';
    document.getElementById('filter_trip_type').value = '';
    currentFilters = {};
    loadEnquiries(1, {});
}
</script>
@endpush

