<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'series_id',
        'season_number',
        'title',
        'description',
        'release_date',
        'episode_count'
    ];

    protected $casts = [
        'release_date' => 'date',
        'episode_count' => 'integer',
        'season_number' => 'integer'
    ];

    public function series()
    {
        return $this->belongsTo(Series::class);
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class)->orderBy('episode_number');
    }
}