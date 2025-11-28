@extends('layouts.app')

@section('title', 'Group Flight Booking - ' . config('site.name') . ' | Best Group Fares')

@section('content')
    <!-- Page Header -->
    <section class="page-header text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="display-4 fw-bold mb-3">Group Flight Booking</h1>
                    <p class="lead">Get the Best Group Fares for Domestic and International Flights</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Group Booking Form -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-4">
                            <h3 class="card-title text-center mb-4">
                                <i class="fas fa-users text-primary me-2"></i>Request Group Booking Quote
                            </h3>
                            <form id="groupBookingForm">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">From City</label>
                                        <div class="input-group position-relative">
                                            <span class="input-group-text"><i class="fas fa-plane-departure"></i></span>
                                            <input type="text" class="form-control" name="from_city" placeholder="Delhi, India (DEL)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">To City</label>
                                        <div class="input-group position-relative">
                                            <span class="input-group-text"><i class="fas fa-plane-arrival"></i></span>
                                            <input type="text" class="form-control" name="to_city" placeholder="Mumbai, India (BOM)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-bold">Departure Date</label>
                                        <input type="date" class="form-control" name="departure_date" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-bold">Return Date (Optional)</label>
                                        <input type="date" class="form-control" name="return_date">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-bold">Number of Passengers</label>
                                        <select class="form-select" name="passengers" required>
                                            <option value="">Select</option>
                                            <option value="10-20">10-20 Passengers</option>
                                            <option value="21-30">21-30 Passengers</option>
                                            <option value="31-50">31-50 Passengers</option>
                                            <option value="51-100">51-100 Passengers</option>
                                            <option value="100+">100+ Passengers</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Your Name</label>
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Email</label>
                                        <input type="email" class="form-control" name="email" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Phone Number</label>
                                        <input type="tel" class="form-control" name="phone" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Organization/Company</label>
                                        <input type="text" class="form-control" name="organization">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold">Additional Requirements</label>
                                        <textarea class="form-control" name="requirements" rows="4" placeholder="Any special requirements, preferred airlines, etc."></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-lg w-100">
                                            <i class="fas fa-paper-plane me-2"></i>Request Group Booking Quote
                                        </button>
                                    </div>
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

@push('scripts')
<script>
    document.getElementById('groupBookingForm').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Thank you for your group booking request! Our team will contact you shortly with the best group fare quotes.');
        this.reset();
    });
</script>
@endpush

