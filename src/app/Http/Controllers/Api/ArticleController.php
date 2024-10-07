<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller as Controller;
use App\Http\Requests\ArticleCreateRequest;
use App\Http\Requests\ArticleUpdateRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::with([
            'attachment' => function ($query) {
                $query->select('id', 'article_id', 'url');
            },
            'reaction' => function ($query) {
                $query->select('id', 'article_id', 'likes', 'dislikes');
            },
            'comments' => function ($query) {
                $query->select('id', 'article_id', 'content');
            },
        ])->get();

        // Transform the attachments collection to include only the 'url' field
        $articles->each(function ($article) {
            if (!empty($article->attachment)) {
                $article->image_url = $article->attachment->url;
                unset($article->attachment);
            }

            if (!empty($article->reaction)) {
                $article->article_likes = $article->reaction->likes;
                $article->article_dislikes = $article->reaction->dislikes;
                unset($article->reaction);
            }

            if (!empty($article->comments)) {
                $article->comments_content = $article->comments->pluck('content')->implode("\n");
                $article->comments_count = $article->comments->count();
                unset($article->comments);
            }
        });

        return response()->json($articles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleCreateRequest $request)
    {
        $validatedData = $request->validated();

        $user = auth('api')->user();

        $validatedData['author_id'] = $user->id;

        $article = Article::create($validatedData);

        return response()->json($article, 201);
    }

    /**
     * Display the specified resource.
     */
    public function get(Article $article)
    {
        // Eager load the attachments relationship and select only the 'url' field
        $article = Article::with([
            'attachment' => function ($query) {
                $query->select('id', 'article_id', 'url');
            },
            'reaction' => function ($query) {
                $query->select('id', 'article_id', 'likes', 'dislikes');
            },
            'comments' => function ($query) {
                $query->select('id', 'article_id', 'content');
            },

        ])->findOrFail($article->id);

        if (!empty($article->attachment)) {
            $article->image_url = $article->attachment->url;
            unset($article->attachment);
        }

        if (!empty($article->reaction)) {
            $article->article_likes = $article->reaction->likes;
            $article->article_dislikes = $article->reaction->dislikes;
            unset($article->reaction);
        }

        if (!empty($article->comments)) {
            $article->comments_content = $article->comments->pluck('content')->implode("\n");
            $article->comments_count = $article->comments->count();
            unset($article->comments);
        }

        return response()->json($article);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleUpdateRequest $request, Article $article)
    {
        $validatedData = $request->validated();

        $article->update($validatedData);

        return response()->json($article);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return response()->json(['message' => 'Article deleted successfully']);
    }
}
