<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'genre',
        'release_year',
        'rating',
        'photo_url',
        'is_active',
    ];

    protected $casts = [
        'release_year' => 'integer',
        'rating' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'series_actors')
                    ->withPivot('character_name', 'order')
                    ->orderBy('series_actors.order');
    }

    public function seasons()
    {
        return $this->hasMany(Season::class)->orderBy('season_number');
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }
}