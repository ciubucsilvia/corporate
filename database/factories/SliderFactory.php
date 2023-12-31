<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use stdClass;
use Illuminate\Support\Facades\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slider>
 */
class SliderFactory extends Factory
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

        return [
            'title' => fake()->sentence(rand(3,8), true),
            'image' => json_encode($image),
            'description' => fake()->text(50),
            'active' => rand(0,1)
        ];
    }

    private function makeImage($name)
    {
        $path = public_path(env('THEME') . '/images/sliders');
        if(!file_exists($path)) {
            mkdir($path, 0755, true);
        }
        
        $fakeFileName = fake()->image(
            $path,
            config('settings.sliders.image.' . $name . '.width'),
            config('settings.sliders.image.' . $name . '.height')
        );
        return $fakeFileName;
    }
}
