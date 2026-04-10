<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $query = Series::query();

        // Filtre par genre
        if ($request->filled('genre')) {
            $query->where('genre', $request->genre);
        }

        // Filtre actives seulement
        if ($request->boolean('active_only', false)) {
            $query->where('is_active', true);
        }

        // Recherche par titre
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $series = $query->orderBy('title')->paginate(15);

        return response()->json($series);
    }

    public function show($id)
    {
        $series = Series::with([
            'seasons.episodes',
            'actors',
            'quizzes',
        ])->find($id);

        if (!$series) {
            return response()->json(['error' => 'Series not found'], 404);
        }

        return response()->json($series);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'genre' => 'required|string|max:100',
            'release_year' => 'required|integer|min:1900|max:' . date('Y'),
            'rating' => 'nullable|numeric|min:0|max:10',
            'photo_url' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        $series = Series::create($request->all());

        return response()->json($series, 201);
    }

    public function update(Request $request, $id)
    {
        $series = Series::find($id);

        if (!$series) {
            return response()->json(['error' => 'Series not found'], 404);
        }

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'genre' => 'sometimes|required|string|max:100',
            'release_year' => 'sometimes|required|integer|min:1900|max:' . date('Y'),
            'rating' => 'sometimes|nullable|numeric|min:0|max:10',
            'photo_url' => 'sometimes|nullable|string|max:255',
            'is_active' => 'sometimes|boolean',
        ]);

        $series->update($request->all());

        return response()->json($series);
    }

    public function destroy($id)
    {
        $series = Series::find($id);

        if (!$series) {
            return response()->json(['error' => 'Series not found'], 404);
        }

        $series->delete();

        return response()->json(['message' => 'Series deleted successfully']);
    }
}