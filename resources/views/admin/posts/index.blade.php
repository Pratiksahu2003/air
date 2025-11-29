@extends('admin.layouts.dashboard')

@section('title', 'Post Management')
@section('page-title', 'Post Management')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-blog me-2"></i>Blog Posts</h5>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-light btn-sm">
            <i class="fas fa-plus me-2"></i>Create New Post
        </a>
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
                            <input type="text" class="form-control" id="search" name="search" placeholder="Search posts...">
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="status" name="status">
                                <option value="">All Status</option>
                                <option value="published">Published</option>
                                <option value="draft">Draft</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search me-2"></i>Filter
                            </button>
                            <button type="button" class="btn btn-secondary" onclick="resetFilters()">
                                <i class="fas fa-redo me-2"></i>Reset
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Posts Table -->
        <div class="table-responsive">
            <table class="table table-hover" id="posts-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th>Views</th>
                        <th>Published At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="posts-tbody">
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
        <div id="pagination-container" class="mt-3"></div>
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
let currentPage = 1;
let currentFilters = {};

document.addEventListener('DOMContentLoaded', function() {
    loadPosts();
});

function loadPosts(page = 1) {
    currentPage = page;
    const params = new URLSearchParams({
        page: page,
        ...currentFilters
    });

    axios.get(`{{ route('admin.api.posts.index') }}?${params}`)
        .then(function(response) {
            const posts = response.data.data.data;
            const tbody = document.getElementById('posts-tbody');
            
            if (posts.length === 0) {
                tbody.innerHTML = '<tr><td colspan="8" class="text-center">No posts found</td></tr>';
                return;
            }
            
            tbody.innerHTML = posts.map(post => `
                <tr>
                    <td>${post.id}</td>
                    <td>
                        <strong>${post.title}</strong>
                        ${post.excerpt ? `<br><small class="text-muted">${post.excerpt.substring(0, 60)}...</small>` : ''}
                    </td>
                    <td>
                        ${post.category ? `<span class="badge bg-info">${post.category.name}</span>` : '<span class="text-muted">Uncategorized</span>'}
                    </td>
                    <td>${post.author ? post.author.name : 'N/A'}</td>
                    <td>
                        <span class="badge ${post.is_published ? 'bg-success' : 'bg-secondary'}">
                            ${post.is_published ? 'Published' : 'Draft'}
                        </span>
                    </td>
                    <td>${post.views_count || 0}</td>
                    <td>${post.published_at ? new Date(post.published_at).toLocaleDateString() : '-'}</td>
                    <td>
                        <a href="{{ route('admin.posts.edit', ':id') }}".replace(':id', post.id) class="btn btn-sm btn-primary" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        ${isAdmin ? `<button class="btn btn-sm btn-danger" onclick="deletePost(${post.id})" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>` : ''}
                    </td>
                </tr>
            `).join('');

            // Render pagination
            renderPagination(response.data.data);
        })
        .catch(function(error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error loading posts. Please try again.',
                confirmButtonColor: '#0d6efd'
            });
            console.error('Error:', error);
        });
}

function renderPagination(pagination) {
    const container = document.getElementById('pagination-container');
    if (!pagination || pagination.last_page <= 1) {
        container.innerHTML = '';
        return;
    }

    let html = '<nav><ul class="pagination justify-content-center">';
    
    // Previous button
    html += `<li class="page-item ${pagination.current_page === 1 ? 'disabled' : ''}">
        <a class="page-link" href="#" onclick="loadPosts(${pagination.current_page - 1}); return false;">Previous</a>
    </li>`;

    // Page numbers
    for (let i = 1; i <= pagination.last_page; i++) {
        if (i === 1 || i === pagination.last_page || (i >= pagination.current_page - 2 && i <= pagination.current_page + 2)) {
            html += `<li class="page-item ${i === pagination.current_page ? 'active' : ''}">
                <a class="page-link" href="#" onclick="loadPosts(${i}); return false;">${i}</a>
            </li>`;
        } else if (i === pagination.current_page - 3 || i === pagination.current_page + 3) {
            html += '<li class="page-item disabled"><span class="page-link">...</span></li>';
        }
    }

    // Next button
    html += `<li class="page-item ${pagination.current_page === pagination.last_page ? 'disabled' : ''}">
        <a class="page-link" href="#" onclick="loadPosts(${pagination.current_page + 1}); return false;">Next</a>
    </li>`;

    html += '</ul></nav>';
    container.innerHTML = html;
}

function applyFilters() {
    currentFilters = {
        search: document.getElementById('search').value,
        status: document.getElementById('status').value
    };
    loadPosts(1);
}

function resetFilters() {
    document.getElementById('filterForm').reset();
    currentFilters = {};
    loadPosts(1);
}

function deletePost(id) {
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
            axios.delete(`{{ route('admin.api.posts.destroy', ':id') }}`.replace(':id', id))
                .then(function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: response.data.message,
                        confirmButtonColor: '#0d6efd',
                        timer: 2000,
                        timerProgressBar: true
                    }).then(() => {
                        loadPosts(currentPage);
                    });
                })
                .catch(function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.response?.data?.message || 'Error deleting post. Please try again.',
                        confirmButtonColor: '#0d6efd'
                    });
                });
        }
    });
}
</script>
@endpush

