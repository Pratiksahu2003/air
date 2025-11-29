@extends('layouts.app')

@section('title', 'Blog - ' . config('site.name'))

@section('content')
<!-- Page Header -->
<section class="page-header text-white py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="display-4 fw-bold mb-3">Travel Blog</h1>
                <p class="lead">Discover travel tips, guides, and insights for your group travel adventures</p>
            </div>
        </div>
    </div>
</section>

<!-- Blog Content -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Search Bar -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('blog.index') }}" method="GET" class="d-flex">
                            <input type="text" name="search" class="form-control me-2" placeholder="Search articles..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>

                @if(isset($category))
                    <div class="alert alert-info mb-4">
                        <h5 class="mb-0">Category: <strong>{{ $category->name }}</strong></h5>
                        <a href="{{ route('blog.index') }}" class="btn btn-sm btn-outline-primary mt-2">View All Posts</a>
                    </div>
                @endif

                @if(isset($tag))
                    <div class="alert alert-info mb-4">
                        <h5 class="mb-0">Tag: <strong>{{ $tag->name }}</strong></h5>
                        <a href="{{ route('blog.index') }}" class="btn btn-sm btn-outline-primary mt-2">View All Posts</a>
                    </div>
                @endif

                @if($posts->count() > 0)
                    <div class="row">
                        @foreach($posts as $post)
                            <div class="col-md-6 mb-4">
                                <article class="card h-100 shadow-sm border-0 blog-card">
                                        @if($post->featured_image)
                                            <a href="{{ route('blog.show', $post->slug) }}">
                                                <img src="{{ asset('storage/' . $post->featured_image) }}" class="card-img-top" alt="{{ $post->title }}" style="height: 200px; object-fit: cover;">
                                            </a>
                                        @endif
                                    <div class="card-body">
                                        @if($post->category)
                                            <a href="{{ route('blog.category', $post->category->slug) }}" class="badge bg-primary text-decoration-none mb-2">
                                                {{ $post->category->name }}
                                            </a>
                                        @endif
                                        <h3 class="card-title h5">
                                            <a href="{{ route('blog.show', $post->slug) }}" class="text-dark text-decoration-none">
                                                {{ $post->title }}
                                            </a>
                                        </h3>
                                        <p class="text-muted small mb-2">
                                            <i class="fas fa-calendar me-1"></i>{{ $post->published_at->format('M d, Y') }}
                                            <span class="ms-3"><i class="fas fa-user me-1"></i>{{ $post->author->name }}</span>
                                            <span class="ms-3"><i class="fas fa-eye me-1"></i>{{ $post->views_count }} views</span>
                                        </p>
                                        @if($post->excerpt)
                                            <p class="card-text">{{ Str::limit($post->excerpt, 120) }}</p>
                                        @else
                                            <p class="card-text">{{ Str::limit(strip_tags($post->content), 120) }}</p>
                                        @endif
                                        @if($post->tags->count() > 0)
                                            <div class="mb-2">
                                                @foreach($post->tags->take(3) as $tag)
                                                    <a href="{{ route('blog.tag', $tag->slug) }}" class="badge bg-light text-dark text-decoration-none me-1">
                                                        #{{ $tag->name }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        @endif
                                        <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-sm btn-primary">
                                            Read More <i class="fas fa-arrow-right ms-1"></i>
                                        </a>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4">
                        {{ $posts->links() }}
                    </div>
                @else
                    <div class="card shadow-sm">
                        <div class="card-body text-center py-5">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <h4>No posts found</h4>
                            <p class="text-muted">Check back later for new articles!</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Categories -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-folder me-2"></i>Categories</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <a href="{{ route('blog.index') }}" class="text-decoration-none d-flex justify-content-between align-items-center">
                                    <span>All Posts</span>
                                    <span class="badge bg-primary">{{ \App\Models\Post::published()->count() }}</span>
                                </a>
                            </li>
                            @foreach($categories as $cat)
                                <li class="mb-2">
                                    <a href="{{ route('blog.category', $cat->slug) }}" class="text-decoration-none d-flex justify-content-between align-items-center">
                                        <span>{{ $cat->name }}</span>
                                        <span class="badge bg-secondary">{{ $cat->posts_count }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Recent Posts -->
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Recent Posts</h5>
                    </div>
                    <div class="card-body">
                        @foreach($recentPosts as $recentPost)
                            <div class="d-flex mb-3 pb-3 border-bottom">
                                @if($recentPost->featured_image)
                                    <img src="{{ asset('storage/' . $recentPost->featured_image) }}" alt="{{ $recentPost->title }}" class="rounded me-3" style="width: 80px; height: 80px; object-fit: cover;">
                                @endif
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">
                                        <a href="{{ route('blog.show', $recentPost->slug) }}" class="text-dark text-decoration-none">
                                            {{ Str::limit($recentPost->title, 50) }}
                                        </a>
                                    </h6>
                                    <small class="text-muted">{{ $recentPost->published_at->format('M d, Y') }}</small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Popular Tags -->
                @if($tags->count() > 0)
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-tags me-2"></i>Popular Tags</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($tags as $tag)
                                    <a href="{{ route('blog.tag', $tag->slug) }}" class="badge bg-light text-dark text-decoration-none p-2">
                                        #{{ $tag->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
.blog-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.blog-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

.blog-card .card-img-top {
    transition: transform 0.3s ease;
}

.blog-card:hover .card-img-top {
    transform: scale(1.05);
}

.page-header {
    position: relative;
    overflow: hidden;
}
</style>
@endpush

