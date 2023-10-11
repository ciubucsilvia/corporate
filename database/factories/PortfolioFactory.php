<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use stdClass;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Portfolio>
 */
class PortfolioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $image = new stdClass();
        $image->mini = basename($this->makeImage('mini'));
        $image->max = basename($this->makeImage('max'));

        $isPublished = rand(0,1);

        return [
            'title' => fake()->sentence(rand(2,5), true),
            'image' => json_encode($image),
            'category_id' => rand(1, 10),
            'content' => fake()->text(rand(200, 1000)),
            'is_published' => $isPublished,
            'published_at'  => $isPublished 
                ? fake()->dateTimeBetween('-2 months', now()) 
                : null,
            'created_at' => fake()->dateTimeBetween('-2 months', now())
        ];
    }

    private function makeImage($name)
    {
        $fakeFileName = fake()->image(
            public_path(env('THEME') . '/images/portfolios'),
            config('settings.portfolio.image.' . $name . '.width'),
            config('settings.portfolio.image.' . $name . '.height')
        );
        return $fakeFileName;
    }
}
