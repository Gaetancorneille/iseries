<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Season;
use App\Models\Series;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    /**
     * Liste les saisons d'une série.
     * GET /api/v1/series/{seriesId}/seasons
     */
    public function index($seriesId)
    {
        $series = Series::find($seriesId);

        if (!$series) {
            return response()->json(['error' => 'Series not found'], 404);
        }

        $seasons = Season::where('series_id', $seriesId)
            ->withCount('episodes')
            ->orderBy('season_number')
            ->get();

        return response()->json([
            'series'  => $series->only(['id', 'title']),
            'seasons' => $seasons,
        ]);
    }

    /**
     * Détail d'une saison avec ses épisodes.
     * GET /api/v1/series/{seriesId}/seasons/{seasonNumber}
     */
    public function show($seriesId, $seasonNumber)
    {
        $season = Season::with('episodes')
            ->where('series_id', $seriesId)
            ->where('season_number', $seasonNumber)
            ->first();

        if (!$season) {
            return response()->json(['error' => 'Season not found'], 404);
        }

        return response()->json($season);
    }

    /**
     * Créer une saison (admin).
     * POST /api/v1/series/{seriesId}/seasons
     */
    public function store(Request $request, $seriesId)
    {
        $series = Series::find($seriesId);

        if (!$series) {
            return response()->json(['error' => 'Series not found'], 404);
        }

        $request->validate([
            'season_number' => 'required|integer|min:1',
            'title'         => 'nullable|string|max:255',
            'description'   => 'nullable|string',
            'release_date'  => 'nullable|date',
            'episode_count' => 'nullable|integer|min:0',
        ]);

        // Empêcher les doublons de numéro de saison
        $exists = Season::where('series_id', $seriesId)
            ->where('season_number', $request->season_number)
            ->exists();

        if ($exists) {
            return response()->json(['error' => 'Season number already exists for this series'], 422);
        }

        $season = Season::create([
            'series_id'     => $seriesId,
            'season_number' => $request->season_number,
            'title'         => $request->title,
            'description'   => $request->description,
            'release_date'  => $request->release_date,
            'episode_count' => $request->episode_count ?? 0,
        ]);

        return response()->json($season, 201);
    }

    /**
     * Mettre à jour une saison.
     * PUT /api/v1/series/{seriesId}/seasons/{seasonNumber}
     */
    public function update(Request $request, $seriesId, $seasonNumber)
    {
        $season = Season::where('series_id', $seriesId)
            ->where('season_number', $seasonNumber)
            ->first();

        if (!$season) {
            return response()->json(['error' => 'Season not found'], 404);
        }

        $request->validate([
            'title'         => 'sometimes|nullable|string|max:255',
            'description'   => 'sometimes|nullable|string',
            'release_date'  => 'sometimes|nullable|date',
            'episode_count' => 'sometimes|nullable|integer|min:0',
        ]);

        $season->update($request->only(['title', 'description', 'release_date', 'episode_count']));

        return response()->json($season);
    }

    /**
     * Supprimer une saison (et ses épisodes en cascade).
     * DELETE /api/v1/series/{seriesId}/seasons/{seasonNumber}
     */
    public function destroy($seriesId, $seasonNumber)
    {
        $season = Season::where('series_id', $seriesId)
            ->where('season_number', $seasonNumber)
            ->first();

        if (!$season) {
            return response()->json(['error' => 'Season not found'], 404);
        }

        $season->delete();

        return response()->json(['message' => 'Season deleted successfully']);
    }
}
