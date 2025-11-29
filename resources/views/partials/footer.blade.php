<!-- Footer -->
<footer class="footer py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                <h5 class="mb-3 fw-bold">Group Booking</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('group-booking.index') }}" class="footer-link">Bulk Air Tickets</a></li>
                    <li class="mb-2"><a href="{{ route('group-booking.index') }}#domestic" class="footer-link">Domestic Airport</a></li>
                    <li class="mb-2"><a href="{{ route('group-booking.index') }}#international" class="footer-link">International Airport</a></li>
                    <li class="mb-2"><a href="{{ route('group-booking.index') }}" class="footer-link">Sectors We Reach</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                <h5 class="mb-3 fw-bold">Company</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('about') }}" class="footer-link">About Us</a></li>
                    <li class="mb-2"><a href="{{ route('payment-options') }}" class="footer-link">Payment Options</a></li>
                    <li class="mb-2"><a href="{{ route('finance-payment') }}" class="footer-link">Finance & Payment</a></li>
                    <li class="mb-2"><a href="{{ route('contact') }}" class="footer-link">Customer Service</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                <h5 class="mb-3 fw-bold">Quick Links</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('terms') }}" class="footer-link">Terms & Conditions</a></li>
                    <li class="mb-2"><a href="{{ route('privacy') }}" class="footer-link">Privacy Policy</a></li>
                    <li class="mb-2"><a href="{{ route('faqs') }}" class="footer-link">FAQs</a></li>
                    <li class="mb-2"><a href="{{ route('contact') }}" class="footer-link">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
                <h5 class="mb-3 fw-bold">More</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ route('group-booking.index') }}" class="footer-link">Benefits</a></li>
                    <li class="mb-2"><a href="{{ route('airlines') }}" class="footer-link">Airlines</a></li>
                    <li class="mb-2"><a href="{{ route('airports') }}" class="footer-link">Airports</a></li>
                    <li class="mb-2"><a href="{{ route('blog') }}" class="footer-link">Blog</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 mb-4">
                <h5 class="mb-3 fw-bold">Contact Info</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <strong>Email:</strong> 
                        <a href="mailto:{{ config('site.contact.email', 'Groups@AirRj.com') }}" class="footer-link">{{ config('site.contact.email', 'Groups@AirRj.com') }}</a>
                    </li>
                    <li class="mb-2">
                        <strong>Call us:</strong> 
                        <a href="tel:{{ config('site.contact.phone', '+917838848340') }}" class="footer-link">{{ config('site.contact.phone_display', '+91 78388 48340') }}</a>
                    </li>
                    <li class="mb-2">
                        <a href="tel:{{ config('site.contact.phone', '+917838848340') }}" class="footer-link">{{ config('site.contact.phone_display', '+91 78388 48340') }}</a>
                    </li>
                    <li class="mb-2">
                        {{ config('site.contact.address', '4th Floor. 96A, BLOCK-B, Sector 13, Dwarka, New Delhi, Delhi, 110078') }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">
                        Copyright © {{ date('Y') }}. All Rights Reserved, 
                        <span class="footer-brand">{{ config('site.name', 'AirRj.Com') }} (FAREHAWKER FLIGHT SERVICES LLP)</span>
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="social-links-footer">
                        <a href="{{ config('site.social.facebook', '#') }}" class="social-icon" target="_blank" rel="noopener" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="{{ config('site.social.twitter', '#') }}" class="social-icon" target="_blank" rel="noopener" aria-label="X (Twitter)">
                            <i class="fab fa-x-twitter"></i>
                        </a>
                        <a href="{{ config('site.social.instagram', '#') }}" class="social-icon" target="_blank" rel="noopener" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="{{ config('site.social.linkedin', '#') }}" class="social-icon" target="_blank" rel="noopener" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="{{ config('site.social.pinterest', '#') }}" class="social-icon" target="_blank" rel="noopener" aria-label="Pinterest">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

