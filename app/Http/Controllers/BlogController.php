<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of blog posts.
     */
    public function index(Request $request)
    {
        $query = Post::published()->with(['category', 'author', 'tags'])
            ->latest();

        // Category filter
        if ($request->has('category') && $request->category) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Tag filter
        if ($request->has('tag') && $request->tag) {
            $query->whereHas('tags', function($q) use ($request) {
                $q->where('slug', $request->tag);
            });
        }

        // Search
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        $posts = $query->paginate(9);
        $categories = Category::where('is_active', true)->withCount('posts')->get();
        $recentPosts = Post::published()->latest()->limit(5)->get();
        $tags = Tag::withCount('posts')->orderBy('posts_count', 'desc')->limit(20)->get();

        return view('blog.index', compact('posts', 'categories', 'recentPosts', 'tags'));
    }

    /**
     * Display the specified blog post.
     */
    public function show($slug)
    {
        $post = Post::published()
            ->with(['category', 'author', 'tags'])
            ->where('slug', $slug)
            ->firstOrFail();

        // Increment views
        $post->incrementViews();

        // Get related posts
        $relatedPosts = Post::published()
            ->where('id', '!=', $post->id)
            ->where(function($query) use ($post) {
                $query->where('category_id', $post->category_id)
                      ->orWhereHas('tags', function($q) use ($post) {
                          $q->whereIn('tags.id', $post->tags->pluck('id'));
                      });
            })
            ->latest()
            ->limit(3)
            ->get();

        // Get recent posts
        $recentPosts = Post::published()
            ->where('id', '!=', $post->id)
            ->latest()
            ->limit(5)
            ->get();

        $categories = Category::where('is_active', true)->withCount('posts')->get();

        return view('blog.show', compact('post', 'relatedPosts', 'recentPosts', 'categories'));
    }

    /**
     * Display posts by category.
     */
    public function category($slug)
    {
        $category = Category::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $posts = Post::published()
            ->where('category_id', $category->id)
            ->with(['author', 'tags'])
            ->latest()
            ->paginate(9);

        $categories = Category::where('is_active', true)->withCount('posts')->get();
        $recentPosts = Post::published()->latest()->limit(5)->get();
        $tags = Tag::withCount('posts')->orderBy('posts_count', 'desc')->limit(20)->get();

        return view('blog.index', compact('posts', 'categories', 'recentPosts', 'tags', 'category'));
    }

    /**
     * Display posts by tag.
     */
    public function tag($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();

        $posts = Post::published()
            ->whereHas('tags', function($query) use ($tag) {
                $query->where('tags.id', $tag->id);
            })
            ->with(['category', 'author', 'tags'])
            ->latest()
            ->paginate(9);

        $categories = Category::where('is_active', true)->withCount('posts')->get();
        $recentPosts = Post::published()->latest()->limit(5)->get();
        $tags = Tag::withCount('posts')->orderBy('posts_count', 'desc')->limit(20)->get();

        return view('blog.index', compact('posts', 'categories', 'recentPosts', 'tags', 'tag'));
    }
}

