@extends('admin.layouts.dashboard')

@section('title', 'Group Bookings')
@section('page-title', 'Group Bookings')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-users me-2"></i>Group Bookings</h5>
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
                        <div class="col-md-3">
                            <label for="filter_email" class="form-label small">Email</label>
                            <input type="text" class="form-control form-control-sm" id="filter_email" name="filter_email" placeholder="Search by email">
                        </div>
                        <div class="col-md-3">
                            <label for="filter_organization" class="form-label small">Organization</label>
                            <input type="text" class="form-control form-control-sm" id="filter_organization" name="filter_organization" placeholder="Search organization">
                        </div>
                        <div class="col-md-3">
                            <label for="filter_from_city" class="form-label small">From City</label>
                            <input type="text" class="form-control form-control-sm" id="filter_from_city" name="filter_from_city" placeholder="Search from city">
                        </div>
                    </div>
                    <div class="row g-3 mt-1">
                        <div class="col-md-3">
                            <label for="filter_to_city" class="form-label small">To City</label>
                            <input type="text" class="form-control form-control-sm" id="filter_to_city" name="filter_to_city" placeholder="Search to city">
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
        
        <!-- Group Bookings Table -->
        <div class="table-responsive">
            <table class="table table-hover" id="bookings-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Organization</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Departure</th>
                        <th>Return</th>
                        <th>Passengers</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="bookings-tbody">
                    <tr>
                        <td colspan="12" class="text-center">
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

<!-- View Booking Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingModalLabel">Group Booking Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="bookingDetails">
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

let bookingModal;
let currentPage = 1;
let currentFilters = {};

// Initialize modal
document.addEventListener('DOMContentLoaded', function() {
    bookingModal = new bootstrap.Modal(document.getElementById('bookingModal'));
    loadBookings(1, {});
});

// Load bookings with pagination and filters
function loadBookings(page = 1, filters = null) {
    currentPage = page;
    const tbody = document.getElementById('bookings-tbody');
    tbody.innerHTML = '<tr><td colspan="12" class="text-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></td></tr>';
    
    const filtersToUse = filters !== null ? filters : currentFilters;
    const params = { page: page, per_page: 15 };
    
    if (filtersToUse.filter_name) params.filter_name = filtersToUse.filter_name;
    if (filtersToUse.filter_email) params.filter_email = filtersToUse.filter_email;
    if (filtersToUse.filter_organization) params.filter_organization = filtersToUse.filter_organization;
    if (filtersToUse.filter_from_city) params.filter_from_city = filtersToUse.filter_from_city;
    if (filtersToUse.filter_to_city) params.filter_to_city = filtersToUse.filter_to_city;
    
    axios.get('{{ route("admin.api.group-bookings.index") }}', { params: params })
        .then(function(response) {
            const bookings = response.data.data;
            const pagination = response.data.pagination;
            
            if (bookings.length === 0) {
                tbody.innerHTML = '<tr><td colspan="12" class="text-center">No bookings found</td></tr>';
                renderPagination(null);
                return;
            }
            
            tbody.innerHTML = bookings.map(booking => `
                <tr>
                    <td>${booking.id}</td>
                    <td>${booking.name || '-'}</td>
                    <td>${booking.email || '-'}</td>
                    <td>${booking.phone || '-'}</td>
                    <td>${booking.organization || '-'}</td>
                    <td>${booking.from_city || '-'}</td>
                    <td>${booking.to_city || '-'}</td>
                    <td>${booking.departure_date ? new Date(booking.departure_date).toLocaleDateString() : '-'}</td>
                    <td>${booking.return_date ? new Date(booking.return_date).toLocaleDateString() : '-'}</td>
                    <td>${booking.passengers || '-'}</td>
                    <td>${booking.created_at ? new Date(booking.created_at).toLocaleDateString() : '-'}</td>
                    <td>
                        <button class="btn btn-sm btn-info" onclick="viewBooking(${booking.id})" title="View">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="deleteBooking(${booking.id})" title="Delete">
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
                text: 'Error loading bookings. Please try again.',
                confirmButtonColor: '#0d6efd'
            });
            console.error('Error:', error);
            tbody.innerHTML = '<tr><td colspan="12" class="text-center text-danger">Error loading bookings</td></tr>';
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
    
    paginationInfo.textContent = `Showing ${pagination.from || 0} to ${pagination.to || 0} of ${pagination.total} bookings`;
    
    let paginationHTML = '';
    
    if (pagination.current_page > 1) {
        paginationHTML += `<li class="page-item"><a class="page-link" href="#" onclick="loadBookings(${pagination.current_page - 1}); return false;"><i class="fas fa-chevron-left"></i></a></li>`;
    } else {
        paginationHTML += `<li class="page-item disabled"><span class="page-link"><i class="fas fa-chevron-left"></i></span></li>`;
    }
    
    const totalPages = pagination.last_page;
    const currentPage = pagination.current_page;
    const startPage = Math.max(1, currentPage - 2);
    const endPage = Math.min(totalPages, currentPage + 2);
    
    if (currentPage > 3) {
        paginationHTML += `<li class="page-item"><a class="page-link" href="#" onclick="loadBookings(1); return false;">1</a></li>`;
        if (currentPage > 4) {
            paginationHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
        }
    }
    
    for (let i = startPage; i <= endPage; i++) {
        if (i === currentPage) {
            paginationHTML += `<li class="page-item active"><span class="page-link">${i}</span></li>`;
        } else {
            paginationHTML += `<li class="page-item"><a class="page-link" href="#" onclick="loadBookings(${i}); return false;">${i}</a></li>`;
        }
    }
    
    if (currentPage < totalPages - 2) {
        if (currentPage < totalPages - 3) {
            paginationHTML += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
        }
        paginationHTML += `<li class="page-item"><a class="page-link" href="#" onclick="loadBookings(${totalPages}); return false;">${totalPages}</a></li>`;
    }
    
    if (pagination.current_page < pagination.last_page) {
        paginationHTML += `<li class="page-item"><a class="page-link" href="#" onclick="loadBookings(${pagination.current_page + 1}); return false;"><i class="fas fa-chevron-right"></i></a></li>`;
    } else {
        paginationHTML += `<li class="page-item disabled"><span class="page-link"><i class="fas fa-chevron-right"></i></span></li>`;
    }
    
    paginationContainer.innerHTML = paginationHTML;
}

// View booking details
function viewBooking(id) {
    axios.get('{{ route("admin.api.group-bookings.show", ":id") }}'.replace(':id', id))
        .then(function(response) {
            const booking = response.data.data;
            document.getElementById('bookingDetails').innerHTML = `
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Name:</strong> ${booking.name || '-'}
                    </div>
                    <div class="col-md-6">
                        <strong>Email:</strong> ${booking.email || '-'}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Phone:</strong> ${booking.phone || '-'}
                    </div>
                    <div class="col-md-6">
                        <strong>Organization:</strong> ${booking.organization || '-'}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>From City:</strong> ${booking.from_city || '-'}
                    </div>
                    <div class="col-md-6">
                        <strong>To City:</strong> ${booking.to_city || '-'}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Departure Date:</strong> ${booking.departure_date ? new Date(booking.departure_date).toLocaleDateString() : '-'}
                    </div>
                    <div class="col-md-6">
                        <strong>Return Date:</strong> ${booking.return_date ? new Date(booking.return_date).toLocaleDateString() : '-'}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Passengers:</strong> ${booking.passengers || '-'}
                    </div>
                    <div class="col-md-6">
                        <strong>Created At:</strong> ${booking.created_at ? new Date(booking.created_at).toLocaleString() : '-'}
                    </div>
                </div>
                ${booking.requirements ? `<div class="mb-3"><strong>Requirements:</strong><p class="mt-2">${booking.requirements}</p></div>` : ''}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>IP Address:</strong> ${booking.ip_address || '-'}
                    </div>
                </div>
                ${booking.user_agent ? `<div class="mb-3"><strong>User Agent:</strong> ${booking.user_agent}</div>` : ''}
            `;
            bookingModal.show();
        })
        .catch(function(error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error loading booking details. Please try again.',
                confirmButtonColor: '#0d6efd'
            });
            console.error('Error:', error);
        });
}

// Delete booking
function deleteBooking(id) {
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
            axios.delete('{{ route("admin.api.group-bookings.destroy", ":id") }}'.replace(':id', id))
                .then(function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: response.data.message,
                        confirmButtonColor: '#0d6efd',
                        timer: 2000,
                        timerProgressBar: true
                    }).then(() => {
                        loadBookings(currentPage);
                    });
                })
                .catch(function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.response?.data?.message || 'Error deleting booking. Please try again.',
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
        filter_name: document.getElementById('filter_name').value.trim(),
        filter_email: document.getElementById('filter_email').value.trim(),
        filter_organization: document.getElementById('filter_organization').value.trim(),
        filter_from_city: document.getElementById('filter_from_city').value.trim(),
        filter_to_city: document.getElementById('filter_to_city').value.trim()
    };
    loadBookings(1, currentFilters);
}

// Clear filters
function clearFilters() {
    document.getElementById('filter_name').value = '';
    document.getElementById('filter_email').value = '';
    document.getElementById('filter_organization').value = '';
    document.getElementById('filter_from_city').value = '';
    document.getElementById('filter_to_city').value = '';
    currentFilters = {};
    loadBookings(1, {});
}
</script>
@endpush

