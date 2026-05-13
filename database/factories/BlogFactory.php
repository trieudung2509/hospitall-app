<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = \App\Blog::class;

    public function definition()
    {
        return [
            'title' =>  $this->faker->realText(30),
            'slug'  => $this->faker->slug,
            'short_description' => $this->faker->realText(100),
            'description' => $this->faker->realText(500),
            'published_date' => Carbon::now(),
            'meta_title' => $this->faker->realText(20),
            'meta_description' => $this->faker->realText(50),
            'meta_keywords' => $this->faker->realText(30),
            'status' => 1,
            'category_id' => $this->faker->numberBetween(3, 8),
            'user_id'  => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ];
    }
}
