@extends('layouts.app')

@section('title', 'Blog - ' . config('site.name'))

@section('content')
    <!-- Page Header -->
    <section class="page-header text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="display-4 fw-bold mb-3">Travel Blog</h1>
                    <p class="lead">Tips, guides, and insights for your group travel</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Content -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="mb-5">
                        <h2 class="section-title mb-4">Latest Articles</h2>
                    </div>

                    <!-- Blog Post 1 -->
                    <article class="mb-5">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title mb-3">10 Tips for Planning the Perfect Group Trip</h3>
                                <p class="text-muted mb-3">
                                    <i class="fas fa-calendar me-2"></i>Published: {{ date('F d, Y', strtotime('-5 days')) }}
                                    <span class="ms-3"><i class="fas fa-user me-2"></i>By {{ config('site.name') }} Team</span>
                                </p>
                                <p class="card-text">Planning a group trip can be challenging, but with the right approach, it can be an amazing experience. Here are our top 10 tips to help you plan the perfect group vacation...</p>
                                <a href="#" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </article>

                    <!-- Blog Post 2 -->
                    <article class="mb-5">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title mb-3">How to Get the Best Group Flight Deals</h3>
                                <p class="text-muted mb-3">
                                    <i class="fas fa-calendar me-2"></i>Published: {{ date('F d, Y', strtotime('-12 days')) }}
                                    <span class="ms-3"><i class="fas fa-user me-2"></i>By {{ config('site.name') }} Team</span>
                                </p>
                                <p class="card-text">Group travel offers significant savings opportunities. Learn how to maximize your budget and get the best deals on group flights for your next trip...</p>
                                <a href="#" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </article>

                    <!-- Blog Post 3 -->
                    <article class="mb-5">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title mb-3">Top Destinations for Group Travel in 2025</h3>
                                <p class="text-muted mb-3">
                                    <i class="fas fa-calendar me-2"></i>Published: {{ date('F d, Y', strtotime('-20 days')) }}
                                    <span class="ms-3"><i class="fas fa-user me-2"></i>By {{ config('site.name') }} Team</span>
                                </p>
                                <p class="card-text">Discover the most popular destinations for group travel this year. From cultural tours to adventure trips, find the perfect destination for your group...</p>
                                <a href="#" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </article>

                    <!-- Blog Post 4 -->
                    <article class="mb-5">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title mb-3">Corporate Travel Management: Best Practices</h3>
                                <p class="text-muted mb-3">
                                    <i class="fas fa-calendar me-2"></i>Published: {{ date('F d, Y', strtotime('-28 days')) }}
                                    <span class="ms-3"><i class="fas fa-user me-2"></i>By {{ config('site.name') }} Team</span>
                                </p>
                                <p class="card-text">Managing corporate travel efficiently requires planning and the right tools. Learn best practices for managing business group travel and conferences...</p>
                                <a href="#" class="btn btn-primary">Read More</a>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="mb-4">
                        <h4 class="mb-3">Categories</h4>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="#" class="footer-link"><i class="fas fa-arrow-right me-2"></i>Group Travel Tips</a></li>
                            <li class="mb-2"><a href="#" class="footer-link"><i class="fas fa-arrow-right me-2"></i>Destination Guides</a></li>
                            <li class="mb-2"><a href="#" class="footer-link"><i class="fas fa-arrow-right me-2"></i>Travel Deals</a></li>
                            <li class="mb-2"><a href="#" class="footer-link"><i class="fas fa-arrow-right me-2"></i>Corporate Travel</a></li>
                            <li class="mb-2"><a href="#" class="footer-link"><i class="fas fa-arrow-right me-2"></i>Travel News</a></li>
                        </ul>
                    </div>

                    <div class="mb-4">
                        <h4 class="mb-3">Popular Posts</h4>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <a href="#" class="footer-link">
                                    <strong>Planning a Group Trip? Here's What You Need to Know</strong>
                                    <br><small class="text-muted">Published 2 weeks ago</small>
                                </a>
                            </li>
                            <li class="mb-3">
                                <a href="#" class="footer-link">
                                    <strong>Save Money on Group Flights: Insider Tips</strong>
                                    <br><small class="text-muted">Published 1 month ago</small>
                                </a>
                            </li>
                            <li class="mb-3">
                                <a href="#" class="footer-link">
                                    <strong>Best Time to Book Group Travel</strong>
                                    <br><small class="text-muted">Published 2 months ago</small>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Subscribe to Our Newsletter</h5>
                            <p class="card-text">Get the latest travel tips, deals, and destination guides delivered to your inbox.</p>
                            <form>
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Enter your email">
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

