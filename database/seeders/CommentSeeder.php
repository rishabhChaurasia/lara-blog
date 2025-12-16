<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all posts and users
        $posts = Post::all();
        $users = User::all();

        // Sample comment content
        $commentTexts = [
            "This is a great article! Thanks for sharing your insights.",
            "I found this very helpful. Looking forward to more content like this.",
            "Thanks for the detailed explanation. It really cleared things up for me.",
            "I disagree with some points, but overall it's a well-written piece.",
            "Could you elaborate more on this topic? I'm very interested.",
            "Great post! I learned something new today.",
            "This is exactly what I was looking for. Thank you!",
            "Interesting perspective. I hadn’t thought about it this way before.",
            "The examples you provided were very helpful. Thanks!",
            "I appreciate the time you put into this. Well done!",
            "This article helped me solve a problem I was having. Thank you!",
            "Very informative post. Keep up the good work!",
            "I have a question about something mentioned in this post.",
            "Excellent explanation! This makes much more sense now.",
            "I really enjoyed reading this. Thanks for the insights.",
            "This is a topic I'm passionate about. Great to see it covered.",
            "Well researched and well written. Thanks for sharing!",
            "This post has given me a lot to think about. Thanks!",
            "I appreciate the practical examples. Very useful!",
            "Looking forward to more content like this from you.",
            "This is a complex topic, but you explained it well.",
            "Thanks for breaking this down in an easy-to-understand way.",
            "I've bookmarked this post to read again. Very helpful.",
            "Your expertise really shows in this article. Thanks!",
            "This is exactly the kind of content I enjoy reading.",
            "I had a different opinion before reading this. Changed my mind!",
            "The way you presented the information was very clear.",
            "I've shared this with colleagues. Useful information!",
            "This deserves more recognition. Well done!",
            "I've been following your posts and this is one of the best!",
            "Very well structured and easy to follow. Thanks!",
            "This answered questions I was having. Much appreciated!",
            "Great use of examples to illustrate the points.",
            "This has inspired me to try something new. Thanks!",
            "I particularly enjoyed the practical tips section.",
            "The research you put into this shows. Thank you!",
            "This is the kind of quality content the web needs more of.",
            "I've been struggling with this topic, and this helped a lot.",
            "Fantastic explanation of a complex subject.",
            "Your writing style makes complex topics easy to understand.",
            "I'll definitely be applying these tips. Thanks!",
            "This is a keeper! Will refer back to this often.",
            "I appreciate the time and effort you put into this.",
            "This clarified something I've been confused about.",
            "Great job explaining this concept clearly.",
            "I've learned something new today. Thank you!",
            "This is very well researched. Impressive work!",
            "I've already implemented some of your suggestions.",
            "The examples you provided were perfect. Thanks!",
            "This post has changed how I approach this topic.",
            "Very comprehensive and well-written. Thank you!",
            "I'm sharing this with my team. Very valuable information!",
            "This is exactly what I needed to read today.",
            "Well done! This is high-quality content.",
            "I've been looking for information like this. Thanks!",
            "This is a great resource. I'll be referencing it often.",
            "Your expertise comes through clearly in this post.",
            "Very insightful and well-organized. Thanks!",
            "This exceeded my expectations. Great work!",
            "I appreciate the depth of information provided.",
            "This is exactly what I was searching for. Thank you!",
            "Wonderful explanation with great examples. Well done!",
            "This is a must-read for anyone interested in this topic.",
            "I've already recommended this to several people.",
            "The clarity of your writing is much appreciated.",
            "This has given me a fresh perspective on the topic.",
            "I'll be bookmarking this for future reference.",
            "This is the best explanation I've found so far.",
            "Very well articulated and informative. Great job!",
            "I've been following your work and this is excellent!",
            "This is a fantastic resource. Thanks for sharing!",
            "The level of detail is just right. Perfect!",
            "I found this through a search and I'm glad I did!",
            "This article is everything I hoped it would be.",
            "Thank you for taking the time to write this.",
            "This is the kind of content that adds value.",
            "Very well researched and clearly presented.",
            "I appreciate the practical approach you've taken.",
            "This is a valuable resource. Thank you!",
            "The insights you've shared are very helpful.",
            "This has helped me understand the topic better.",
            "Great job explaining complex concepts simply.",
            "I'm impressed with the quality of this content.",
            "This is exactly the kind of content I look for.",
            "Thanks for making this complex topic understandable.",
            "I've read several articles on this topic, and this is the best!",
            "This article provides great value. Thank you!",
            "Very well done! This is quality content.",
            "I've learned so much from reading this. Thanks!",
            "This is a great resource for anyone in this field.",
            "I appreciate the time invested in this comprehensive guide.",
            "This article has answered many of my questions.",
            "The practical advice here is very valuable.",
            "I'm sharing this with my network. Excellent work!",
            "This is well-written and very informative. Thanks!",
            "I'll definitely be using the information from this post.",
            "This is a fantastic resource. Much appreciated!",
            "The explanations are clear and easy to follow.",
            "This article is exactly what I needed. Thanks!",
            "I've been researching this topic and this is the best resource!",
            "Great content with practical applications. Well done!",
            "This is quality information. Thanks for sharing!",
            "I appreciate the thoroughness of this article.",
            "This has provided clarity on a confusing topic.",
            "Excellent work! This is valuable information.",
            "I'm impressed by the depth of knowledge shown here.",
            "This article provides just what I was looking for.",
            "The examples make this very easy to understand. Thanks!",
            "This is well worth the read. Excellent content!",
            "I've gained new insights from this article. Thank you!",
            "This is high-quality content. Well researched!",
            "The information here is presented very clearly.",
            "This article is a great reference. Thanks!",
            "I'll be implementing these suggestions. Helpful!",
            "This is exactly what I was hoping to find.",
            "Great insights and practical advice. Thank you!",
            "This is informative and well-written. Excellent job!",
            "I appreciate the effort put into this article.",
            "This provides valuable information. Thanks!",
            "Very well explained with useful examples. Great work!",
            "This article addresses my exact needs. Thank you!",
            "The content is comprehensive and easy to follow.",
            "This is useful information presented clearly.",
            "I've bookmarked this for future reference. Thank you!",
            "This article has provided great value. Excellent!"
        ];

        // Create 200 sample comments
        for ($i = 0; $i < 200; $i++) {
            $post = $posts->random();
            $user = $users->random();
            
            $comment = Comment::create([
                'content' => $commentTexts[array_rand($commentTexts)],
                'post_id' => $post->id,
                'user_id' => $user->id,
                'status' => 'approved', // Most comments are approved
                'created_at' => $post->published_at->addDays(rand(1, 30))->addHours(rand(1, 24)), // Comments come after the post
            ]);

            // Occasionally create replies to comments (about 20% of comments)
            if (rand(1, 10) <= 2 && $i > 20) { // Only create replies after first 20 comments
                Comment::create([
                    'content' => $commentTexts[array_rand($commentTexts)],
                    'post_id' => $post->id,
                    'user_id' => $users->random()->id,
                    'parent_id' => $comment->id,
                    'status' => 'approved',
                    'created_at' => $comment->created_at->addHours(rand(1, 48)),
                ]);
            }
        }

        // Create some pending and spam comments for variety
        for ($i = 0; $i < 30; $i++) {
            $post = $posts->random();
            $user = $users->random();
            
            Comment::create([
                'content' => $commentTexts[array_rand($commentTexts)],
                'post_id' => $post->id,
                'user_id' => $user->id,
                'status' => rand(0, 1) ? 'pending' : 'spam', // Either pending or spam
                'created_at' => $post->published_at->addDays(rand(1, 15))->addHours(rand(1, 24)),
            ]);
        }
    }
}