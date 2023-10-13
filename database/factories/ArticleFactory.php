<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use stdClass;
use Illuminate\Support\Facades\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
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
            'title' => fake()->sentence(rand(3,8), true),
            'image' => json_encode($image),
            'category_id' => rand(1, 10),
            'user_id'   => 1,
            'text' => fake()->text(1500),
            'is_published' => $isPublished,
            'published_at'  => $isPublished 
                ? fake()->dateTimeBetween('-2 months', now()) 
                : null,
            'created_at' => fake()->dateTimeBetween('-2 months', now())
        ];
    }

    private function makeImage($name)
    {
        $path = public_path(env('THEME') . '/images/articles');
        if(!file_exists($path)) {
            mkdir($path, 0755, true);
        }
    
        $fakeFileName = fake()->image(
            $path,
            config('settings.articles.image.' . $name . '.width'),
            config('settings.articles.image.' . $name . '.height')
        );
        return $fakeFileName;
    }
}
