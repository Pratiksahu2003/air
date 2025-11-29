<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TagCategoryBlogFlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Tags
        $this->seedTags();

        // Seed Categories
        $categories = $this->seedCategories();

        // Seed Blog Posts
        $this->seedBlogPosts($categories);

    }

    /**
     * Seed tags for blog and flight booking
     */
    private function seedTags(): void
    {
        $tags = [
            // Blog-related tags
            'Travel Tips',
            'Group Travel',
            'Flight Deals',
            'Destination Guides',
            'Travel Planning',
            'Business Travel',
            'Vacation',
            'Adventure',
            'Family Travel',
            'Solo Travel',
            'Flight Booking',
            'Airline Reviews',
            'Travel Hacks',
            'Budget Travel',
            'Luxury Travel',
            'Corporate Travel',
            'Group Bookings',
            'Flight Discounts',
            'Travel Insurance',
            'Airport Tips',
        ];

        foreach ($tags as $tagName) {
            Tag::firstOrCreate(
                ['slug' => Str::slug($tagName)],
                ['name' => $tagName]
            );
        }

        $this->command->info('Tags seeded successfully!');
    }

    /**
     * Seed categories for blog
     */
    private function seedCategories(): array
    {
        $categories = [
            [
                'name' => 'Flight Booking',
                'slug' => 'flight-booking',
                'description' => 'Articles and guides about booking flights, finding deals, and flight tips.',
                'is_active' => true,
            ],
            [
                'name' => 'Group Travel',
                'slug' => 'group-travel',
                'description' => 'Information about group bookings, corporate travel, and group travel planning.',
                'is_active' => true,
            ],
            [
                'name' => 'Travel Destinations',
                'slug' => 'travel-destinations',
                'description' => 'Destination guides, travel recommendations, and location-specific tips.',
                'is_active' => true,
            ],
            [
                'name' => 'Travel Tips',
                'slug' => 'travel-tips',
                'description' => 'General travel advice, hacks, and tips for better travel experiences.',
                'is_active' => true,
            ],
            [
                'name' => 'Airline Information',
                'slug' => 'airline-information',
                'description' => 'Airline reviews, comparisons, and information about different carriers.',
                'is_active' => true,
            ],
            [
                'name' => 'Business Travel',
                'slug' => 'business-travel',
                'description' => 'Corporate travel guides, business class tips, and professional travel advice.',
                'is_active' => true,
            ],
        ];

        $seededCategories = [];
        foreach ($categories as $categoryData) {
            $category = Category::firstOrCreate(
                ['slug' => $categoryData['slug']],
                $categoryData
            );
            $seededCategories[$categoryData['slug']] = $category;
        }

        $this->command->info('Categories seeded successfully!');
        return $seededCategories;
    }

    /**
     * Seed blog posts related to travel and flight booking
     */
    private function seedBlogPosts(array $categories): void
    {
        // Get or create a default admin user for posts
        $adminUser = User::first();
        if (!$adminUser) {
            $adminUser = User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        $posts = [
            [
                'title' => 'Complete Guide to Group Flight Bookings',
                'slug' => 'complete-guide-to-group-flight-bookings',
                'excerpt' => 'Learn everything you need to know about booking flights for groups, including tips for getting the best deals and managing group travel.',
                'content' => '<p>Group flight bookings can be a great way to save money and coordinate travel for large groups. Whether you\'re planning a corporate trip, family reunion, or group vacation, understanding the ins and outs of group bookings is essential.</p><p>In this comprehensive guide, we\'ll cover:</p><ul><li>Benefits of group bookings</li><li>How to find the best group rates</li><li>Tips for coordinating group travel</li><li>Common pitfalls to avoid</li></ul>',
                'category_id' => $categories['group-travel']->id,
                'author_id' => $adminUser->id,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(5),
                'meta_title' => 'Complete Guide to Group Flight Bookings | Travel Tips',
                'meta_description' => 'Learn how to book flights for groups and save money on your next group trip.',
                'views_count' => 1250,
                'tags' => ['Group Travel', 'Flight Booking', 'Travel Tips', 'Group Bookings'],
            ],
            [
                'title' => 'Top 10 Tips for Finding Cheap Flight Deals',
                'slug' => 'top-10-tips-for-finding-cheap-flight-deals',
                'excerpt' => 'Discover proven strategies to find the best flight deals and save money on your next trip.',
                'content' => '<p>Finding cheap flights doesn\'t have to be a challenge. With the right strategies and timing, you can save hundreds of dollars on your airfare.</p><p>Here are our top 10 tips:</p><ol><li>Book in advance but not too early</li><li>Be flexible with your travel dates</li><li>Use flight comparison websites</li><li>Sign up for airline newsletters</li><li>Consider alternative airports</li><li>Travel during off-peak seasons</li><li>Use incognito mode when searching</li><li>Look for error fares</li><li>Consider budget airlines</li><li>Join frequent flyer programs</li></ol>',
                'category_id' => $categories['flight-booking']->id,
                'author_id' => $adminUser->id,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(10),
                'meta_title' => 'Top 10 Tips for Finding Cheap Flight Deals',
                'meta_description' => 'Learn how to find the best flight deals and save money on airfare with these proven tips.',
                'views_count' => 3420,
                'tags' => ['Flight Deals', 'Travel Tips', 'Budget Travel', 'Flight Booking'],
            ],
            [
                'title' => 'Corporate Travel: Best Practices for Business Trips',
                'slug' => 'corporate-travel-best-practices-for-business-trips',
                'excerpt' => 'Essential tips and best practices for managing corporate travel efficiently and cost-effectively.',
                'content' => '<p>Corporate travel management requires careful planning and attention to detail. Whether you\'re a travel manager or a frequent business traveler, these best practices will help streamline your corporate travel.</p><p>Key areas to focus on:</p><ul><li>Travel policy compliance</li><li>Cost management strategies</li><li>Booking efficiency</li><li>Traveler safety and support</li><li>Expense reporting</li></ul>',
                'category_id' => $categories['business-travel']->id,
                'author_id' => $adminUser->id,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(3),
                'meta_title' => 'Corporate Travel Best Practices | Business Travel Guide',
                'meta_description' => 'Learn best practices for managing corporate travel and business trips effectively.',
                'views_count' => 890,
                'tags' => ['Business Travel', 'Corporate Travel', 'Travel Planning', 'Group Travel'],
            ],
            [
                'title' => 'How to Plan the Perfect Group Vacation',
                'slug' => 'how-to-plan-the-perfect-group-vacation',
                'excerpt' => 'Step-by-step guide to planning an unforgettable group vacation, from booking flights to coordinating activities.',
                'content' => '<p>Planning a group vacation can be both exciting and challenging. With multiple people to coordinate, it\'s important to have a solid plan in place.</p><p>Our step-by-step guide covers:</p><ol><li>Choosing the right destination</li><li>Coordinating travel dates</li><li>Booking group flights</li><li>Finding accommodations</li><li>Planning activities everyone will enjoy</li><li>Managing budgets and expenses</li><li>Communication strategies</li></ol>',
                'category_id' => $categories['group-travel']->id,
                'author_id' => $adminUser->id,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(7),
                'meta_title' => 'How to Plan the Perfect Group Vacation',
                'meta_description' => 'Complete guide to planning group vacations, including flight booking and coordination tips.',
                'views_count' => 2100,
                'tags' => ['Group Travel', 'Vacation', 'Travel Planning', 'Family Travel'],
            ],
            [
                'title' => 'Understanding Airline Policies: What You Need to Know',
                'slug' => 'understanding-airline-policies-what-you-need-to-know',
                'excerpt' => 'Navigate airline policies like a pro with this comprehensive guide to baggage, cancellations, and more.',
                'content' => '<p>Airline policies can be confusing, but understanding them is crucial for a smooth travel experience. This guide breaks down the most important policies you need to know.</p><p>Topics covered:</p><ul><li>Baggage allowances and fees</li><li>Cancellation and refund policies</li><li>Change fees and policies</li><li>Seat selection rules</li><li>Group booking policies</li><li>Loyalty program benefits</li></ul>',
                'category_id' => $categories['airline-information']->id,
                'author_id' => $adminUser->id,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(2),
                'meta_title' => 'Understanding Airline Policies | Complete Guide',
                'meta_description' => 'Learn about airline policies including baggage, cancellations, and group bookings.',
                'views_count' => 1560,
                'tags' => ['Airline Information', 'Flight Booking', 'Travel Tips', 'Airline Reviews'],
            ],
        ];

        foreach ($posts as $postData) {
            $tags = $postData['tags'];
            unset($postData['tags']);

            $post = Post::firstOrCreate(
                ['slug' => $postData['slug']],
                $postData
            );

            // Attach tags to the post
            $tagIds = [];
            foreach ($tags as $tagName) {
                $tag = Tag::where('name', $tagName)->first();
                if ($tag) {
                    $tagIds[] = $tag->id;
                }
            }
            $post->tags()->sync($tagIds);
        }

        $this->command->info('Blog posts seeded successfully!');
    }


}

