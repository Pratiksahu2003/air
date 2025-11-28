@extends('layouts.app')

@section('title', 'MICE Solutions - ' . config('site.name') . ' | Meetings, Incentives, Conferences')

@section('content')
    <!-- Page Header -->
    <section class="page-header text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="display-4 fw-bold mb-3">MICE Solutions</h1>
                    <p class="lead">Meetings, Incentives, Conferences & Exhibitions - Complete Travel Solutions</p>
                </div>
            </div>
        </div>
    </section>

    <!-- MICE Services -->
    <section class="py-5">
        <div class="container">
            <h2 class="section-title text-center mb-5">Our MICE Services</h2>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="service-card h-100 text-center">
                        <div class="service-icon">
                            <i class="fas fa-handshake fa-3x text-primary"></i>
                        </div>
                        <h5>Meetings</h5>
                        <p>Corporate meetings, board meetings, and business gatherings with seamless travel arrangements.</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="service-card h-100 text-center">
                        <div class="service-icon">
                            <i class="fas fa-trophy fa-3x text-primary"></i>
                        </div>
                        <h5>Incentives</h5>
                        <p>Reward programs and incentive trips for employees and partners with exclusive group deals.</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="service-card h-100 text-center">
                        <div class="service-icon">
                            <i class="fas fa-users fa-3x text-primary"></i>
                        </div>
                        <h5>Conferences</h5>
                        <p>Large-scale conferences and conventions with bulk booking facilities and special rates.</p>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="service-card h-100 text-center">
                        <div class="service-icon">
                            <i class="fas fa-building fa-3x text-primary"></i>
                        </div>
                        <h5>Exhibitions</h5>
                        <p>Trade shows and exhibitions with comprehensive travel packages for exhibitors and visitors.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- MICE Request Form -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-4">
                            <h3 class="card-title text-center mb-4">
                                <i class="fas fa-calendar-check text-primary me-2"></i>Request MICE Quote
                            </h3>
                            <form id="miceForm">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Event Type</label>
                                        <select class="form-select" name="event_type" required>
                                            <option value="">Select Type</option>
                                            <option value="meeting">Meeting</option>
                                            <option value="incentive">Incentive</option>
                                            <option value="conference">Conference</option>
                                            <option value="exhibition">Exhibition</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Number of Attendees</label>
                                        <input type="number" class="form-control" name="attendees" min="10" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Event Date</label>
                                        <input type="date" class="form-control" name="event_date" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Return Date</label>
                                        <input type="date" class="form-control" name="return_date">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">From City</label>
                                        <input type="text" class="form-control" name="from_city" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">To City</label>
                                        <input type="text" class="form-control" name="to_city" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Company Name</label>
                                        <input type="text" class="form-control" name="company" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Contact Person</label>
                                        <input type="text" class="form-control" name="contact_person" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Email</label>
                                        <input type="email" class="form-control" name="email" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Phone</label>
                                        <input type="tel" class="form-control" name="phone" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold">Additional Requirements</label>
                                        <textarea class="form-control" name="requirements" rows="4"></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-lg w-100">
                                            <i class="fas fa-paper-plane me-2"></i>Request MICE Quote
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
@endsection

@push('scripts')
<script>
    document.getElementById('miceForm').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Thank you for your MICE request! Our team will contact you shortly with a customized solution.');
        this.reset();
    });
</script>
@endpush

