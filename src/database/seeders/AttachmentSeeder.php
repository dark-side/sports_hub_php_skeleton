<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Attachment;

class AttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = 'images';
        $assetsPath = public_path('assets/' . $path);
        // find all files in assets/images folder matching pattern "news_1.jpg"
        $files = glob($assetsPath . '/news_*.jpg');

        sort($files);

        $articles = Article::all();

        // Add one image per article
        foreach ($articles as $index => $article) {
            Attachment::factory()->create([
                'article_id' => $article->id,
                // creator has added an image
                'user_id' => $article->author_id,
                'url' => $path . '/' . pathinfo($files[$index], PATHINFO_BASENAME),
            ]);
        }
    }
}
