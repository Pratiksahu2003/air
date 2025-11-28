@extends('layouts.app')

@section('title', config('site.full_name') . ' | Best Deals')

@section('content')
    <!-- Hero Section with Flight Search -->
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="hero-content text-center text-white mb-5">
                        <h1 class="display-4 fw-bold mb-4">Plan Group Tours to Dream Locations in Just a Click!</h1>
                        <p class="lead">Book Group Flights with Best Deals and Lowest Group Fares</p>
                    </div>
                    
                    <!-- Flight Search Form -->
                    <div class="flight-search-card">
                        <div class="search-tabs">
                            <button class="tab-btn active" data-tab="one-way">
                                <i class="fas fa-arrow-right me-2"></i>One way
                            </button>
                            <button class="tab-btn" data-tab="round-trip">
                                <i class="fas fa-exchange-alt me-2"></i>Round trip
                            </button>
                        </div>
                        
                        <form id="flightSearchForm" class="search-form">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label">FROM</label>
                                    <div class="input-group position-relative">
                                        <span class="input-group-text"><i class="fas fa-plane-departure"></i></span>
                                        <input type="text" class="form-control" id="fromCity" placeholder="Delhi, India (DEL)" autocomplete="off">
                                        <div class="airport-suggestions" id="fromSuggestions"></div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">TO</label>
                                    <div class="input-group position-relative">
                                        <span class="input-group-text"><i class="fas fa-plane-arrival"></i></span>
                                        <input type="text" class="form-control" id="toCity" placeholder="Mumbai, India (BOM)" autocomplete="off">
                                        <div class="airport-suggestions" id="toSuggestions"></div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">DEPARTURE</label>
                                    <input type="date" class="form-control" id="departureDate" required>
                                </div>
                                <div class="col-md-2" id="returnDateContainer" style="display: none;">
                                    <label class="form-label">RETURN</label>
                                    <input type="date" class="form-control" id="returnDate">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">PASSENGERS</label>
                                    <div class="input-group">
                                        <button type="button" class="btn btn-outline-secondary" id="decreasePassengers">-</button>
                                        <input type="number" class="form-control text-center" id="passengers" value="1" min="1" max="50" readonly>
                                        <button type="button" class="btn btn-outline-secondary" id="increasePassengers">+</button>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-lg w-100 search-btn">
                                        <i class="fas fa-search me-2"></i>Search Group Flights
                                    </button>
                                </div>
                            </div>
                        </form>
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
