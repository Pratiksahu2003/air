@extends('layouts.app')

@section('title', 'Privacy Policy - ' . config('site.name'))

@section('content')
    <!-- Page Header -->
    <section class="page-header text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="display-4 fw-bold mb-3">Privacy Policy</h1>
                    <p class="lead">How we collect, use, and protect your information</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Privacy Content -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="mb-4">
                        <h3 class="mb-3">1. Information We Collect</h3>
                        <p>We collect information that you provide directly to us when you:</p>
                        <ul>
                            <li>Make a booking or inquiry</li>
                            <li>Create an account</li>
                            <li>Subscribe to our newsletter</li>
                            <li>Contact our customer service</li>
                            <li>Participate in surveys or promotions</li>
                        </ul>
                        <p>This information may include:</p>
                        <ul>
                            <li>Personal details (name, email, phone number, address)</li>
                            <li>Travel information (passport details, travel dates, destinations)</li>
                            <li>Payment information (credit card details, billing address)</li>
                            <li>Account credentials (username, password)</li>
                        </ul>
                    </div>

                    <div class="mb-4">
                        <h3 class="mb-3">2. How We Use Your Information</h3>
                        <p>We use the information we collect to:</p>
                        <ul>
                            <li>Process and manage your bookings</li>
                            <li>Communicate with you about your bookings and travel arrangements</li>
                            <li>Send you promotional offers and travel updates (with your consent)</li>
                            <li>Improve our services and website functionality</li>
                            <li>Comply with legal obligations and prevent fraud</li>
                            <li>Provide customer support and respond to inquiries</li>
                        </ul>
                    </div>

                    <div class="mb-4">
                        <h3 class="mb-3">3. Information Sharing</h3>
                        <p>We may share your information with:</p>
                        <ul>
                            <li><strong>Airlines and Travel Partners:</strong> To complete your bookings and travel arrangements</li>
                            <li><strong>Payment Processors:</strong> To process payments securely</li>
                            <li><strong>Service Providers:</strong> Third-party companies that help us operate our business</li>
                            <li><strong>Legal Authorities:</strong> When required by law or to protect our rights</li>
                        </ul>
                        <p>We do not sell your personal information to third parties for marketing purposes.</p>
                    </div>

                    <div class="mb-4">
                        <h3 class="mb-3">4. Data Security</h3>
                        <p>We implement appropriate technical and organizational measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction. This includes:</p>
                        <ul>
                            <li>SSL encryption for data transmission</li>
                            <li>Secure servers and databases</li>
                            <li>Regular security audits and updates</li>
                            <li>Access controls and employee training</li>
                        </ul>
                    </div>

                    <div class="mb-4">
                        <h3 class="mb-3">5. Cookies and Tracking</h3>
                        <p>We use cookies and similar tracking technologies to:</p>
                        <ul>
                            <li>Remember your preferences and settings</li>
                            <li>Analyze website traffic and usage patterns</li>
                            <li>Provide personalized content and advertisements</li>
                            <li>Improve user experience</li>
                        </ul>
                        <p>You can control cookies through your browser settings, but this may affect website functionality.</p>
                    </div>

                    <div class="mb-4">
                        <h3 class="mb-3">6. Your Rights</h3>
                        <p>You have the right to:</p>
                        <ul>
                            <li>Access your personal information</li>
                            <li>Correct inaccurate data</li>
                            <li>Request deletion of your data</li>
                            <li>Object to processing of your data</li>
                            <li>Withdraw consent for marketing communications</li>
                            <li>Data portability</li>
                        </ul>
                        <p>To exercise these rights, please contact us using the information provided below.</p>
                    </div>

                    <div class="mb-4">
                        <h3 class="mb-3">7. Data Retention</h3>
                        <p>We retain your personal information for as long as necessary to:</p>
                        <ul>
                            <li>Fulfill the purposes for which it was collected</li>
                            <li>Comply with legal obligations</li>
                            <li>Resolve disputes and enforce agreements</li>
                        </ul>
                        <p>Booking information is typically retained for 7 years as required by law.</p>
                    </div>

                    <div class="mb-4">
                        <h3 class="mb-3">8. Children's Privacy</h3>
                        <p>Our services are not directed to children under 18 years of age. We do not knowingly collect personal information from children. If you believe we have collected information from a child, please contact us immediately.</p>
                    </div>

                    <div class="mb-4">
                        <h3 class="mb-3">9. Changes to Privacy Policy</h3>
                        <p>We may update this Privacy Policy from time to time. We will notify you of any significant changes by posting the new policy on this page and updating the "Last updated" date.</p>
                    </div>

                    <div class="mb-4">
                        <h3 class="mb-3">10. Contact Us</h3>
                        <p>If you have any questions about this Privacy Policy or wish to exercise your rights, please contact us:</p>
                        <p>
                            <strong>Email:</strong> {{ config('site.contact.email', 'Groups@AirRj.com') }}<br>
                            <strong>Phone:</strong> {{ config('site.contact.phone_display', '+91 78388 48340') }}<br>
                            <strong>Address:</strong> {{ config('site.contact.address', '4th Floor. 96A, BLOCK-B, Sector 13, Dwarka, New Delhi, Delhi, 110078') }}
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

