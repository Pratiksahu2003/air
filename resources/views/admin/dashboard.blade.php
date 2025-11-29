@extends('admin.layouts.dashboard')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<!-- Welcome Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1">Welcome back, {{ Auth::user()->name }}!</h4>
                        <p class="text-muted mb-0">You are logged in as <strong>{{ ucfirst(str_replace('_', ' ', Auth::user()->role)) }}</strong></p>
                    </div>
                    <div>
                        @if(Auth::user()->isAdmin())
                        <span class="badge bg-primary fs-6 px-3 py-2">
                            <i class="fas fa-crown me-2"></i>Full Admin Access
                        </span>
                        @else
                        <span class="badge bg-warning text-dark fs-6 px-3 py-2">
                            <i class="fas fa-user-shield me-2"></i>Sub Admin Access
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="stats-card primary">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-users text-primary fs-1"></i>
                </div>
                <div class="text-end">
                    <h3 class="mb-0">{{ number_format($totalUsers) }}</h3>
                    <p class="mb-0">Total Users</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="stats-card success">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-plane text-success fs-1"></i>
                </div>
                <div class="text-end">
                    <h3 class="mb-0">{{ number_format($totalFlightEnquiries) }}</h3>
                    <p class="mb-0">Flight Enquiries</p>
                    <small class="text-muted">{{ $todayFlightEnquiries }} today</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="stats-card warning">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-book text-warning fs-1"></i>
                </div>
                <div class="text-end">
                    <h3 class="mb-0">{{ number_format($totalGroupBookings) }}</h3>
                    <p class="mb-0">Group Bookings</p>
                    <small class="text-muted">{{ $todayGroupBookings }} today</small>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="stats-card danger">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <i class="fas fa-envelope text-danger fs-1"></i>
                </div>
                <div class="text-end">
                    <h3 class="mb-0">{{ number_format($totalContactEnquiries) }}</h3>
                    <p class="mb-0">Contact Enquiries</p>
                    <small class="text-muted">{{ $todayContactEnquiries }} today</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Additional Statistics -->
<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-header bg-info text-white">
                <i class="fas fa-calendar-day me-2"></i>Today's Activity
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span>Flight Enquiries:</span>
                    <strong>{{ $todayFlightEnquiries }}</strong>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Group Bookings:</span>
                    <strong>{{ $todayGroupBookings }}</strong>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Contact Enquiries:</span>
                    <strong>{{ $todayContactEnquiries }}</strong>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <i class="fas fa-calendar-week me-2"></i>This Week
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span>Flight Enquiries:</span>
                    <strong>{{ $weekFlightEnquiries }}</strong>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Group Bookings:</span>
                    <strong>{{ $weekGroupBookings }}</strong>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Contact Enquiries:</span>
                    <strong>{{ $weekContactEnquiries }}</strong>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-header bg-success text-white">
                <i class="fas fa-calendar-alt me-2"></i>This Month
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span>Flight Enquiries:</span>
                    <strong>{{ $monthFlightEnquiries }}</strong>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Group Bookings:</span>
                    <strong>{{ $monthGroupBookings }}</strong>
                </div>
                <div class="d-flex justify-content-between">
                    <span>Contact Enquiries:</span>
                    <strong>{{ $monthContactEnquiries }}</strong>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity and Analytics -->
<div class="row">
    <!-- Recent Flight Enquiries -->
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-plane me-2"></i>Recent Flight Enquiries</span>
                <a href="{{ route('admin.flight-enquiries.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body">
                @if($recentFlightEnquiries->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentFlightEnquiries as $enquiry)
                        <div class="list-group-item px-0">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $enquiry->from_city }} → {{ $enquiry->to_city }}</h6>
                                    <small class="text-muted">
                                        <i class="fas fa-user me-1"></i>{{ $enquiry->email }}<br>
                                        <i class="fas fa-calendar me-1"></i>{{ $enquiry->departure_date->format('M d, Y') }}
                                        @if($enquiry->return_date)
                                            <span class="ms-2">Return: {{ $enquiry->return_date->format('M d, Y') }}</span>
                                        @endif
                                    </small>
                                </div>
                                <small class="text-muted">{{ $enquiry->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted text-center mb-0">No flight enquiries yet</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Recent Group Bookings -->
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-book me-2"></i>Recent Group Bookings</span>
                <a href="{{ route('admin.group-bookings.index') }}" class="btn btn-sm btn-outline-warning">View All</a>
            </div>
            <div class="card-body">
                @if($recentGroupBookings->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentGroupBookings as $booking)
                        <div class="list-group-item px-0">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $booking->name }}</h6>
                                    <small class="text-muted">
                                        <i class="fas fa-route me-1"></i>{{ $booking->from_city }} → {{ $booking->to_city }}<br>
                                        <i class="fas fa-users me-1"></i>{{ $booking->passengers }} passengers
                                        @if($booking->organization)
                                            <span class="ms-2"><i class="fas fa-building me-1"></i>{{ $booking->organization }}</span>
                                        @endif
                                    </small>
                                </div>
                                <small class="text-muted">{{ $booking->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted text-center mb-0">No group bookings yet</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Recent Contact Enquiries -->
    <div class="col-md-4 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-envelope me-2"></i>Recent Contact Enquiries</span>
                <a href="{{ route('admin.contact-enquiries.index') }}" class="btn btn-sm btn-outline-danger">View All</a>
            </div>
            <div class="card-body">
                @if($recentContactEnquiries->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentContactEnquiries as $enquiry)
                        <div class="list-group-item px-0">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $enquiry->name }}</h6>
                                    <small class="text-muted">
                                        <i class="fas fa-envelope me-1"></i>{{ $enquiry->email }}<br>
                                        @if($enquiry->subject)
                                            <i class="fas fa-tag me-1"></i>{{ Str::limit($enquiry->subject, 30) }}
                                        @endif
                                    </small>
                                </div>
                                <small class="text-muted">{{ $enquiry->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted text-center mb-0">No contact enquiries yet</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Analytics Section -->
<div class="row">
    <!-- Popular Routes -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-route me-2"></i>Popular Flight Routes
            </div>
            <div class="card-body">
                @if($popularRoutes->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Route</th>
                                    <th class="text-end">Enquiries</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($popularRoutes as $route)
                                <tr>
                                    <td>
                                        <i class="fas fa-plane text-primary me-2"></i>
                                        <strong>{{ $route->from_city }}</strong> → <strong>{{ $route->to_city }}</strong>
                                    </td>
                                    <td class="text-end">
                                        <span class="badge bg-primary">{{ $route->count }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted text-center mb-0">No route data available yet</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Group Booking Passenger Ranges -->
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-users me-2"></i>Group Bookings by Passenger Range
            </div>
            <div class="card-body">
                @if($passengerRanges->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Passenger Range</th>
                                    <th class="text-end">Bookings</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($passengerRanges as $range)
                                <tr>
                                    <td>
                                        <i class="fas fa-user-group text-warning me-2"></i>
                                        <strong>{{ $range->passengers }}</strong> passengers
                                    </td>
                                    <td class="text-end">
                                        <span class="badge bg-warning text-dark">{{ $range->count }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted text-center mb-0">No passenger range data available yet</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Activity Trend (Last 7 Days) -->
<div class="row">
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-chart-line me-2"></i>Activity Trend (Last 7 Days)
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Date</th>
                                <th class="text-center">Flight Enquiries</th>
                                <th class="text-center">Group Bookings</th>
                                <th class="text-center">Contact Enquiries</th>
                                <th class="text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enquiriesTrend as $day)
                            <tr>
                                <td><strong>{{ $day['date'] }}</strong></td>
                                <td class="text-center">
                                    @if($day['flight_enquiries'] > 0)
                                        <span class="badge bg-success">{{ $day['flight_enquiries'] }}</span>
                                    @else
                                        <span class="text-muted">0</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($day['group_bookings'] > 0)
                                        <span class="badge bg-warning text-dark">{{ $day['group_bookings'] }}</span>
                                    @else
                                        <span class="text-muted">0</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($day['contact_enquiries'] > 0)
                                        <span class="badge bg-danger">{{ $day['contact_enquiries'] }}</span>
                                    @else
                                        <span class="text-muted">0</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <strong>{{ $day['flight_enquiries'] + $day['group_bookings'] + $day['contact_enquiries'] }}</strong>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <th>Total</th>
                                <th class="text-center">{{ array_sum(array_column($enquiriesTrend, 'flight_enquiries')) }}</th>
                                <th class="text-center">{{ array_sum(array_column($enquiriesTrend, 'group_bookings')) }}</th>
                                <th class="text-center">{{ array_sum(array_column($enquiriesTrend, 'contact_enquiries')) }}</th>
                                <th class="text-center">
                                    {{ array_sum(array_column($enquiriesTrend, 'flight_enquiries')) + 
                                       array_sum(array_column($enquiriesTrend, 'group_bookings')) + 
                                       array_sum(array_column($enquiriesTrend, 'contact_enquiries')) }}
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <i class="fas fa-bolt me-2"></i>Quick Actions
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 col-sm-6 mb-2">
                        <a href="{{ route('admin.flight-enquiries.index') }}" class="btn btn-outline-primary w-100">
                            <i class="fas fa-plane me-2"></i>Manage Flight Enquiries
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-2">
                        <a href="{{ route('admin.group-bookings.index') }}" class="btn btn-outline-warning w-100">
                            <i class="fas fa-book me-2"></i>Manage Group Bookings
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-2">
                        <a href="{{ route('admin.contact-enquiries.index') }}" class="btn btn-outline-danger w-100">
                            <i class="fas fa-envelope me-2"></i>Manage Contact Enquiries
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6 mb-2">
                        <a href="{{ route('admin.airports.index') }}" class="btn btn-outline-info w-100">
                            <i class="fas fa-map-marker-alt me-2"></i>Manage Airports
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
