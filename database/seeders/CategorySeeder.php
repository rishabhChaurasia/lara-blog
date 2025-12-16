<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Technology',
                'slug' => 'technology',
                'description' => 'Latest updates and insights on technology trends, software development, and innovations.',
            ],
            [
                'name' => 'Lifestyle',
                'slug' => 'lifestyle',
                'description' => 'Tips and stories about living a balanced and fulfilling life.',
            ],
            [
                'name' => 'Travel',
                'slug' => 'travel',
                'description' => 'Explore amazing destinations and travel experiences around the world.',
            ],
            [
                'name' => 'Food & Cooking',
                'slug' => 'food-cooking',
                'description' => 'Delicious recipes and culinary adventures for food lovers.',
            ],
            [
                'name' => 'Health & Fitness',
                'slug' => 'health-fitness',
                'description' => 'Stay healthy and active with fitness tips and wellness advice.',
            ],
            [
                'name' => 'Business',
                'slug' => 'business',
                'description' => 'Insights on entrepreneurship, marketing, and business strategies.',
            ],
            [
                'name' => 'Education',
                'slug' => 'education',
                'description' => 'Learning resources and educational content for all ages.',
            ],
            [
                'name' => 'Entertainment',
                'slug' => 'entertainment',
                'description' => 'Movies, music, gaming and other forms of entertainment.',
            ],
            [
                'name' => 'Science',
                'slug' => 'science',
                'description' => 'Fascinating discoveries and research in various scientific fields.',
            ],
            [
                'name' => 'Art & Design',
                'slug' => 'art-design',
                'description' => 'Creative works and design inspiration from around the world.',
            ],
            [
                'name' => 'Personal Finance',
                'slug' => 'personal-finance',
                'description' => 'Tips for managing money, investing, and financial planning.',
            ],
            [
                'name' => 'Parenting',
                'slug' => 'parenting',
                'description' => 'Advice and resources for parents and families.',
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::create([
                'name' => $categoryData['name'],
                'slug' => $categoryData['slug'],
                'description' => $categoryData['description'],
                'image' => 'categories/default.jpg', // We'll use a default image for now
            ]);
        }
    }
}