@extends('layouts.app')

@section('title', 'Contact Us - ' . config('site.name'))

@section('content')
    <!-- Page Header / Hero Section -->
    <section class="page-header position-relative" style="min-height: 500px; overflow: hidden;">
        <!-- Background Image with Overlay -->
        <div class="position-absolute w-100 h-100" style="top: 0; left: 0; z-index: 0;">
            <img src="{{ asset('Banner/b2.png') }}" alt="Contact Us Banner" class="w-100 h-100" style="object-fit: cover; transform: scale(1.05); transition: transform 0.3s ease;">
            <div class="position-absolute w-100 h-100" style="background: linear-gradient(135deg, rgba(13, 110, 253, 0.85) 0%, rgba(0, 0, 0, 0.4) 100%); top: 0; left: 0;"></div>
        </div>
        
        <!-- Content -->
        <div class="position-relative" style="z-index: 1; min-height: 500px; display: flex; align-items: center; padding: 80px 0;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 text-white">
                        <div class="hero-content" style="animation: fadeInUp 0.8s ease-out;">
                            <span class="badge bg-light text-primary px-3 py-2 mb-3 d-inline-block" style="font-size: 0.9rem; font-weight: 600; letter-spacing: 0.5px;">
                                <i class="fas fa-headset me-2"></i>24/7 Support Available
                            </span>
                            <h1 class="display-3 fw-bold mb-4" style="text-shadow: 2px 4px 8px rgba(0,0,0,0.3); line-height: 1.2; animation: fadeInUp 0.8s ease-out 0.2s both;">
                                Contact Us
                            </h1>
                            <p class="lead mb-4" style="text-shadow: 1px 2px 4px rgba(0,0,0,0.3); font-size: 1.25rem; animation: fadeInUp 0.8s ease-out 0.4s both;">
                                Get in touch with our team for group booking inquiries. We're here to help you plan your perfect journey.
                            </p>
                            <div class="hero-features mt-4" style="animation: fadeInUp 0.8s ease-out 0.6s both;">
                                <div class="d-flex flex-wrap gap-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-check-circle text-warning me-2" style="font-size: 1.2rem;"></i>
                                        <span style="text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">Quick Response</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-check-circle text-warning me-2" style="font-size: 1.2rem;"></i>
                                        <span style="text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">Expert Support</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-check-circle text-warning me-2" style="font-size: 1.2rem;"></i>
                                        <span style="text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">Best Deals</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 text-center text-white mt-5 mt-lg-0">
                        <div class="hero-stats" style="animation: fadeInRight 0.8s ease-out 0.8s both;">
                            <div class="row g-4">
                                <div class="col-6">
                                    <div class="p-3 rounded" style="background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
                                        <i class="fas fa-users fa-2x mb-2 text-warning"></i>
                                        <h3 class="mb-0 fw-bold">10K+</h3>
                                        <small style="opacity: 0.9;">Happy Customers</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-3 rounded" style="background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
                                        <i class="fas fa-plane fa-2x mb-2 text-warning"></i>
                                        <h3 class="mb-0 fw-bold">500+</h3>
                                        <small style="opacity: 0.9;">Destinations</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-3 rounded" style="background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
                                        <i class="fas fa-star fa-2x mb-2 text-warning"></i>
                                        <h3 class="mb-0 fw-bold">4.8/5</h3>
                                        <small style="opacity: 0.9;">Rating</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="p-3 rounded" style="background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
                                        <i class="fas fa-clock fa-2x mb-2 text-warning"></i>
                                        <h3 class="mb-0 fw-bold">24/7</h3>
                                        <small style="opacity: 0.9;">Support</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Decorative Wave -->
        <div class="position-absolute w-100" style="bottom: 0; left: 0; z-index: 2;">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" style="display: block;">
                <path d="M0 120L60 110C120 100 240 80 360 70C480 60 600 60 720 65C840 70 960 80 1080 85C1200 90 1320 90 1380 90L1440 90V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="white"/>
            </svg>
        </div>
    </section>
    
    @push('styles')
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .page-header:hover img {
            transform: scale(1.08);
        }
        
        .hero-stats .rounded {
            transition: all 0.3s ease;
        }
        
        .hero-stats .rounded:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.25) !important;
        }
    </style>
    @endpush

    <!-- Contact Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-4">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-4">
                            <h3 class="card-title mb-3">
                                <i class="fas fa-envelope text-primary me-2"></i>Send us a Message
                            </h3>
                            <p class="text-muted mb-4">Fill out the form below and our team will get back to you shortly.</p>

                            <form id="contactForm" method="post" action="{{ route('contact.submit') }}">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Your Name</label>
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Email</label>
                                        <input type="email" class="form-control" name="email" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Phone</label>
                                        <input type="tel" class="form-control" name="phone" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Subject</label>
                                        <input type="text" class="form-control" name="subject" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold">Message</label>
                                        <textarea class="form-control" name="message" rows="6" required></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            <i class="fas fa-paper-plane me-2"></i>Send Message
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card shadow-lg border-0 h-100">
                        <div class="card-body p-4">
                            <h4 class="mb-4">Contact Information</h4>
                            <div class="contact-info mb-4">
                                <div class="d-flex mb-3">
                                    <div class="contact-icon me-3">
                                        <i class="fas fa-phone fa-2x text-primary"></i>
                                    </div>
                                    <div>
                                        <h6>Phone</h6>
                                        <a href="tel:{{ config('site.contact.phone') }}" class="text-decoration-none">
                                            {{ config('site.contact.phone_display') }}
                                        </a>
                                    </div>
                                </div>
                                <div class="d-flex mb-3">
                                    <div class="contact-icon me-3">
                                        <i class="fas fa-envelope fa-2x text-primary"></i>
                                    </div>
                                    <div>
                                        <h6>Email</h6>
                                        <a href="mailto:{{ config('site.contact.email') }}" class="text-decoration-none">
                                            {{ config('site.contact.email') }}
                                        </a>
                                    </div>
                                </div>
                                <div class="d-flex mb-3">
                                    <div class="contact-icon me-3">
                                        <i class="fas fa-map-marker-alt fa-2x text-primary"></i>
                                    </div>
                                    <div>
                                        <h6>Address</h6>
                                        <p class="mb-0">{{ config('site.contact.address') }}</p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="contact-icon me-3">
                                        <i class="fas fa-clock fa-2x text-primary"></i>
                                    </div>
                                    <div>
                                        <h6>Support Hours</h6>
                                        <p class="mb-0">{{ config('site.contact.support_hours') }}</p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <h5 class="mb-3">Follow Us</h5>
                            <div class="social-links">
                                <a href="{{ config('site.social.facebook') }}" class="btn btn-outline-primary me-2 mb-2">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="{{ config('site.social.twitter') }}" class="btn btn-outline-primary me-2 mb-2">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="{{ config('site.social.instagram') }}" class="btn btn-outline-primary me-2 mb-2">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="{{ config('site.social.linkedin') }}" class="btn btn-outline-primary me-2 mb-2">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="{{ config('site.social.youtube') }}" class="btn btn-outline-primary mb-2">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    @vite(['resources/js/contact.js'])
@endpush