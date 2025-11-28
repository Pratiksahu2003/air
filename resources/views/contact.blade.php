@extends('layouts.app')

@section('title', 'Contact Us - ' . config('site.name'))

@section('content')
    <!-- Page Header -->
    <section class="page-header text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="display-4 fw-bold mb-3">Contact Us</h1>
                    <p class="lead">Get in touch with our team for group booking inquiries</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-4">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-4">
                            <h3 class="card-title mb-4">
                                <i class="fas fa-envelope text-primary me-2"></i>Send us a Message
                            </h3>
                            <form id="contactForm">
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
<script>
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Thank you for contacting us! We will get back to you soon.');
        this.reset();
    });
</script>
@endpush

