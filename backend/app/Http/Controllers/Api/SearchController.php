<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Series;
use App\Models\Article;
use App\Models\Actor;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Recherche globale sur les séries, articles et acteurs.
     * GET /api/v1/search?q=breaking&type=series&page=1
     */
    public function index(Request $request)
    {
        $request->validate([
            'q'    => 'required|string|min:2|max:100',
            'type' => 'nullable|in:series,articles,actors,all',
        ]);

        $q    = $request->q;
        $type = $request->get('type', 'all');

        $results = [];

        if (in_array($type, ['all', 'series'])) {
            $results['series'] = Series::where('is_active', true)
                ->where(function ($query) use ($q) {
                    $query->where('title',       'like', "%{$q}%")
                          ->orWhere('description', 'like', "%{$q}%")
                          ->orWhere('genre',        'like', "%{$q}%");
                })
                ->orderBy('title')
                ->limit(10)
                ->get(['id', 'title', 'genre', 'release_year', 'rating', 'photo_url']);
        }

        if (in_array($type, ['all', 'articles'])) {
            $results['articles'] = Article::with('author:id,name,nickname')
                ->where('published_at', '<=', now())
                ->where(function ($query) use ($q) {
                    $query->where('title',   'like', "%{$q}%")
                          ->orWhere('content', 'like', "%{$q}%");
                })
                ->orderBy('published_at', 'desc')
                ->limit(10)
                ->get(['id', 'title', 'author_id', 'published_at', 'is_featured']);
        }

        if (in_array($type, ['all', 'actors'])) {
            $results['actors'] = Actor::where(function ($query) use ($q) {
                    $query->where('name',      'like', "%{$q}%")
                          ->orWhere('biography', 'like', "%{$q}%");
                })
                ->limit(10)
                ->get(['id', 'name', 'photo_url', 'birth_date']);
        }

        $total = collect($results)->flatten(1)->count();

        return response()->json([
            'query'   => $q,
            'type'    => $type,
            'total'   => $total,
            'results' => $results,
        ]);
    }
}
