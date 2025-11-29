@extends('layouts.app')

@section('title', $post->meta_title ?? $post->title . ' - ' . config('site.name'))

@section('meta')
    <meta name="description" content="{{ $post->meta_description ?? Str::limit(strip_tags($post->content), 160) }}">
    @if($post->featured_image)
        <meta property="og:image" content="{{ asset('storage/' . $post->featured_image) }}">
    @endif
@endsection

@section('content')
<!-- Page Header -->
<section class="page-header text-white py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                @if($post->category)
                    <a href="{{ route('blog.category', $post->category->slug) }}" class="badge bg-light text-dark text-decoration-none mb-3">
                        {{ $post->category->name }}
                    </a>
                @endif
                <h1 class="display-4 fw-bold mb-3">{{ $post->title }}</h1>
                <p class="lead mb-0">
                    <i class="fas fa-calendar me-2"></i>{{ $post->published_at->format('F d, Y') }}
                    <span class="ms-3"><i class="fas fa-user me-2"></i>{{ $post->author->name }}</span>
                    <span class="ms-3"><i class="fas fa-eye me-2"></i>{{ $post->views_count }} views</span>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Blog Post Content -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <article class="card shadow-sm border-0 mb-4">
                    @if($post->featured_image)
                        <img src="{{ asset('storage/' . $post->featured_image) }}" class="card-img-top" alt="{{ $post->title }}" style="max-height: 500px; object-fit: cover;">
                    @endif
                    <div class="card-body p-4">
                        @if($post->excerpt)
                            <div class="lead text-muted mb-4">{{ $post->excerpt }}</div>
                        @endif

                        <div class="post-content">
                            {!! $post->content !!}
                        </div>

                        @if($post->tags->count() > 0)
                            <div class="mt-4 pt-4 border-top">
                                <h6 class="mb-3"><i class="fas fa-tags me-2"></i>Tags:</h6>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($post->tags as $tag)
                                        <a href="{{ route('blog.tag', $tag->slug) }}" class="badge bg-primary text-decoration-none p-2">
                                            #{{ $tag->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Share Buttons -->
                        <div class="mt-4 pt-4 border-top">
                            <h6 class="mb-3"><i class="fas fa-share-alt me-2"></i>Share this article:</h6>
                            <div class="d-flex gap-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="btn btn-sm btn-primary">
                                    <i class="fab fa-facebook me-1"></i> Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($post->title) }}" target="_blank" class="btn btn-sm btn-info text-white">
                                    <i class="fab fa-twitter me-1"></i> Twitter
                                </a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}&title={{ urlencode($post->title) }}" target="_blank" class="btn btn-sm btn-primary" style="background-color: #0077b5;">
                                    <i class="fab fa-linkedin me-1"></i> LinkedIn
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . request()->fullUrl()) }}" target="_blank" class="btn btn-sm btn-success">
                                    <i class="fab fa-whatsapp me-1"></i> WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Related Posts -->
                @if($relatedPosts->count() > 0)
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-bookmark me-2"></i>Related Articles</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($relatedPosts as $relatedPost)
                                    <div class="col-md-4 mb-3">
                                        <div class="d-flex">
                                            @if($relatedPost->featured_image)
                                                <img src="{{ asset('storage/' . $relatedPost->featured_image) }}" alt="{{ $relatedPost->title }}" class="rounded me-3" style="width: 100px; height: 100px; object-fit: cover;">
                                            @endif
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1">
                                                    <a href="{{ route('blog.show', $relatedPost->slug) }}" class="text-dark text-decoration-none">
                                                        {{ Str::limit($relatedPost->title, 60) }}
                                                    </a>
                                                </h6>
                                                <small class="text-muted">{{ $relatedPost->published_at->format('M d, Y') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Navigation -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('blog.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Blog
                    </a>
                </div>
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
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
.post-content {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #333;
}

.post-content h1, .post-content h2, .post-content h3 {
    margin-top: 2rem;
    margin-bottom: 1rem;
    font-weight: 600;
}

.post-content img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 1.5rem 0;
}

.post-content p {
    margin-bottom: 1.5rem;
}

.post-content ul, .post-content ol {
    margin-bottom: 1.5rem;
    padding-left: 2rem;
}

.post-content blockquote {
    border-left: 4px solid #667eea;
    padding-left: 1.5rem;
    margin: 1.5rem 0;
    font-style: italic;
    color: #666;
}

.post-content code {
    background-color: #f4f4f4;
    padding: 2px 6px;
    border-radius: 3px;
    font-family: 'Courier New', monospace;
}

.post-content pre {
    background-color: #f4f4f4;
    padding: 1rem;
    border-radius: 5px;
    overflow-x: auto;
    margin: 1.5rem 0;
}

.page-header {
    position: relative;
    overflow: hidden;
}
</style>
@endpush

