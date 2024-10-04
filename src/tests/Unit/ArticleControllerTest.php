<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Article;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the article.index route.
     *
     * @return void
     */
    public function test_article_index()
    {
        // Create some articles
        Article::factory()->count(3)->create();

        // Make a GET request to the article.index route
        $response = $this->get(route('articles.index'));

        // Assert that the response status is 200
        $response->assertStatus(200);

        // Assert that the response contains the articles
        $response->assertJsonCount(3);
    }
}