<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'series_id',
        'created_by',
        'time_limit',
        'passing_score',
        'is_active'
    ];

    protected $casts = [
        'time_limit' => 'integer',
        'passing_score' => 'integer',
        'is_active' => 'boolean'
    ];

    public function series()
    {
        return $this->belongsTo(Series::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function questions()
    {
        return $this->hasMany(QuizQuestion::class)->orderBy('order');
    }

    public function attempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }
}