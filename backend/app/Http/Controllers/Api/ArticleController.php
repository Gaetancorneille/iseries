<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('author')
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->paginate(15);

        return response()->json($articles);
    }

    public function show($id)
    {
        $article = Article::with('author')->find($id);

        if (!$article) {
            return response()->json(['error' => 'Article not found'], 404);
        }

        return response()->json($article);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'content'      => 'required|string',
            'published_at' => 'nullable|date',
            'is_featured'  => 'boolean',
        ]);

        $article = Article::create([
            'title'        => $request->title,
            'content'      => $request->content,
            'author_id'    => auth('api')->id(), // Toujours l'utilisateur connecté
            'published_at' => $request->published_at,
            'is_featured'  => $request->boolean('is_featured', false),
        ]);

        return response()->json($article->load('author'), 201);
    }

    public function update(Request $request, $id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json(['error' => 'Article not found'], 404);
        }

        // Seul l'auteur peut modifier son article
        if ($article->author_id !== auth('api')->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'title'        => 'sometimes|required|string|max:255',
            'content'      => 'sometimes|required|string',
            'published_at' => 'sometimes|nullable|date',
            'is_featured'  => 'sometimes|boolean',
        ]);

        $article->update($request->only(['title', 'content', 'published_at', 'is_featured']));

        return response()->json($article->load('author'));
    }

    public function destroy($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json(['error' => 'Article not found'], 404);
        }

        // Seul l'auteur peut supprimer son article
        if ($article->author_id !== auth('api')->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $article->delete();

        return response()->json(['message' => 'Article deleted successfully']);
    }
}