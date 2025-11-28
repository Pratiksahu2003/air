@extends('layouts.app')

@section('title', 'About Us - ' . config('site.name'))

@section('content')
    <!-- Page Header -->
    <section class="page-header bg-primary text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="display-4 fw-bold mb-3">About {{ config('site.name') }}</h1>
                    <p class="lead">Your Trusted Partner for Group Flight Bookings</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Content -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <h2 class="section-title mb-4">Who We Are</h2>
                    <p class="lead">{{ config('site.name') }} is a leading group flight booking platform specializing in providing the best deals on domestic and international group travel.</p>
                    <p>We serve Small/Large Tour Operators, Travel Management Companies (TMCs), MICE (Meetings, Incentives, Conferences/Convention, Exhibitions) Agencies, and Corporates managing their Fix Departure and Group Travel Programs.</p>
                    <p>Our mission is to make group travel booking seamless, affordable, and hassle-free for all our clients.</p>
                </div>
                <div class="col-lg-6 mb-4">
                    <h2 class="section-title mb-4">What We Offer</h2>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <strong>Lowest Group Fares:</strong> Exclusive discounted rates for group travel
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <strong>Dedicated Support:</strong> Personal account managers for group bookings
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <strong>Flexible Payment:</strong> Convenient payment plans for groups
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <strong>24/7 Service:</strong> Round-the-clock customer support
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <strong>Wide Network:</strong> Access to hundreds of routes across airlines
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="section-title text-center mb-5">Why Choose {{ config('site.name') }}?</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="service-card h-100 text-center">
                        <div class="service-icon">
                            <i class="fas fa-award fa-3x text-primary"></i>
                        </div>
                        <h5>Best Prices</h5>
                        <p>We guarantee the lowest group fares with special deals and discounts.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="service-card h-100 text-center">
                        <div class="service-icon">
                            <i class="fas fa-headset fa-3x text-primary"></i>
                        </div>
                        <h5>Expert Support</h5>
                        <p>Our experienced team provides personalized assistance for all your travel needs.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="service-card h-100 text-center">
                        <div class="service-icon">
                            <i class="fas fa-shield-alt fa-3x text-primary"></i>
                        </div>
                        <h5>Secure & Reliable</h5>
                        <p>Safe transactions and reliable service with industry-leading security.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

