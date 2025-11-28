@extends('layouts.app')

@section('title', 'Our Services - ' . config('site.name'))

@section('content')
    <!-- Page Header -->
    <section class="page-header text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="display-4 fw-bold mb-3">Our Services</h1>
                    <p class="lead">Comprehensive Group Travel Solutions</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="service-card h-100">
                        <div class="service-icon">
                            <i class="fas fa-users fa-3x text-primary"></i>
                        </div>
                        <h5>{{ config('site.services.group_booking') }}</h5>
                        <p>Special group fares for tour operators, corporates, and large groups. Get exclusive discounted rates for group travel.</p>
                        <a href="{{ route('group-booking.index') }}" class="btn btn-outline-primary">Learn More</a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="service-card h-100">
                        <div class="service-icon">
                            <i class="fas fa-helicopter fa-3x text-primary"></i>
                        </div>
                        <h5>{{ config('site.services.air_charter') }}</h5>
                        <p>Private jet and helicopter charter services for VIP travel, corporate events, and special occasions.</p>
                        <a href="{{ route('air-charter') }}" class="btn btn-outline-primary">Learn More</a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="service-card h-100">
                        <div class="service-icon">
                            <i class="fas fa-building fa-3x text-primary"></i>
                        </div>
                        <h5>{{ config('site.services.mice') }}</h5>
                        <p>Meetings, Incentives, Conferences, and Exhibitions travel solutions with comprehensive packages.</p>
                        <a href="{{ route('mice') }}" class="btn btn-outline-primary">Learn More</a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="service-card h-100">
                        <div class="service-icon">
                            <i class="fas fa-calendar-alt fa-3x text-primary"></i>
                        </div>
                        <h5>{{ config('site.services.fix_departure') }}</h5>
                        <p>Pre-scheduled group departures with fixed dates and routes. Perfect for tour operators.</p>
                        <a href="{{ route('fix-departure') }}" class="btn btn-outline-primary">Learn More</a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="service-card h-100">
                        <div class="service-icon">
                            <i class="fas fa-briefcase fa-3x text-primary"></i>
                        </div>
                        <h5>{{ config('site.services.corporate_travel') }}</h5>
                        <p>Corporate travel management with dedicated account managers and special corporate rates.</p>
                        <a href="{{ route('group-booking.index') }}" class="btn btn-outline-primary">Learn More</a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="service-card h-100">
                        <div class="service-icon">
                            <i class="fas fa-headset fa-3x text-primary"></i>
                        </div>
                        <h5>24/7 Customer Support</h5>
                        <p>Round-the-clock customer support for all your travel needs and inquiries.</p>
                        <a href="{{ route('contact') }}" class="btn btn-outline-primary">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

