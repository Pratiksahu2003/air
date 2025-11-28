@extends('layouts.app')

@section('title', 'Air Charter Services - ' . config('site.name') . ' | Private Jet & Helicopter Charter')

@section('content')
    <!-- Page Header -->
    <section class="page-header bg-primary text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="display-4 fw-bold mb-3">Air Charter Services</h1>
                    <p class="lead">Private Jet & Helicopter Charter for VIP Travel, Corporate Events & More</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Charter Types -->
    <section class="py-5">
        <div class="container">
            <h2 class="section-title text-center mb-5">Our Air Charter Services</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="service-card h-100">
                        <div class="service-icon">
                            <i class="fas fa-plane fa-3x text-primary"></i>
                        </div>
                        <h5>Private Jet Charter</h5>
                        <p>Luxury private jet charter services for business executives, celebrities, and VIPs. Experience comfort and convenience.</p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i>Light Jets</li>
                            <li><i class="fas fa-check text-success me-2"></i>Midsize Jets</li>
                            <li><i class="fas fa-check text-success me-2"></i>Large Business Jets</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="service-card h-100">
                        <div class="service-icon">
                            <i class="fas fa-helicopter fa-3x text-primary"></i>
                        </div>
                        <h5>Helicopter Charter</h5>
                        <p>Helicopter services for aerial surveys, film shooting, heli-skiing, and special events. Fast and flexible.</p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i>Heli-Skiing</li>
                            <li><i class="fas fa-check text-success me-2"></i>Aerial Survey</li>
                            <li><i class="fas fa-check text-success me-2"></i>Film Shooting</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="service-card h-100">
                        <div class="service-icon">
                            <i class="fas fa-users fa-3x text-primary"></i>
                        </div>
                        <h5>Group Air Charter</h5>
                        <p>Charter entire aircraft for large groups, corporate events, weddings, and special occasions.</p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success me-2"></i>Corporate Events</li>
                            <li><i class="fas fa-check text-success me-2"></i>Weddings</li>
                            <li><i class="fas fa-check text-success me-2"></i>Sports Charter</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Charter Request Form -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-4">
                            <h3 class="card-title text-center mb-4">
                                <i class="fas fa-plane text-primary me-2"></i>Request Air Charter Quote
                            </h3>
                            <form id="charterForm">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Charter Type</label>
                                        <select class="form-select" name="charter_type" required>
                                            <option value="">Select Type</option>
                                            <option value="private-jet">Private Jet</option>
                                            <option value="helicopter">Helicopter</option>
                                            <option value="group-charter">Group Air Charter</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Number of Passengers</label>
                                        <input type="number" class="form-control" name="passengers" min="1" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">From Location</label>
                                        <input type="text" class="form-control" name="from_location" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">To Location</label>
                                        <input type="text" class="form-control" name="to_location" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Departure Date</label>
                                        <input type="date" class="form-control" name="departure_date" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Return Date (Optional)</label>
                                        <input type="date" class="form-control" name="return_date">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Your Name</label>
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Contact Number</label>
                                        <input type="tel" class="form-control" name="phone" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold">Email</label>
                                        <input type="email" class="form-control" name="email" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold">Special Requirements</label>
                                        <textarea class="form-control" name="requirements" rows="4"></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-lg w-100">
                                            <i class="fas fa-paper-plane me-2"></i>Request Charter Quote
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

    <!-- Use Cases -->
    <section class="py-5">
        <div class="container">
            <h2 class="section-title text-center mb-5">Air Charter Use Cases</h2>
            <div class="row">
                <div class="col-md-3 col-6 mb-4">
                    <div class="text-center">
                        <i class="fas fa-briefcase fa-3x text-primary mb-3"></i>
                        <h6>Corporate Travel</h6>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="text-center">
                        <i class="fas fa-video fa-3x text-primary mb-3"></i>
                        <h6>Film Shooting</h6>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="text-center">
                        <i class="fas fa-skiing fa-3x text-primary mb-3"></i>
                        <h6>Heli-Skiing</h6>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="text-center">
                        <i class="fas fa-heart fa-3x text-primary mb-3"></i>
                        <h6>Weddings</h6>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="text-center">
                        <i class="fas fa-mosque fa-3x text-primary mb-3"></i>
                        <h6>Pilgrimage</h6>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="text-center">
                        <i class="fas fa-vote-yea fa-3x text-primary mb-3"></i>
                        <h6>Election Flying</h6>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="text-center">
                        <i class="fas fa-map-marked-alt fa-3x text-primary mb-3"></i>
                        <h6>Aerial Survey</h6>
                    </div>
                </div>
                <div class="col-md-3 col-6 mb-4">
                    <div class="text-center">
                        <i class="fas fa-star fa-3x text-primary mb-3"></i>
                        <h6>VIP Charter</h6>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    document.getElementById('charterForm').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Thank you for your air charter request! Our team will contact you shortly with a customized quote.');
        this.reset();
    });
</script>
@endpush

