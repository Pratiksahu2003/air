@extends('layouts.app')

@section('title', 'Airlines - ' . config('site.name'))

@section('content')
    <!-- Page Header -->
    <section class="page-header text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="display-4 fw-bold mb-3">Our Airline Partners</h1>
                    <p class="lead">Book group flights with leading airlines worldwide</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Airlines Content -->
    <section class="py-5">
        <div class="container">
            <div class="mb-5">
                <h2 class="section-title text-center mb-4">Domestic Airlines</h2>
                <p class="text-center lead mb-5">We partner with all major domestic airlines in India for group bookings</p>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-3 col-6">
                    <div class="airline-card">
                        <div class="airline-logo">
                            <i class="fas fa-plane fa-3x text-primary"></i>
                        </div>
                        <h5>IndiGo</h5>
                        <p class="text-muted small">Group Booking Available</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="airline-card">
                        <div class="airline-logo">
                            <i class="fas fa-plane fa-3x text-primary"></i>
                        </div>
                        <h5>Air India</h5>
                        <p class="text-muted small">Group Booking Available</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="airline-card">
                        <div class="airline-logo">
                            <i class="fas fa-plane fa-3x text-primary"></i>
                        </div>
                        <h5>SpiceJet</h5>
                        <p class="text-muted small">Group Booking Available</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="airline-card">
                        <div class="airline-logo">
                            <i class="fas fa-plane fa-3x text-primary"></i>
                        </div>
                        <h5>Vistara</h5>
                        <p class="text-muted small">Group Booking Available</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="airline-card">
                        <div class="airline-logo">
                            <i class="fas fa-plane fa-3x text-primary"></i>
                        </div>
                        <h5>GoAir</h5>
                        <p class="text-muted small">Group Booking Available</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="airline-card">
                        <div class="airline-logo">
                            <i class="fas fa-plane fa-3x text-primary"></i>
                        </div>
                        <h5>AirAsia India</h5>
                        <p class="text-muted small">Group Booking Available</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="airline-card">
                        <div class="airline-logo">
                            <i class="fas fa-plane fa-3x text-primary"></i>
                        </div>
                        <h5>Alliance Air</h5>
                        <p class="text-muted small">Group Booking Available</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="airline-card">
                        <div class="airline-logo">
                            <i class="fas fa-plane fa-3x text-primary"></i>
                        </div>
                        <h5>TruJet</h5>
                        <p class="text-muted small">Group Booking Available</p>
                    </div>
                </div>
            </div>

            <div class="mb-5">
                <h2 class="section-title text-center mb-4">International Airlines</h2>
                <p class="text-center lead mb-5">Connect to destinations worldwide with our international airline partners</p>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-3 col-6">
                    <div class="airline-card">
                        <div class="airline-logo">
                            <i class="fas fa-plane fa-3x text-primary"></i>
                        </div>
                        <h5>Emirates</h5>
                        <p class="text-muted small">Group Booking Available</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="airline-card">
                        <div class="airline-logo">
                            <i class="fas fa-plane fa-3x text-primary"></i>
                        </div>
                        <h5>Qatar Airways</h5>
                        <p class="text-muted small">Group Booking Available</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="airline-card">
                        <div class="airline-logo">
                            <i class="fas fa-plane fa-3x text-primary"></i>
                        </div>
                        <h5>Singapore Airlines</h5>
                        <p class="text-muted small">Group Booking Available</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="airline-card">
                        <div class="airline-logo">
                            <i class="fas fa-plane fa-3x text-primary"></i>
                        </div>
                        <h5>Thai Airways</h5>
                        <p class="text-muted small">Group Booking Available</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="airline-card">
                        <div class="airline-logo">
                            <i class="fas fa-plane fa-3x text-primary"></i>
                        </div>
                        <h5>British Airways</h5>
                        <p class="text-muted small">Group Booking Available</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="airline-card">
                        <div class="airline-logo">
                            <i class="fas fa-plane fa-3x text-primary"></i>
                        </div>
                        <h5>Lufthansa</h5>
                        <p class="text-muted small">Group Booking Available</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="airline-card">
                        <div class="airline-logo">
                            <i class="fas fa-plane fa-3x text-primary"></i>
                        </div>
                        <h5>Air France</h5>
                        <p class="text-muted small">Group Booking Available</p>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="airline-card">
                        <div class="airline-logo">
                            <i class="fas fa-plane fa-3x text-primary"></i>
                        </div>
                        <h5>Etihad Airways</h5>
                        <p class="text-muted small">Group Booking Available</p>
                    </div>
                </div>
            </div>

            <div class="alert alert-info text-center">
                <h5><i class="fas fa-info-circle me-2"></i>Note</h5>
                <p class="mb-0">We work with hundreds of airlines worldwide. The above list represents some of our major partners. For specific airline availability and group rates, please contact our booking team.</p>
            </div>

            <div class="text-center mt-5">
                <h4>Ready to Book Your Group Flight?</h4>
                <p>Contact us to get the best group rates with your preferred airline.</p>
                <a href="{{ route('group-booking.index') }}" class="btn btn-primary me-2">Request Group Quote</a>
                <a href="{{ route('contact') }}" class="btn btn-outline-primary">Contact Us</a>
            </div>
        </div>
    </section>
@endsection

