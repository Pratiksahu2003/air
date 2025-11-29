@extends('layouts.app')

@section('title', config('site.full_name') . ' | Best Deals')

@section('content')
    <!-- Hero Section with Flight Search -->
    <section class="hero-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="hero-content text-center text-white mb-4">
                        <h1 class="display-5 fw-bold mb-3">Plan Group Tours to Dream Locations in Just a Click!</h1>
                        <p class="lead mb-0">Book Group Flights with Best Deals and Lowest Group Fares</p>
                    </div>
                    
                    <!-- Flight Search Form Component -->
                    <div class="search-form-wrapper">
                        @include('components.flight-search-form')
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Links -->
    <section class="quick-links py-4 bg-light">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 col-6 mb-3">
                    <a href="{{ route('group-booking.index') }}" class="quick-link-item">
                        <i class="fas fa-users fa-2x mb-2 text-primary"></i>
                        <h6>Group Booking</h6>
                    </a>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <a href="{{ route('air-charter') }}" class="quick-link-item">
                        <i class="fas fa-helicopter fa-2x mb-2 text-primary"></i>
                        <h6>Air Charter</h6>
                    </a>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <a href="{{ route('mice') }}" class="quick-link-item">
                        <i class="fas fa-building fa-2x mb-2 text-primary"></i>
                        <h6>MICE</h6>
                    </a>
                </div>
                <div class="col-md-3 col-6 mb-3">
                    <a href="{{ route('fix-departure') }}" class="quick-link-item">
                        <i class="fas fa-calendar-alt fa-2x mb-2 text-primary"></i>
                        <h6>Fix Departure</h6>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits & Key Advantages Section -->
    <section class="benefits-section py-5 position-relative">
        <div class="benefits-decorative-top"></div>
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="benefits-title mb-3">
                        Our <span class="benefits-highlight">Benefits</span> & Key Advantages
                    </h2>
                    <p class="benefits-description">
                        Discover the key advantages of booking with {{ config('site.name') }} — enjoy exclusive offers, group packages, and guaranteed best prices on domestic and international flights.
                    </p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="benefit-card">
                        <div class="benefit-icon benefit-icon-vip">
                            <i class="fas fa-lock"></i>
                        </div>
                        <h5 class="benefit-card-title">VIP Packages</h5>
                        <p class="benefit-card-text">Experience premium travel with luxury seating, lounge access, and concierge services.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="benefit-card">
                        <div class="benefit-icon benefit-icon-concert">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <h5 class="benefit-card-title">Concert Tickets</h5>
                        <p class="benefit-card-text">Book tickets for top events and tours along with your flights in one click.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="benefit-card">
                        <div class="benefit-icon benefit-icon-travel">
                            <i class="fas fa-suitcase-rolling"></i>
                        </div>
                        <h5 class="benefit-card-title">Travel Packages</h5>
                        <p class="benefit-card-text">Book flights with hotel stays and sightseeing included in one affordable package.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="benefit-card">
                        <div class="benefit-icon benefit-icon-guarantee">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h5 class="benefit-card-title">Best Price Guarantee</h5>
                        <p class="benefit-card-text">We ensure the best flight fares with 100% transparency and no hidden fees.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="landmarks-silhouette"></div>
    </section>

    <!-- Why FareHawker Section -->
    <section class="why-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <h2 class="section-title mb-4">Why {{ config('site.name') }} for Group Booking?</h2>
                    <p class="lead">{{ config('site.name') }} stays true to its name which itself its greatest virtue. In a world where even a minute matters, why waste hours standing in the long queues or chasing Travel Agents?</p>
                    <p>{{ config('site.name') }} brings you the most advanced Online Group Flight Booking Portal which Offers Best Deals on Group AirTickets for Destinations across India & world. One can choose from an extensive range of Airlines and Group Flight Tickets to suit their schedule and preferences.</p>
                    <p>Our proactive customer service team is always on a standby 24x7 to ensure that you have a hassle Free Group Flight Booking experience.</p>
                    <a href="{{ route('group-booking.index') }}" class="btn btn-primary btn-lg mt-3">
                        <i class="fas fa-users me-2"></i>Book Group Flight Now
                    </a>
                </div>
                <div class="col-lg-6">
                    <h2 class="section-title mb-4">Know Us For Your Information</h2>
                    <p class="lead">{{ config('site.name') }} GroupDesk Serve to Small/Large Tour Operators, Travel Management Companies (TMCs), MICE (Meetings, Incentives, Conferences/Convention, Exhibitions) Agencies, Corporates managing their Fix Departure and Group Travel Programs.</p>
                    <p>We Offer the Lowest AirFare or Group AirCharters for Group travellers. It includes Group Fare Deals through hundreds of routes across Airlines, including Scheduled or Non-Scheduled Carriers and Low-Cost Carriers (LCCs).</p>
                    <p>Our GroupDesk Offer greater flexibility and dedicated support when managing a large group of travellers at lowest cost for any Domestic / International Airlines. We assure you to serve the best services without any hassle.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Airlines Section -->
    <section class="airlines-section py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center mb-5">Popular Airlines for Group Booking</h2>
            <div class="row">
                <div class="col-md-3 col-6 mb-4">
                    <div class="airline-card">
                        <div class="airline-logo">
                            <i class="fas fa-plane fa-3x text-primary"></i>
                        </div>
                        <h5>Indigo</h5>
                        <p class="text-muted small">Group Booking Available</p>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="airline-card">
                        <div class="airline-logo">
                            <i class="fas fa-plane fa-3x text-primary"></i>
                        </div>
                        <h5>Air India</h5>
                        <p class="text-muted small">Group Booking Available</p>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="airline-card">
                        <div class="airline-logo">
                            <i class="fas fa-plane fa-3x text-primary"></i>
                        </div>
                        <h5>SpiceJet</h5>
                        <p class="text-muted small">Group Booking Available</p>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="airline-card">
                        <div class="airline-logo">
                            <i class="fas fa-plane fa-3x text-primary"></i>
                        </div>
                        <h5>Vistara</h5>
                        <p class="text-muted small">Group Booking Available</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Routes Section -->
    <section class="routes-section py-5">
        <div class="container">
            <h2 class="section-title text-center mb-5">Popular Group Booking Routes</h2>
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <h4 class="mb-3">Domestic Group Routes</h4>
                    <div class="route-list">
                        <a href="{{ route('group-booking.index') }}" class="route-item">Delhi to Mumbai Group Booking</a>
                        <a href="{{ route('group-booking.index') }}" class="route-item">Bangalore to Goa Group Booking</a>
                        <a href="{{ route('group-booking.index') }}" class="route-item">Mumbai to Chennai Group Booking</a>
                        <a href="{{ route('group-booking.index') }}" class="route-item">Delhi to Bangalore Group Booking</a>
                        <a href="{{ route('group-booking.index') }}" class="route-item">Kolkata to Hyderabad Group Booking</a>
                        <a href="{{ route('group-booking.index') }}" class="route-item">Pune to Delhi Group Booking</a>
                    </div>
                </div>
                <div class="col-lg-6 mb-4">
                    <h4 class="mb-3">International Group Routes</h4>
                    <div class="route-list">
                        <a href="{{ route('group-booking.index') }}" class="route-item">Delhi to Dubai Group Booking</a>
                        <a href="{{ route('group-booking.index') }}" class="route-item">Mumbai to Singapore Group Booking</a>
                        <a href="{{ route('group-booking.index') }}" class="route-item">Bangalore to London Group Booking</a>
                        <a href="{{ route('group-booking.index') }}" class="route-item">Chennai to Bangkok Group Booking</a>
                        <a href="{{ route('group-booking.index') }}" class="route-item">Delhi to New York Group Booking</a>
                        <a href="{{ route('group-booking.index') }}" class="route-item">Mumbai to Paris Group Booking</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center mb-5">Why Choose Us for Group Booking?</h2>
            <div class="row">
                <div class="col-md-3 col-6 mb-4 text-center">
                    <div class="feature-item">
                        <i class="fas fa-percent fa-3x text-primary mb-3"></i>
                        <h5>Best Group Deals</h5>
                        <p class="text-muted">Lowest group airfares guaranteed</p>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4 text-center">
                    <div class="feature-item">
                        <i class="fas fa-users fa-3x text-primary mb-3"></i>
                        <h5>Dedicated Support</h5>
                        <p class="text-muted">Special group booking team</p>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4 text-center">
                    <div class="feature-item">
                        <i class="fas fa-shield-alt fa-3x text-primary mb-3"></i>
                        <h5>Secure Booking</h5>
                        <p class="text-muted">Safe and secure transactions</p>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4 text-center">
                    <div class="feature-item">
                        <i class="fas fa-clock fa-3x text-primary mb-3"></i>
                        <h5>24/7 Support</h5>
                        <p class="text-muted">Round-the-clock assistance</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    @vite(['resources/js/flight-search.js'])
@endpush
