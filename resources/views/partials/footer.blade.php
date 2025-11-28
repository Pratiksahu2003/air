<!-- Footer -->
<footer class="footer bg-dark text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="mb-3">
                    <img src="{{ asset(config('site.logo')) }}" alt="{{ config('site.name') }}" class="footer-logo mb-2">
                    <h5 class="text-white">{{ config('site.name') }}</h5>
                </div>
                <p>{{ config('site.description') }}</p>
                <div class="social-links mt-3">
                    <a href="{{ config('site.social.facebook') }}" class="text-white me-3"><i class="fab fa-facebook-f fa-lg"></i></a>
                    <a href="{{ config('site.social.twitter') }}" class="text-white me-3"><i class="fab fa-twitter fa-lg"></i></a>
                    <a href="{{ config('site.social.instagram') }}" class="text-white me-3"><i class="fab fa-instagram fa-lg"></i></a>
                    <a href="{{ config('site.social.linkedin') }}" class="text-white me-3"><i class="fab fa-linkedin-in fa-lg"></i></a>
                    <a href="{{ config('site.social.youtube') }}" class="text-white"><i class="fab fa-youtube fa-lg"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="mb-3">Group Booking</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('group-booking.index') }}" class="text-white-50">Group Flight Booking</a></li>
                    <li><a href="{{ route('group-booking.index') }}#domestic" class="text-white-50">Domestic Group Booking</a></li>
                    <li><a href="{{ route('group-booking.index') }}#international" class="text-white-50">International Group Booking</a></li>
                    <li><a href="{{ route('fix-departure') }}" class="text-white-50">Fix Departure</a></li>
                    <li><a href="{{ route('air-charter') }}" class="text-white-50">Air Charter</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="mb-3">Services</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('services') }}" class="text-white-50">Our Services</a></li>
                    <li><a href="{{ route('mice') }}" class="text-white-50">MICE Solutions</a></li>
                    <li><a href="{{ route('group-booking.index') }}" class="text-white-50">Corporate Travel</a></li>
                    <li><a href="{{ route('group-booking.index') }}" class="text-white-50">Tour Operators</a></li>
                    <li><a href="{{ route('group-booking.index') }}" class="text-white-50">Group Fare Deals</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <h5 class="mb-3">Contact Info</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="fas fa-phone me-2"></i>
                        <a href="tel:{{ config('site.contact.phone') }}" class="text-white-50">{{ config('site.contact.phone') }}</a>
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-envelope me-2"></i>
                        <a href="mailto:{{ config('site.contact.email') }}" class="text-white-50">{{ config('site.contact.email') }}</a>
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        <span class="text-white-50">{{ config('site.contact.address') }}</span>
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-clock me-2"></i>
                        <span class="text-white-50">{{ config('site.contact.support_hours') }}</span>
                    </li>
                </ul>
            </div>
        </div>
        <hr class="my-4 bg-secondary">
        <div class="row">
            <div class="col-md-6">
                <p class="mb-0">&copy; {{ date('Y') }} {{ config('site.name') }}. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="#" class="text-white-50 me-3">Terms of Use</a>
                <a href="#" class="text-white-50 me-3">Privacy Policy</a>
                <a href="{{ route('contact') }}" class="text-white-50">Contact Us</a>
            </div>
        </div>
    </div>
</footer>

