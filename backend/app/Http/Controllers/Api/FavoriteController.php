<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Series;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    /**
     * Liste les favoris de l'utilisateur connecté.
     * GET /api/v1/favorites
     */
    public function index()
    {
        $favorites = Favorite::with('series')
            ->where('user_id', auth('api')->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($favorites);
    }

    /**
     * Ajouter une série aux favoris.
     * POST /api/v1/favorites
     */
    public function store(Request $request)
    {
        $request->validate([
            'series_id' => 'required|exists:series,id',
        ]);

        $already = Favorite::where('user_id', auth('api')->id())
            ->where('series_id', $request->series_id)
            ->exists();

        if ($already) {
            return response()->json(['error' => 'Series already in favorites'], 422);
        }

        $favorite = Favorite::create([
            'user_id'   => auth('api')->id(),
            'series_id' => $request->series_id,
        ]);

        return response()->json([
            'message'  => 'Series added to favorites',
            'favorite' => $favorite->load('series'),
        ], 201);
    }

    /**
     * Retirer une série des favoris.
     * DELETE /api/v1/favorites/{seriesId}
     */
    public function destroy($seriesId)
    {
        $favorite = Favorite::where('user_id', auth('api')->id())
            ->where('series_id', $seriesId)
            ->first();

        if (!$favorite) {
            return response()->json(['error' => 'Favorite not found'], 404);
        }

        $favorite->delete();

        return response()->json(['message' => 'Series removed from favorites']);
    }

    /**
     * Vérifier si une série est dans les favoris.
     * GET /api/v1/favorites/check/{seriesId}
     */
    public function check($seriesId)
    {
        $isFavorite = Favorite::where('user_id', auth('api')->id())
            ->where('series_id', $seriesId)
            ->exists();

        return response()->json(['is_favorite' => $isFavorite]);
    }

    /**
     * Toggle : ajouter ou retirer des favoris en une seule requête.
     * POST /api/v1/favorites/toggle
     */
    public function toggle(Request $request)
    {
        $request->validate([
            'series_id' => 'required|exists:series,id',
        ]);

        $favorite = Favorite::where('user_id', auth('api')->id())
            ->where('series_id', $request->series_id)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['is_favorite' => false, 'message' => 'Removed from favorites']);
        }

        Favorite::create([
            'user_id'   => auth('api')->id(),
            'series_id' => $request->series_id,
        ]);

        return response()->json(['is_favorite' => true, 'message' => 'Added to favorites']);
    }
}
