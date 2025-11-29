@extends('layouts.app')

@section('title', 'FAQs - ' . config('site.name'))

@section('content')
    <!-- Page Header -->
    <section class="page-header text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="display-4 fw-bold mb-3">Frequently Asked Questions</h1>
                    <p class="lead">Find answers to common questions about our services</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQs Content -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="accordion" id="faqAccordion">
                        <!-- Booking FAQs -->
                        <div class="mb-3">
                            <h3 class="mb-4">Booking & Reservations</h3>
                            
                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                        How do I make a group booking?
                                    </button>
                                </h2>
                                <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        You can make a group booking by filling out our online form, calling our customer service team, or sending an email. We require a minimum of 10 passengers for group bookings to qualify for special group fares.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                        What is the minimum number of passengers for group bookings?
                                    </button>
                                </h2>
                                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        The minimum number of passengers for group bookings is typically 10. However, some airlines may offer group rates for smaller groups. Please contact us for specific requirements.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                        How far in advance should I book group flights?
                                    </button>
                                </h2>
                                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        We recommend booking group flights at least 30-60 days in advance to secure the best rates and availability. For peak travel seasons, booking 90 days or more in advance is advisable.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Payment FAQs -->
                        <div class="mb-3">
                            <h3 class="mb-4">Payment & Pricing</h3>
                            
                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                        What payment methods do you accept?
                                    </button>
                                </h2>
                                <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        We accept various payment methods including credit cards, debit cards, bank transfers, UPI, and other approved payment gateways. For large group bookings, we also offer flexible payment plans.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                        Are the prices on your website final?
                                    </button>
                                </h2>
                                <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Prices are subject to change until payment is confirmed. Group booking prices are quoted based on availability and may vary. Final pricing will be confirmed upon booking confirmation.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq6">
                                        Do you offer payment plans for group bookings?
                                    </button>
                                </h2>
                                <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Yes, we offer flexible payment plans for group bookings. Payment schedules can be customized based on your requirements and the size of your group. Please contact us to discuss payment options.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Cancellation FAQs -->
                        <div class="mb-3">
                            <h3 class="mb-4">Cancellation & Changes</h3>
                            
                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq7">
                                        What is your cancellation policy?
                                    </button>
                                </h2>
                                <div id="faq7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Cancellation policies vary by airline and fare type. Generally, cancellation charges apply as per airline policies. Refunds, if applicable, are processed within 7-14 business days. Service fees are non-refundable.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq8">
                                        Can I change my travel dates?
                                    </button>
                                </h2>
                                <div id="faq8" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Date changes are subject to airline policies and availability. Change fees and fare differences may apply. Please contact our customer service team to request changes to your booking.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq9">
                                        Can I change passenger names on a booking?
                                    </button>
                                </h2>
                                <div id="faq9" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        Most airlines do not allow name changes on tickets. If you need to change a passenger name, you may need to cancel and rebook, which may incur charges. Please contact us for assistance.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- General FAQs -->
                        <div class="mb-3">
                            <h3 class="mb-4">General Information</h3>
                            
                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq10">
                                        Do you provide travel insurance?
                                    </button>
                                </h2>
                                <div id="faq10" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        We recommend purchasing travel insurance for comprehensive coverage. We can assist you in obtaining travel insurance through our partners. Please inquire during booking.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq11">
                                        What documents do I need for travel?
                                    </button>
                                </h2>
                                <div id="faq11" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        You need a valid passport, visa (if required), and any health certificates mandated by your destination. It is your responsibility to ensure all travel documents are valid. We recommend checking entry requirements well in advance.
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq12">
                                        How can I contact customer service?
                                    </button>
                                </h2>
                                <div id="faq12" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        You can reach us via phone at {{ config('site.contact.phone_display', '+91 78388 48340') }}, email at {{ config('site.contact.email', 'Groups@AirRj.com') }}, or through our contact form. Our customer service team is available 24/7 to assist you.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 text-center">
                        <h4>Still have questions?</h4>
                        <p>If you couldn't find the answer you're looking for, please don't hesitate to contact us.</p>
                        <a href="{{ route('contact') }}" class="btn btn-primary">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

