<!-- Main Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset(config('site.logo')) }}" alt="{{ config('site.name') }}" class="logo-img me-2">
            <div class="logo-text">
                <span class="fw-bold text-primary d-block">{{ config('site.name') }}</span>
                <small class="text-muted d-block small d-none d-md-block">{{ config('site.tagline') }}</small>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('group-booking.*') ? 'active' : '' }}" href="#" id="groupDropdown" role="button" data-bs-toggle="dropdown">
                        Group Booking
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('group-booking.index') }}">Group Flight Booking</a></li>
                        <li><a class="dropdown-item" href="{{ route('group-booking.index') }}#domestic">Domestic Group Booking</a></li>
                        <li><a class="dropdown-item" href="{{ route('group-booking.index') }}#international">International Group Booking</a></li>
                        <li><a class="dropdown-item" href="{{ route('fix-departure') }}">Fix Departure</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('air-charter') ? 'active' : '' }}" href="{{ route('air-charter') }}">Air Charter</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('mice') ? 'active' : '' }}" href="{{ route('mice') }}">MICE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}" href="{{ route('services') }}">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary text-white ms-2 px-3" href="{{ route('group-booking.index') }}">
                        <i class="fas fa-users me-1"></i>Book Group Flight
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

