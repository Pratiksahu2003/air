@extends('admin.layouts.dashboard')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="stats-card primary">
            <i class="fas fa-users text-primary"></i>
            <h3>0</h3>
            <p>Total Users</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-card success">
            <i class="fas fa-plane text-success"></i>
            <h3>0</h3>
            <p>Total Flights</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-card warning">
            <i class="fas fa-book text-warning"></i>
            <h3>0</h3>
            <p>Total Bookings</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stats-card danger">
            <i class="fas fa-envelope text-danger"></i>
            <h3>0</h3>
            <p>Total Enquiries</p>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-chart-line me-2"></i>Welcome to Admin Dashboard
            </div>
            <div class="card-body">
                <h5 class="mb-3">Hello, {{ Auth::user()->name }}!</h5>
                <p class="mb-3">Welcome to the admin dashboard. You are logged in as <strong>{{ str_replace('_', ' ', Auth::user()->role) }}</strong>.</p>
                
                <div class="row mt-4">
                    <div class="col-md-6">
                        <h6><i class="fas fa-info-circle me-2 text-primary"></i>Quick Information</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>You have successfully logged in</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Your account is active</li>
                            <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>All systems are operational</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6><i class="fas fa-tasks me-2 text-primary"></i>Recent Activity</h6>
                        <p class="text-muted">No recent activity to display.</p>
                    </div>
                </div>

                @if(Auth::user()->isAdmin())
                <div class="alert alert-info mt-4">
                    <i class="fas fa-crown me-2"></i>
                    <strong>Admin Access:</strong> You have full administrative privileges.
                </div>
                @else
                <div class="alert alert-warning mt-4">
                    <i class="fas fa-user-shield me-2"></i>
                    <strong>Sub Admin Access:</strong> You have limited administrative privileges.
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

