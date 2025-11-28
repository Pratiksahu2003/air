@extends('layouts.app')

@section('title', 'Fix Departure - ' . config('site.name') . ' | Scheduled Group Departures')

@section('content')
    <!-- Page Header -->
    <section class="page-header text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="display-4 fw-bold mb-3">Fix Departure</h1>
                    <p class="lead">Pre-Scheduled Group Departures with Fixed Dates and Routes</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Fix Departure Info -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-4">
                            <h3 class="card-title mb-4">
                                <i class="fas fa-calendar-check text-primary me-2"></i>What is Fix Departure?
                            </h3>
                            <p class="lead">Fix Departure packages are pre-scheduled group travel programs with fixed departure dates and routes, perfect for tour operators and travel agents.</p>
                            <h5 class="mt-4 mb-3">Benefits:</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Guaranteed departure dates</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Fixed pricing with no surprises</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Best group rates available</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Easy booking for multiple passengers</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Ideal for tour operators</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Request Form -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-4">
                            <h3 class="card-title text-center mb-4">
                                <i class="fas fa-calendar-alt text-primary me-2"></i>Request Fix Departure Package
                            </h3>
                            <form id="fixDepartureForm">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Route</label>
                                        <input type="text" class="form-control" name="route" placeholder="e.g., Delhi to Goa" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Preferred Departure Date</label>
                                        <input type="date" class="form-control" name="departure_date" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Number of Passengers</label>
                                        <input type="number" class="form-control" name="passengers" min="10" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Return Date (Optional)</label>
                                        <input type="date" class="form-control" name="return_date">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Company/Organization</label>
                                        <input type="text" class="form-control" name="organization" required>
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
                                            <i class="fas fa-paper-plane me-2"></i>Request Fix Departure Package
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
    document.getElementById('fixDepartureForm').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Thank you for your Fix Departure request! Our team will contact you shortly with available packages.');
        this.reset();
    });
</script>
@endpush

