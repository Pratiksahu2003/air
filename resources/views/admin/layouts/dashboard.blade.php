<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/admin.css'])
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div>
                <img src="{{ asset(config('site.logo')) }}" alt="{{ config('site.name') }} Logo" style="max-height: 30px; width: auto;">
            </div>
        </div>
        <nav class="sidebar-menu">
            <ul>
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                @if(Auth::user()->isAdmin())
                <li>
                    <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </a>
                </li>
                @endif
                <li>
                    <a href="{{ route('admin.airports.index') }}" class="{{ request()->routeIs('admin.airports.*') ? 'active' : '' }}">
                        <i class="fas fa-plane-departure"></i>
                        <span>Airports</span>
                    </a>
                </li>
                @if(Auth::user()->isAdmin())
                <li>
                    <a href="{{ route('admin.airlines.index') }}" class="{{ request()->routeIs('admin.airlines.*') ? 'active' : '' }}">
                        <i class="fas fa-plane"></i>
                        <span>Airlines</span>
                    </a>
                </li>
                @endif
                <li>
                    <a href="#" class="">
                        <i class="fas fa-plane"></i>
                        <span>Flights</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.group-bookings.index') }}" class="{{ request()->routeIs('admin.group-bookings.*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i>
                        <span>Group Bookings</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.contact-enquiries.index') }}" class="{{ request()->routeIs('admin.contact-enquiries.*') ? 'active' : '' }}">
                        <i class="fas fa-envelope"></i>
                        <span>Contact Enquiries</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.flight-enquiries.index') }}" class="{{ request()->routeIs('admin.flight-enquiries.*') ? 'active' : '' }}">
                        <i class="fas fa-plane"></i>
                        <span>Flight Enquiries</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Header -->
        <header class="top-header">
            <div class="top-header-left">
                <h4>@yield('page-title', 'Dashboard')</h4>
            </div>
            <div class="top-header-right">
                <div class="user-info">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="user-details">
                        <span class="user-name">{{ Auth::user()->name }}</span>
                        <span class="user-role">{{ str_replace('_', ' ', Auth::user()->role) }}</span>
                    </div>
                </div>
                <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </button>
                </form>
            </div>
        </header>

        <!-- Content Area -->
        <div class="content-area">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; {{ date('Y') }} {{ config('site.full_name', 'Admin Panel') }}. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @vite(['resources/js/admin.js'])
    @stack('scripts')
</body>
</html>

