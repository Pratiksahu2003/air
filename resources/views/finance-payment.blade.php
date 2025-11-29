@extends('layouts.app')

@section('title', 'Finance & Payment - ' . config('site.name'))

@section('content')
    <!-- Page Header -->
    <section class="page-header text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="display-4 fw-bold mb-3">Finance & Payment</h1>
                    <p class="lead">Flexible financing solutions for your travel needs</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Finance Content -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="mb-5">
                        <h2 class="section-title mb-4">Flexible Payment Solutions</h2>
                        <p class="lead">We understand that group travel requires careful financial planning. That's why we offer flexible payment solutions tailored to your budget and requirements.</p>
                    </div>

                    <div class="row g-4 mb-5">
                        <div class="col-md-4">
                            <div class="service-card h-100 text-center">
                                <div class="service-icon">
                                    <i class="fas fa-calendar-alt fa-3x text-primary"></i>
                                </div>
                                <h5>Installment Plans</h5>
                                <p>Spread your payment over multiple installments with our flexible payment plans. Perfect for large group bookings.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="service-card h-100 text-center">
                                <div class="service-icon">
                                    <i class="fas fa-handshake fa-3x text-primary"></i>
                                </div>
                                <h5>Corporate Accounts</h5>
                                <p>Special payment terms for corporate clients and travel management companies with credit facilities.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="service-card h-100 text-center">
                                <div class="service-icon">
                                    <i class="fas fa-file-invoice-dollar fa-3x text-primary"></i>
                                </div>
                                <h5>Invoice Billing</h5>
                                <p>Request invoice billing for approved corporate accounts with payment terms as per agreement.</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-5">
                        <h3 class="mb-4">Payment Schedule Options</h3>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Booking Type</th>
                                        <th>Initial Payment</th>
                                        <th>Payment Schedule</th>
                                        <th>Final Payment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Small Groups (10-20)</td>
                                        <td>30%</td>
                                        <td>40% (30 days before)</td>
                                        <td>30% (7 days before)</td>
                                    </tr>
                                    <tr>
                                        <td>Medium Groups (21-50)</td>
                                        <td>25%</td>
                                        <td>50% (45 days before)</td>
                                        <td>25% (14 days before)</td>
                                    </tr>
                                    <tr>
                                        <td>Large Groups (51+)</td>
                                        <td>20%</td>
                                        <td>Customized schedule</td>
                                        <td>As per agreement</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mb-5">
                        <h3 class="mb-4">Corporate Payment Solutions</h3>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <h5><i class="fas fa-building text-primary me-2"></i>Credit Facilities</h5>
                                <p>Approved corporate clients can avail credit facilities with payment terms ranging from 15 to 45 days based on creditworthiness and relationship history.</p>
                            </div>
                            <div class="col-md-6 mb-4">
                                <h5><i class="fas fa-chart-line text-primary me-2"></i>Volume Discounts</h5>
                                <p>Regular corporate clients with high booking volumes may qualify for additional discounts and extended payment terms.</p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-5">
                        <h3 class="mb-4">Payment Terms & Conditions</h3>
                        <ul>
                            <li class="mb-2">All payment plans are subject to approval and agreement</li>
                            <li class="mb-2">Late payment charges may apply for delayed payments</li>
                            <li class="mb-2">Tickets will be issued only after payment confirmation</li>
                            <li class="mb-2">Cancellation charges apply as per airline policies</li>
                            <li class="mb-2">Service fees are non-refundable</li>
                            <li class="mb-2">Payment terms may vary based on airline requirements</li>
                        </ul>
                    </div>

                    <div class="alert alert-warning">
                        <h5><i class="fas fa-exclamation-triangle me-2"></i>Important</h5>
                        <p class="mb-0">Payment schedules are customized based on group size, travel dates, and airline requirements. Please contact our finance team to discuss the best payment plan for your group.</p>
                    </div>

                    <div class="text-center mt-5">
                        <h4>Need Custom Payment Solutions?</h4>
                        <p>Contact our finance team to discuss payment options tailored to your needs.</p>
                        <a href="{{ route('contact') }}" class="btn btn-primary me-2">Contact Finance Team</a>
                        <a href="{{ route('payment-options') }}" class="btn btn-outline-primary">View Payment Methods</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

