@extends('layouts.app')

@section('title', 'Terms & Conditions - ' . config('site.name'))

@section('content')
    <!-- Page Header -->
    <section class="page-header text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="display-4 fw-bold mb-3">Terms & Conditions</h1>
                    <p class="lead">Please read our terms and conditions carefully</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Terms Content -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="mb-4">
                        <h3 class="mb-3">1. Acceptance of Terms</h3>
                        <p>By accessing and using {{ config('site.name') }} services, you accept and agree to be bound by the terms and provision of this agreement.</p>
                    </div>

                    <div class="mb-4">
                        <h3 class="mb-3">2. Booking Terms</h3>
                        <ul>
                            <li>All bookings are subject to availability and confirmation by the airline.</li>
                            <li>Group bookings require a minimum number of passengers as specified at the time of booking.</li>
                            <li>Fares are subject to change until payment is confirmed.</li>
                            <li>All prices are quoted in the currency specified and are inclusive of applicable taxes unless stated otherwise.</li>
                        </ul>
                    </div>

                    <div class="mb-4">
                        <h3 class="mb-3">3. Payment Terms</h3>
                        <ul>
                            <li>Payment must be made as per the schedule agreed upon at the time of booking.</li>
                            <li>We accept various payment methods including credit/debit cards, bank transfers, and other approved methods.</li>
                            <li>Full payment is required before ticket issuance for most bookings.</li>
                            <li>Group bookings may have different payment terms as agreed in writing.</li>
                        </ul>
                    </div>

                    <div class="mb-4">
                        <h3 class="mb-3">4. Cancellation and Refund Policy</h3>
                        <ul>
                            <li>Cancellation charges apply as per airline policies and fare rules.</li>
                            <li>Refunds, if applicable, will be processed within 7-14 business days.</li>
                            <li>Service fees and processing charges are non-refundable.</li>
                            <li>No-show passengers are not eligible for refunds.</li>
                        </ul>
                    </div>

                    <div class="mb-4">
                        <h3 class="mb-3">5. Changes and Modifications</h3>
                        <ul>
                            <li>Date changes and modifications are subject to airline policies and availability.</li>
                            <li>Change fees and fare differences may apply.</li>
                            <li>Name changes are generally not permitted by airlines.</li>
                            <li>All change requests must be made through our customer service team.</li>
                        </ul>
                    </div>

                    <div class="mb-4">
                        <h3 class="mb-3">6. Travel Documents</h3>
                        <ul>
                            <li>Passengers are responsible for ensuring they have valid travel documents including passports, visas, and health certificates.</li>
                            <li>{{ config('site.name') }} is not responsible for visa rejections or travel document issues.</li>
                            <li>It is the passenger's responsibility to check entry requirements for their destination.</li>
                        </ul>
                    </div>

                    <div class="mb-4">
                        <h3 class="mb-3">7. Liability</h3>
                        <ul>
                            <li>{{ config('site.name') }} acts as an intermediary between passengers and airlines.</li>
                            <li>We are not liable for airline delays, cancellations, or service issues.</li>
                            <li>Our liability is limited to the service fees charged for booking facilitation.</li>
                            <li>Passengers are advised to purchase travel insurance for comprehensive coverage.</li>
                        </ul>
                    </div>

                    <div class="mb-4">
                        <h3 class="mb-3">8. Privacy and Data Protection</h3>
                        <p>Your personal information is protected as per our Privacy Policy. By using our services, you consent to the collection and use of information as described in our Privacy Policy.</p>
                    </div>

                    <div class="mb-4">
                        <h3 class="mb-3">9. Contact Information</h3>
                        <p>For any queries regarding these terms and conditions, please contact us at:</p>
                        <p>
                            <strong>Email:</strong> {{ config('site.contact.email', 'Groups@AirRj.com') }}<br>
                            <strong>Phone:</strong> {{ config('site.contact.phone_display', '+91 78388 48340') }}
                        </p>
                    </div>

                    <div class="mb-4">
                        <p class="text-muted"><small>Last updated: {{ date('F Y') }}</small></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

