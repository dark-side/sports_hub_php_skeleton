<?php

namespace Tests\Unit;

use Tests\TestCase;
use Mockery;
use App\Models\Article;
use App\Http\Controllers\Api\ArticleController;
use Illuminate\Http\JsonResponse;

class ArticleControllerTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function testIndex()
    {
        // Create a mock for the Article model
        $articleMock = Mockery::mock('alias:App\Models\Article');

        // Define the expected behavior for the mock
        $articleMock->shouldReceive('with')
            ->once()
            ->andReturnSelf();
        $articleMock->shouldReceive('get')
            ->once()
            ->andReturn(collect([
                (object)[
                    'id' => 1,
                    'attachment' => (object)['url' => 'http://example.com/image1.jpg'],
                    'reaction' => (object)['likes' => 10, 'dislikes' => 2],
                    'comments' => collect([
                        (object)['content' => 'Great article!'],
                        (object)['content' => 'Very informative.']
                    ])
                ],
                (object)[
                    'id' => 2,
                    'attachment' => (object)['url' => 'http://example.com/image2.jpg'],
                    'reaction' => (object)['likes' => 5, 'dislikes' => 1],
                    'comments' => collect([
                        (object)['content' => 'Nice read.']
                    ])
                ]
            ]));

        // Create an instance of the controller
        $controller = new ArticleController();

        // Call the index method
        $response = $controller->index();

        // Assert the response
        $this->assertInstanceOf(JsonResponse::class, $response);

        $data = $response->getData(true);

        $this->assertCount(2, $data);
        $this->assertEquals('http://example.com/image1.jpg', $data[0]['image_url']);
        $this->assertEquals(10, $data[0]['article_likes']);
        $this->assertEquals(2, $data[0]['article_dislikes']);
        $this->assertEquals("Great article!\nVery informative.", $data[0]['comments_content']);
        $this->assertEquals(2, $data[0]['comments_count']);
    }

    public function testGet()
    {
        // Create a mock for the Article model
        $articleMock = Mockery::mock('alias:App\Models\Article');

        // Define the expected behavior for the mock
        $articleMock->shouldReceive('with')
            ->once()
            ->andReturnSelf();
        $articleMock->shouldReceive('findOrFail')
            ->once()
            ->with(1)
            ->andReturn((object)[
                'id' => 1,
                'attachments' => collect([
                    (object)['url' => 'http://example.com/image1.jpg']
                ])
            ]);

        // Create an instance of the controller
        $controller = new ArticleController();

        // Call the get method
        $article = new Article();
        $article->id = 1;
        $response = $controller->get($article);

        // Assert the response
        $this->assertInstanceOf(JsonResponse::class, $response);
        $data = $response->getData(true);

        $this->assertEquals(1, $data['id']);
        $this->assertCount(1, $data['attachments']);
        $this->assertEquals('http://example.com/image1.jpg', $data['attachments'][0]['url']);
    }
}
