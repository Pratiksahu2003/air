@extends('layouts.app')

@section('title', 'Airports - ' . config('site.name'))

@section('content')
    <!-- Page Header -->
    <section class="page-header text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="display-4 fw-bold mb-3">Airports We Serve</h1>
                    <p class="lead">Group bookings available from airports across India and worldwide</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Airports Content -->
    <section class="py-5">
        <div class="container">
            <div class="mb-5">
                <h2 class="section-title text-center mb-4">Major Domestic Airports</h2>
                <p class="text-center lead mb-5">We provide group booking services from all major airports in India</p>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-4 col-6">
                    <div class="route-item">
                        <i class="fas fa-plane-departure text-primary me-2"></i>
                        <strong>Delhi (DEL)</strong> - Indira Gandhi International Airport
                    </div>
                </div>
                <div class="col-md-4 col-6">
                    <div class="route-item">
                        <i class="fas fa-plane-departure text-primary me-2"></i>
                        <strong>Mumbai (BOM)</strong> - Chhatrapati Shivaji Maharaj International Airport
                    </div>
                </div>
                <div class="col-md-4 col-6">
                    <div class="route-item">
                        <i class="fas fa-plane-departure text-primary me-2"></i>
                        <strong>Bangalore (BLR)</strong> - Kempegowda International Airport
                    </div>
                </div>
                <div class="col-md-4 col-6">
                    <div class="route-item">
                        <i class="fas fa-plane-departure text-primary me-2"></i>
                        <strong>Chennai (MAA)</strong> - Chennai International Airport
                    </div>
                </div>
                <div class="col-md-4 col-6">
                    <div class="route-item">
                        <i class="fas fa-plane-departure text-primary me-2"></i>
                        <strong>Kolkata (CCU)</strong> - Netaji Subhas Chandra Bose International Airport
                    </div>
                </div>
                <div class="col-md-4 col-6">
                    <div class="route-item">
                        <i class="fas fa-plane-departure text-primary me-2"></i>
                        <strong>Hyderabad (HYD)</strong> - Rajiv Gandhi International Airport
                    </div>
                </div>
                <div class="col-md-4 col-6">
                    <div class="route-item">
                        <i class="fas fa-plane-departure text-primary me-2"></i>
                        <strong>Pune (PNQ)</strong> - Pune Airport
                    </div>
                </div>
                <div class="col-md-4 col-6">
                    <div class="route-item">
                        <i class="fas fa-plane-departure text-primary me-2"></i>
                        <strong>Goa (GOI)</strong> - Goa International Airport
                    </div>
                </div>
                <div class="col-md-4 col-6">
                    <div class="route-item">
                        <i class="fas fa-plane-departure text-primary me-2"></i>
                        <strong>Ahmedabad (AMD)</strong> - Sardar Vallabhbhai Patel International Airport
                    </div>
                </div>
                <div class="col-md-4 col-6">
                    <div class="route-item">
                        <i class="fas fa-plane-departure text-primary me-2"></i>
                        <strong>Kochi (COK)</strong> - Cochin International Airport
                    </div>
                </div>
                <div class="col-md-4 col-6">
                    <div class="route-item">
                        <i class="fas fa-plane-departure text-primary me-2"></i>
                        <strong>Jaipur (JAI)</strong> - Jaipur International Airport
                    </div>
                </div>
                <div class="col-md-4 col-6">
                    <div class="route-item">
                        <i class="fas fa-plane-departure text-primary me-2"></i>
                        <strong>Lucknow (LKO)</strong> - Chaudhary Charan Singh International Airport
                    </div>
                </div>
            </div>

            <div class="mb-5">
                <h2 class="section-title text-center mb-4">International Airports</h2>
                <p class="text-center lead mb-5">Connect to major international destinations worldwide</p>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-4 col-6">
                    <div class="route-item">
                        <i class="fas fa-globe text-primary me-2"></i>
                        <strong>Dubai (DXB)</strong> - Dubai International Airport
                    </div>
                </div>
                <div class="col-md-4 col-6">
                    <div class="route-item">
                        <i class="fas fa-globe text-primary me-2"></i>
                        <strong>Singapore (SIN)</strong> - Singapore Changi Airport
                    </div>
                </div>
                <div class="col-md-4 col-6">
                    <div class="route-item">
                        <i class="fas fa-globe text-primary me-2"></i>
                        <strong>Bangkok (BKK)</strong> - Suvarnabhumi Airport
                    </div>
                </div>
                <div class="col-md-4 col-6">
                    <div class="route-item">
                        <i class="fas fa-globe text-primary me-2"></i>
                        <strong>London (LHR)</strong> - London Heathrow Airport
                    </div>
                </div>
                <div class="col-md-4 col-6">
                    <div class="route-item">
                        <i class="fas fa-globe text-primary me-2"></i>
                        <strong>New York (JFK)</strong> - John F. Kennedy International Airport
                    </div>
                </div>
                <div class="col-md-4 col-6">
                    <div class="route-item">
                        <i class="fas fa-globe text-primary me-2"></i>
                        <strong>Paris (CDG)</strong> - Charles de Gaulle Airport
                    </div>
                </div>
                <div class="col-md-4 col-6">
                    <div class="route-item">
                        <i class="fas fa-globe text-primary me-2"></i>
                        <strong>Frankfurt (FRA)</strong> - Frankfurt Airport
                    </div>
                </div>
                <div class="col-md-4 col-6">
                    <div class="route-item">
                        <i class="fas fa-globe text-primary me-2"></i>
                        <strong>Sydney (SYD)</strong> - Sydney Kingsford Smith Airport
                    </div>
                </div>
                <div class="col-md-4 col-6">
                    <div class="route-item">
                        <i class="fas fa-globe text-primary me-2"></i>
                        <strong>Tokyo (NRT)</strong> - Narita International Airport
                    </div>
                </div>
            </div>

            <div class="alert alert-info text-center">
                <h5><i class="fas fa-info-circle me-2"></i>Comprehensive Coverage</h5>
                <p class="mb-0">We provide group booking services from hundreds of airports worldwide. The above list represents major airports. For specific airport availability, please contact our booking team.</p>
            </div>

            <div class="text-center mt-5">
                <h4>Need Group Booking from a Specific Airport?</h4>
                <p>Contact us to check availability and get the best group rates from your preferred airport.</p>
                <a href="{{ route('group-booking.index') }}" class="btn btn-primary me-2">Request Quote</a>
                <a href="{{ route('contact') }}" class="btn btn-outline-primary">Contact Us</a>
            </div>
        </div>
    </section>
@endsection

