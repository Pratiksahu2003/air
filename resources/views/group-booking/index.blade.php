@extends('layouts.app')

@section('title', 'Group Flight Booking - ' . config('site.name') . ' | Best Group Fares')

@section('content')
    <!-- Modern Banner Section -->
    <section class="modern-banner position-relative overflow-hidden">
        <div class="banner-background">
            <img src="{{ asset('Banner/b3.avif') }}" alt="Group Flight Booking" class="banner-image">
            <div class="banner-overlay"></div>
        </div>
        <div class="container position-relative">
            <div class="row align-items-center min-vh-50">
                <div class="col-lg-8 col-md-10 mx-auto text-center text-white">
                    <div class="banner-content" data-aos="fade-up" data-aos-duration="1000">
                        <div class="banner-badge mb-3">
                            <span class="badge-custom">
                                <i class="fas fa-users me-2"></i>Best Group Fares Available
                            </span>
                        </div>
                        <h1 class="banner-title mb-4">
                            Group Flight Booking
                            <span class="title-highlight">Made Easy</span>
                        </h1>
                        <p class="banner-subtitle mb-4">
                            Get exclusive discounted rates for group travel with significant savings. 
                            Perfect for corporate teams, family reunions, and tour groups.
                        </p>
                        <div class="banner-features mb-5">
                            <div class="row g-3 justify-content-center">
                                <div class="col-md-4 col-sm-6">
                                    <div class="feature-item">
                                        <i class="fas fa-tags feature-icon"></i>
                                        <span>Special Group Fares</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="feature-item">
                                        <i class="fas fa-user-tie feature-icon"></i>
                                        <span>Dedicated Support</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="feature-item">
                                        <i class="fas fa-globe feature-icon"></i>
                                        <span>Worldwide Coverage</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="banner-cta">
                            <a href="#bookingFormSection" class="btn btn-light btn-lg px-5 py-3 rounded-pill shadow-lg">
                                <i class="fas fa-paper-plane me-2"></i>Request Quote Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="banner-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>
    </section>

    <!-- Group Booking Form -->
    <section id="bookingFormSection" class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-11">
                    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                        <div class="card-header bg-primary text-white py-4">
                            <h3 class="card-title text-center mb-0">
                                <i class="fas fa-users me-2"></i>Request Group Booking Quote
                            </h3>
                            <p class="text-center mb-0 mt-2 opacity-90">Fill in the details below and we'll get back to you with the best group fares</p>
                        </div>
                        <div class="card-body p-4 p-md-5">
                            <form id="groupBookingForm">
                                <!-- Route Selection -->
                                <div class="form-section mb-4">
                                    <h5 class="section-heading mb-3">
                                        <i class="fas fa-route text-primary me-2"></i>Travel Details
                                    </h5>
                                    <div class="row g-3">
                                        <div class="col-lg-5 col-md-6 position-relative">
                                            <label class="form-label fw-bold">
                                                <i class="fas fa-plane-departure me-1 text-primary"></i>From City
                                            </label>
                                            <div class="input-group position-relative">
                                                <span class="input-group-text bg-light"><i class="fas fa-map-marker-alt text-primary"></i></span>
                                                <input type="text" class="form-control" id="fromCity" name="from_city" placeholder="Delhi, India (DEL)" autocomplete="off" required>
                                                <div class="airport-suggestions" id="fromSuggestions"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-md-12 text-center d-flex align-items-end justify-content-center pb-2">
                                            <button type="button" class="btn btn-outline-primary btn-sm rounded-circle" id="swapCities" title="Swap cities">
                                                <i class="fas fa-exchange-alt"></i>
                                            </button>
                                        </div>
                                        <div class="col-lg-5 col-md-6 position-relative">
                                            <label class="form-label fw-bold">
                                                <i class="fas fa-plane-arrival me-1 text-primary"></i>To City
                                            </label>
                                            <div class="input-group position-relative">
                                                <span class="input-group-text bg-light"><i class="fas fa-map-marker-alt text-primary"></i></span>
                                                <input type="text" class="form-control" id="toCity" name="to_city" placeholder="Mumbai, India (BOM)" autocomplete="off" required>
                                                <div class="airport-suggestions" id="toSuggestions"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Date & Passengers -->
                                <div class="form-section mb-4">
                                    <h5 class="section-heading mb-3">
                                        <i class="fas fa-calendar-alt text-primary me-2"></i>Travel Dates & Group Size
                                    </h5>
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">
                                                <i class="fas fa-calendar me-1 text-primary"></i>Departure Date
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light"><i class="fas fa-calendar text-primary"></i></span>
                                                <input type="text" class="form-control datepicker" id="departureDate" name="departure_date" placeholder="Select Departure Date" required readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">
                                                <i class="fas fa-calendar-check me-1 text-primary"></i>Return Date <span class="text-muted small">(Optional)</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light"><i class="fas fa-calendar text-primary"></i></span>
                                                <input type="text" class="form-control datepicker" id="returnDate" name="return_date" placeholder="Select Return Date" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold">
                                                <i class="fas fa-users me-1 text-primary"></i>Number of Passengers
                                            </label>
                                            <select class="form-select" name="passengers" required>
                                                <option value="">Select Group Size</option>
                                                <option value="10-20">10-20 Passengers</option>
                                                <option value="21-30">21-30 Passengers</option>
                                                <option value="31-50">31-50 Passengers</option>
                                                <option value="51-100">51-100 Passengers</option>
                                                <option value="100+">100+ Passengers</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Contact Information -->
                                <div class="form-section mb-4">
                                    <h5 class="section-heading mb-3">
                                        <i class="fas fa-user-circle text-primary me-2"></i>Contact Information
                                    </h5>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Your Name <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light"><i class="fas fa-user text-primary"></i></span>
                                                <input type="text" class="form-control" name="name" placeholder="Enter your full name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Email Address <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light"><i class="fas fa-envelope text-primary"></i></span>
                                                <input type="email" class="form-control" name="email" placeholder="your.email@example.com" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Phone Number <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light"><i class="fas fa-phone text-primary"></i></span>
                                                <input type="tel" class="form-control" name="phone" placeholder="+91 1234567890" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold">Organization/Company</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-light"><i class="fas fa-building text-primary"></i></span>
                                                <input type="text" class="form-control" name="organization" placeholder="Company name (optional)">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Additional Requirements -->
                                <div class="form-section mb-4">
                                    <h5 class="section-heading mb-3">
                                        <i class="fas fa-clipboard-list text-primary me-2"></i>Additional Requirements
                                    </h5>
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold">Special Requirements or Preferences</label>
                                            <textarea class="form-control" name="requirements" rows="4" placeholder="Any special requirements, preferred airlines, meal preferences, seat preferences, etc."></textarea>
                                            <small class="form-text text-muted">Please provide any additional information that will help us serve you better</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="form-section">
                                    <button type="submit" class="btn btn-primary btn-lg w-100 py-3">
                                        <i class="fas fa-paper-plane me-2"></i>Request Group Booking Quote
                                    </button>
                                    <p class="text-center text-muted small mt-3 mb-0">
                                        <i class="fas fa-shield-alt me-1"></i>Your information is secure and will only be used for booking purposes
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center mb-5">Benefits of Group Booking</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="service-card h-100">
                        <div class="service-icon">
                            <i class="fas fa-tags fa-3x text-primary"></i>
                        </div>
                        <h5>Special Group Fares</h5>
                        <p>Get exclusive discounted rates for group travel with significant savings compared to individual bookings.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="service-card h-100">
                        <div class="service-icon">
                            <i class="fas fa-user-tie fa-3x text-primary"></i>
                        </div>
                        <h5>Dedicated Account Manager</h5>
                        <p>Personalized support from our group booking specialists who understand your travel needs.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="service-card h-100">
                        <div class="service-icon">
                            <i class="fas fa-calendar-check fa-3x text-primary"></i>
                        </div>
                        <h5>Flexible Payment Options</h5>
                        <p>Convenient payment plans and terms tailored for group bookings and corporate travel.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Domestic Routes -->
    <section id="domestic" class="py-5">
        <div class="container">
            <h2 class="section-title text-center mb-5">Popular Domestic Group Routes</h2>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="route-card p-3 border rounded">
                        <h5><i class="fas fa-route text-primary me-2"></i>Delhi to Mumbai</h5>
                        <p class="text-muted mb-0">Best group fares available for corporate and leisure groups</p>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="route-card p-3 border rounded">
                        <h5><i class="fas fa-route text-primary me-2"></i>Bangalore to Goa</h5>
                        <p class="text-muted mb-0">Perfect for group tours and corporate retreats</p>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="route-card p-3 border rounded">
                        <h5><i class="fas fa-route text-primary me-2"></i>Mumbai to Chennai</h5>
                        <p class="text-muted mb-0">Great deals for business and family groups</p>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="route-card p-3 border rounded">
                        <h5><i class="fas fa-route text-primary me-2"></i>Delhi to Bangalore</h5>
                        <p class="text-muted mb-0">Special rates for tech companies and startups</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- International Routes -->
    <section id="international" class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center mb-5">Popular International Group Routes</h2>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="route-card p-3 border rounded">
                        <h5><i class="fas fa-globe text-primary me-2"></i>Delhi to Dubai</h5>
                        <p class="text-muted mb-0">Excellent group packages for business and leisure</p>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="route-card p-3 border rounded">
                        <h5><i class="fas fa-globe text-primary me-2"></i>Mumbai to Singapore</h5>
                        <p class="text-muted mb-0">Competitive group fares for corporate travel</p>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="route-card p-3 border rounded">
                        <h5><i class="fas fa-globe text-primary me-2"></i>Bangalore to London</h5>
                        <p class="text-muted mb-0">Premium group booking services available</p>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="route-card p-3 border rounded">
                        <h5><i class="fas fa-globe text-primary me-2"></i>Chennai to Bangkok</h5>
                        <p class="text-muted mb-0">Great deals for tour operators and travel agents</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
@vite(['resources/css/group-booking.css'])
@endpush

@push('scripts')
@vite(['resources/js/group-booking.js'])
@endpush

