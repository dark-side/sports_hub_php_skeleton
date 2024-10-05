<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Comment;
use App\Models\User;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comments = [
            "This article was very informative and helpful.",
            "I learned a lot from this article and will definitely be using the tips.",
            "Great article! I will be sharing this with my friends.",
            "I loved this article and will be reading more from this author.",
            "This article was very well-written and easy to understand.",
            "I will be recommending this article to everyone I know.",
            "I learned so much from this article and will be using the tips in my own life.",
            "This article was very helpful and informative.",
            "I loved this article and will be reading more from this author.",
            "I will be recommending this article to everyone I know."
        ];

        $articles = Article::all();

        // Add one comment to each article
        foreach ($articles as $index => $article) {
            Comment::factory()->create([
                'article_id' => $article->id,
                'content' => $comments[$index % count($comments)],
            ]);
        }

        // Add additional random comments to random articles
        for ($i = 0; $i < 5; $i++) {
            $article = $articles->random();
            Comment::factory()->create([
                'article_id' => $article->id,
                'content' => $comments[array_rand($comments)],
            ]);
        }

        for ($i = 0; $i < 4; $i++) {
            $article = $articles->random();
            Comment::factory()->create([
                'article_id' => $article->id,
                'content' => $comments[array_rand($comments)],
            ]);
        }

        for ($i = 0; $i < 6; $i++) {
            $article = $articles->random();
            Comment::factory()->create([
                'article_id' => $article->id,
                'content' => $comments[array_rand($comments)],
            ]);
        }
    }
}
