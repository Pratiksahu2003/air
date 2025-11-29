<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
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
        ];

        foreach ($tags as $tagName) {
            Tag::firstOrCreate(
                ['slug' => Str::slug($tagName)],
                ['name' => $tagName]
            );
        }
    }
}

