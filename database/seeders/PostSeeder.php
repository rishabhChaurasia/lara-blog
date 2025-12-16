<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users, categories, and tags
        $users = User::all();
        $categories = Category::all();
        $tags = Tag::all();

        // Sample titles and content
        $postTitles = [
            'Getting Started with Laravel Framework',
            'Advanced PHP Techniques for Modern Development',
            'Building Scalable Web Applications',
            'Database Optimization Strategies',
            'API Design Best Practices',
            'Security in Web Applications',
            'Frontend Frameworks Comparison',
            'Containerization with Docker',
            'CI/CD Pipeline Implementation',
            'Performance Optimization Tips',
            'Understanding Microservices Architecture',
            'Testing Strategies in Laravel',
            'RESTful API Development',
            'Working with Queues in Laravel',
            'Implementing Caching Strategies',
            'Laravel Eloquent Relationships Guide',
            'Authentication and Authorization in Laravel',
            'File Upload Handling in Web Apps',
            'Working with Third-Party APIs',
            'Database Migration Strategies',
            'Laravel Artisan Commands',
            'Blade Template Best Practices',
            'Email Automation with Laravel',
            'Laravel Package Development',
            'Optimizing Database Queries',
            'Building Real-Time Applications',
            'Laravel Validation Techniques',
            'Working with Laravel Middleware',
            'Laravel Event System Explained',
            'Laravel Queue Jobs and Listeners',
            'Mobile App Backend with Laravel',
            'Laravel Broadcasting System',
            'Laravel Service Providers',
            'Model Factories in Laravel',
            'Laravel Mix and Asset Compilation',
            'Working with Laravel Collections',
            'Laravel Localization',
            'Laravel Logging and Monitoring',
            'Laravel Testing: Unit vs Feature Tests',
            'Laravel Scout Search Implementation',
            'Laravel Passport API Authentication',
            'Laravel Horizon Queue Management',
            'Laravel Telescope Debugging',
            'Laravel Nova Admin Panel',
            'Laravel Sanctum Token Management',
            'Building Laravel Packages',
            'Laravel Actions Pattern',
            'Laravel Resources and API Transformation',
            'Laravel Policies and Gates',
            'Laravel Scopes and Query Modification'
        ];

        $postContent = [
            "Modern web development has evolved significantly with the introduction of powerful frameworks. Laravel stands out as one of the premier PHP frameworks for building robust and scalable web applications. This article explores the fundamentals of Laravel and how to get started with this powerful framework.",
            
            "PHP continues to be one of the most popular server-side scripting languages. With each version, PHP introduces new features and improvements that enhance development efficiency. This guide covers advanced PHP techniques that can help you write more efficient and maintainable code.",
            
            "Scalability is a critical factor in modern web applications. As your application grows, it needs to handle increased traffic and data loads seamlessly. This article discusses various strategies and architectural patterns that can help build scalable web applications.",
            
            "Database performance significantly impacts application responsiveness. Optimizing your database queries and structure can lead to substantial performance improvements. This article covers various optimization techniques and best practices for database management.",
            
            "APIs are the backbone of modern web applications, enabling communication between different services. Designing APIs that are intuitive, scalable, and maintainable is crucial. This article explores best practices for API design and implementation.",
            
            "Security should be a top priority in any web application. With cyber threats becoming more sophisticated, implementing robust security measures is essential. This article covers essential security practices for web applications.",
            
            "Frontend development has seen rapid evolution with various frameworks and libraries. Choosing the right framework for your project can significantly impact development efficiency and user experience. This article compares popular frontend frameworks.",
            
            "Docker has revolutionized how applications are deployed and managed. Containerization provides consistency across different environments and simplifies deployment processes. This article guides you through containerization with Docker.",
            
            "Continuous Integration and Continuous Deployment (CI/CD) pipelines automate the software delivery process. Implementing efficient CI/CD pipelines can significantly improve deployment frequency and reduce errors. This article covers CI/CD implementation strategies.",
            
            "Performance optimization is an ongoing process that can significantly improve user experience. This article explores various techniques to optimize your application's performance, from code-level optimizations to infrastructure improvements."
        ];

        // Create 50 sample posts
        for ($i = 0; $i < 50; $i++) {
            $title = $postTitles[array_rand($postTitles)];
            $content = $postContent[array_rand($postContent)];
            $excerpt = Str::limit(strip_tags($content), 200);
            $slug = Str::slug($title . '-' . rand(1000, 9999));

            $post = Post::create([
                'title' => $title,
                'slug' => $slug,
                'excerpt' => $excerpt,
                'content' => $content,
                'featured_image' => 'posts/default.jpg', // Using a default image
                'status' => 'published',
                'published_at' => now()->subDays(rand(1, 100)),
                'user_id' => $users->random()->id,
                'meta_title' => $title,
                'meta_description' => $excerpt,
                'views_count' => rand(10, 10000)
            ]);

            // Attach random categories (1-3 per post)
            $selectedCategories = $categories->random(rand(1, min(3, $categories->count())));
            $post->categories()->attach($selectedCategories->pluck('id'));

            // Attach random tags (2-5 per post)
            $selectedTags = $tags->random(rand(2, min(5, $tags->count())));
            $post->tags()->attach($selectedTags->pluck('id'));
        }
    }
}