@extends('layouts.app')

@section('title', 'Payment Options - ' . config('site.name'))

@section('content')
    <!-- Page Header -->
    <section class="page-header text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="display-4 fw-bold mb-3">Payment Options</h1>
                    <p class="lead">Secure and convenient payment methods for your bookings</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Payment Options Content -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="mb-5">
                        <h2 class="section-title mb-4">Accepted Payment Methods</h2>
                        <p class="lead">We offer multiple secure payment options to make your booking process convenient and hassle-free.</p>
                    </div>

                    <div class="row g-4 mb-5">
                        <div class="col-md-6">
                            <div class="service-card h-100">
                                <div class="service-icon">
                                    <i class="fas fa-credit-card fa-3x text-primary"></i>
                                </div>
                                <h5>Credit & Debit Cards</h5>
                                <p>We accept all major credit and debit cards including Visa, Mastercard, American Express, and RuPay. All transactions are secured with SSL encryption.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="service-card h-100">
                                <div class="service-icon">
                                    <i class="fas fa-mobile-alt fa-3x text-primary"></i>
                                </div>
                                <h5>UPI & Digital Wallets</h5>
                                <p>Pay conveniently using UPI, Google Pay, PhonePe, Paytm, and other popular digital wallets for instant payment processing.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="service-card h-100">
                                <div class="service-icon">
                                    <i class="fas fa-university fa-3x text-primary"></i>
                                </div>
                                <h5>Net Banking</h5>
                                <p>Secure online banking transfers from all major banks in India. Select your bank and complete payment through their secure gateway.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="service-card h-100">
                                <div class="service-icon">
                                    <i class="fas fa-file-invoice fa-3x text-primary"></i>
                                </div>
                                <h5>Bank Transfer</h5>
                                <p>For large group bookings, we accept direct bank transfers. Contact us for bank details and payment instructions.</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-5">
                        <h3 class="mb-4">Payment Security</h3>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-shield-alt fa-2x text-primary me-3"></i>
                                    <div>
                                        <h5>SSL Encryption</h5>
                                        <p>All payment transactions are protected with industry-standard SSL encryption to ensure your financial information remains secure.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex align-items-start">
                                    <i class="fas fa-lock fa-2x text-primary me-3"></i>
                                    <div>
                                        <h5>PCI DSS Compliant</h5>
                                        <p>We comply with Payment Card Industry Data Security Standards to protect cardholder information.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-5">
                        <h3 class="mb-4">Group Booking Payment Plans</h3>
                        <p>For group bookings, we offer flexible payment plans tailored to your needs:</p>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Initial deposit to secure booking</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Installment payments as per agreed schedule</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Final payment before ticket issuance</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Customized payment terms for large groups</li>
                        </ul>
                    </div>

                    <div class="alert alert-info">
                        <h5><i class="fas fa-info-circle me-2"></i>Important Notes</h5>
                        <ul class="mb-0">
                            <li>All prices are in Indian Rupees (INR) unless otherwise stated</li>
                            <li>Payment must be completed as per the schedule agreed at booking</li>
                            <li>Tickets will be issued only after full payment confirmation</li>
                            <li>Service charges and processing fees are non-refundable</li>
                        </ul>
                    </div>

                    <div class="text-center mt-5">
                        <h4>Need Help with Payment?</h4>
                        <p>Our customer service team is available 24/7 to assist you with payment-related queries.</p>
                        <a href="{{ route('contact') }}" class="btn btn-primary">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

