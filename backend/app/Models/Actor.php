<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'photo_url',
        'birth_date',
        'biography',
        'imdb_id'
    ];

    protected $casts = [
        'birth_date' => 'date'
    ];

    public function series()
    {
        return $this->belongsToMany(Series::class, 'series_actors')
                    ->withPivot('character_name', 'order')
                    ->orderBy('series_actors.order');
    }
}