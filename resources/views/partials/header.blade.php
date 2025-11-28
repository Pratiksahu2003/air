<!-- Top Header Bar -->
<header class="top-header bg-primary text-white py-2">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="header-contact">
                    <span class="me-4">
                        <i class="fas fa-phone me-2"></i>
                        <a href="tel:{{ config('site.contact.phone') }}" class="text-white text-decoration-none">{{ config('site.contact.phone_display') }}</a>
                    </span>
                    <span>
                        <i class="fas fa-envelope me-2"></i>
                        <a href="mailto:{{ config('site.contact.email') }}" class="text-white text-decoration-none">{{ config('site.contact.email') }}</a>
                    </span>
                </div>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="header-social">
                    <span class="me-3">Follow Us:</span>
                    <a href="{{ config('site.social.facebook') }}" class="text-white me-2"><i class="fab fa-facebook-f"></i></a>
                    <a href="{{ config('site.social.twitter') }}" class="text-white me-2"><i class="fab fa-twitter"></i></a>
                    <a href="{{ config('site.social.instagram') }}" class="text-white me-2"><i class="fab fa-instagram"></i></a>
                    <a href="{{ config('site.social.linkedin') }}" class="text-white me-2"><i class="fab fa-linkedin-in"></i></a>
                    <a href="{{ config('site.social.youtube') }}" class="text-white"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>
</header>

