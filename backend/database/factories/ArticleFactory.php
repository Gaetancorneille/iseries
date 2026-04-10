<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title'        => $this->faker->sentence(),
            'content'      => $this->faker->paragraphs(3, true),
            'author_id'    => User::factory(),
            'published_at' => now()->subDays(rand(1, 30)),
            'is_featured'  => false,
        ];
    }
}
