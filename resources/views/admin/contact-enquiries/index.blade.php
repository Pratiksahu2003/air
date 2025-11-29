@extends('admin.layouts.dashboard')

@section('title', 'Contact Enquiries')
@section('page-title', 'Contact Enquiries')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-envelope me-2"></i>Contact Enquiries</h5>
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
                        <div class="col-md-4">
                            <label for="filter_email" class="form-label small">Email</label>
                            <input type="text" class="form-control form-control-sm" id="filter_email" name="filter_email" placeholder="Search by email">
                        </div>
                        <div class="col-md-4">
                            <label for="filter_subject" class="form-label small">Subject</label>
                            <input type="text" class="form-control form-control-sm" id="filter_subject" name="filter_subject" placeholder="Search by subject">
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
        
        <!-- Contact Enquiries Table -->
        <div class="table-responsive">
            <table class="table table-hover" id="enquiries-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="enquiries-tbody">
                    <tr>
                        <td colspan="8" class="text-center">
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
                <h5 class="modal-title" id="enquiryModalLabel">Contact Enquiry Details</h5>
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
    tbody.innerHTML = '<tr><td colspan="8" class="text-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></td></tr>';
    
    const filtersToUse = filters !== null ? filters : currentFilters;
    const params = { page: page, per_page: 15 };
    
    if (filtersToUse.filter_name) params.filter_name = filtersToUse.filter_name;
    if (filtersToUse.filter_email) params.filter_email = filtersToUse.filter_email;
    if (filtersToUse.filter_subject) params.filter_subject = filtersToUse.filter_subject;
    
    axios.get('{{ route("admin.api.contact-enquiries.index") }}', { params: params })
        .then(function(response) {
            const enquiries = response.data.data;
            const pagination = response.data.pagination;
            
            if (enquiries.length === 0) {
                tbody.innerHTML = '<tr><td colspan="8" class="text-center">No enquiries found</td></tr>';
                renderPagination(null);
                return;
            }
            
            tbody.innerHTML = enquiries.map(enquiry => `
                <tr>
                    <td>${enquiry.id}</td>
                    <td>${enquiry.name || '-'}</td>
                    <td>${enquiry.email || '-'}</td>
                    <td>${enquiry.phone || '-'}</td>
                    <td>${enquiry.subject || '-'}</td>
                    <td>${enquiry.message ? (enquiry.message.length > 50 ? enquiry.message.substring(0, 50) + '...' : enquiry.message) : '-'}</td>
                    <td>${enquiry.created_at ? new Date(enquiry.created_at).toLocaleDateString() : '-'}</td>
                    <td>
                        <button class="btn btn-sm btn-info" onclick="viewEnquiry(${enquiry.id})" title="View">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="deleteEnquiry(${enquiry.id})" title="Delete">
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
                text: 'Error loading enquiries. Please try again.',
                confirmButtonColor: '#0d6efd'
            });
            console.error('Error:', error);
            tbody.innerHTML = '<tr><td colspan="8" class="text-center text-danger">Error loading enquiries</td></tr>';
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
    axios.get('{{ route("admin.api.contact-enquiries.show", ":id") }}'.replace(':id', id))
        .then(function(response) {
            const enquiry = response.data.data;
            document.getElementById('enquiryDetails').innerHTML = `
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Name:</strong> ${enquiry.name || '-'}
                    </div>
                    <div class="col-md-6">
                        <strong>Email:</strong> ${enquiry.email || '-'}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Phone:</strong> ${enquiry.phone || '-'}
                    </div>
                    <div class="col-md-6">
                        <strong>Subject:</strong> ${enquiry.subject || '-'}
                    </div>
                </div>
                <div class="mb-3">
                    <strong>Message:</strong>
                    <p class="mt-2">${enquiry.message || '-'}</p>
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
            axios.delete('{{ route("admin.api.contact-enquiries.destroy", ":id") }}'.replace(':id', id))
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
        filter_name: document.getElementById('filter_name').value.trim(),
        filter_email: document.getElementById('filter_email').value.trim(),
        filter_subject: document.getElementById('filter_subject').value.trim()
    };
    loadEnquiries(1, currentFilters);
}

// Clear filters
function clearFilters() {
    document.getElementById('filter_name').value = '';
    document.getElementById('filter_email').value = '';
    document.getElementById('filter_subject').value = '';
    currentFilters = {};
    loadEnquiries(1, {});
}
</script>
@endpush

