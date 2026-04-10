<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\Season;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    /**
     * Liste les épisodes d'une saison.
     * GET /api/v1/series/{seriesId}/seasons/{seasonNumber}/episodes
     */
    public function index($seriesId, $seasonNumber)
    {
        $season = Season::where('series_id', $seriesId)
            ->where('season_number', $seasonNumber)
            ->first();

        if (!$season) {
            return response()->json(['error' => 'Season not found'], 404);
        }

        $episodes = Episode::where('season_id', $season->id)
            ->orderBy('episode_number')
            ->get();

        return response()->json([
            'season'   => $season->only(['id', 'season_number', 'title']),
            'episodes' => $episodes,
        ]);
    }

    /**
     * Détail d'un épisode.
     * GET /api/v1/series/{seriesId}/seasons/{seasonNumber}/episodes/{episodeNumber}
     */
    public function show($seriesId, $seasonNumber, $episodeNumber)
    {
        $season = Season::where('series_id', $seriesId)
            ->where('season_number', $seasonNumber)
            ->first();

        if (!$season) {
            return response()->json(['error' => 'Season not found'], 404);
        }

        $episode = Episode::where('season_id', $season->id)
            ->where('episode_number', $episodeNumber)
            ->first();

        if (!$episode) {
            return response()->json(['error' => 'Episode not found'], 404);
        }

        // Épisodes précédent et suivant pour la navigation
        $prev = Episode::where('season_id', $season->id)
            ->where('episode_number', '<', $episodeNumber)
            ->orderBy('episode_number', 'desc')
            ->first(['id', 'episode_number', 'title']);

        $next = Episode::where('season_id', $season->id)
            ->where('episode_number', '>', $episodeNumber)
            ->orderBy('episode_number')
            ->first(['id', 'episode_number', 'title']);

        return response()->json([
            'episode'          => $episode,
            'previous_episode' => $prev,
            'next_episode'     => $next,
        ]);
    }

    /**
     * Créer un épisode.
     * POST /api/v1/series/{seriesId}/seasons/{seasonNumber}/episodes
     */
    public function store(Request $request, $seriesId, $seasonNumber)
    {
        $season = Season::where('series_id', $seriesId)
            ->where('season_number', $seasonNumber)
            ->first();

        if (!$season) {
            return response()->json(['error' => 'Season not found'], 404);
        }

        $request->validate([
            'episode_number' => 'required|integer|min:1',
            'title'          => 'required|string|max:255',
            'description'    => 'nullable|string',
            'video_url'      => 'nullable|url|max:500',
            'duration'       => 'nullable|integer|min:1', // en minutes
            'release_date'   => 'nullable|date',
            'photo_url'      => 'nullable|string|max:500',
        ]);

        $exists = Episode::where('season_id', $season->id)
            ->where('episode_number', $request->episode_number)
            ->exists();

        if ($exists) {
            return response()->json(['error' => 'Episode number already exists in this season'], 422);
        }

        $episode = Episode::create([
            'season_id'      => $season->id,
            'series_id'      => $seriesId,
            'episode_number' => $request->episode_number,
            'title'          => $request->title,
            'description'    => $request->description,
            'video_url'      => $request->video_url,
            'duration'       => $request->duration,
            'release_date'   => $request->release_date,
            'photo_url'      => $request->photo_url,
        ]);

        // Mettre à jour le compteur d'épisodes de la saison
        $season->increment('episode_count');

        return response()->json($episode, 201);
    }

    /**
     * Mettre à jour un épisode.
     * PUT /api/v1/series/{seriesId}/seasons/{seasonNumber}/episodes/{episodeNumber}
     */
    public function update(Request $request, $seriesId, $seasonNumber, $episodeNumber)
    {
        $season = Season::where('series_id', $seriesId)
            ->where('season_number', $seasonNumber)
            ->first();

        if (!$season) {
            return response()->json(['error' => 'Season not found'], 404);
        }

        $episode = Episode::where('season_id', $season->id)
            ->where('episode_number', $episodeNumber)
            ->first();

        if (!$episode) {
            return response()->json(['error' => 'Episode not found'], 404);
        }

        $request->validate([
            'title'        => 'sometimes|required|string|max:255',
            'description'  => 'sometimes|nullable|string',
            'video_url'    => 'sometimes|nullable|url|max:500',
            'duration'     => 'sometimes|nullable|integer|min:1',
            'release_date' => 'sometimes|nullable|date',
            'photo_url'    => 'sometimes|nullable|string|max:500',
        ]);

        $episode->update($request->only([
            'title', 'description', 'video_url', 'duration', 'release_date', 'photo_url'
        ]));

        return response()->json($episode);
    }

    /**
     * Supprimer un épisode.
     * DELETE /api/v1/series/{seriesId}/seasons/{seasonNumber}/episodes/{episodeNumber}
     */
    public function destroy($seriesId, $seasonNumber, $episodeNumber)
    {
        $season = Season::where('series_id', $seriesId)
            ->where('season_number', $seasonNumber)
            ->first();

        if (!$season) {
            return response()->json(['error' => 'Season not found'], 404);
        }

        $episode = Episode::where('season_id', $season->id)
            ->where('episode_number', $episodeNumber)
            ->first();

        if (!$episode) {
            return response()->json(['error' => 'Episode not found'], 404);
        }

        $episode->delete();
        $season->decrement('episode_count');

        return response()->json(['message' => 'Episode deleted successfully']);
    }
}
