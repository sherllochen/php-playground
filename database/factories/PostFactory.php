<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title(),
            'category' => $this->faker->city(),
            'content' => $this->faker->text(300),
            'abstract' => $this->faker->text(30),
            'html_content' => $this->faker->text(300),
            'page_id' => $this->faker->unique()->uuid(),
            'published_date' => now()
        ];
    }
}
