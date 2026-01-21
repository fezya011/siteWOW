<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        $categories = ['Technology', 'Design', 'Development', 'Tutorial', 'Vue.js', 'Testing'];
        $authors = [
            ['name' => 'John Doe', 'initials' => 'JD'],
            ['name' => 'Alex Smith', 'initials' => 'AS'],
            ['name' => 'Maria Johnson', 'initials' => 'MJ'],
            ['name' => 'Tom King', 'initials' => 'TK'],
            ['name' => 'Sarah Vance', 'initials' => 'SV'],
            ['name' => 'Robert Brown', 'initials' => 'RB'],
        ];

        $author = $this->faker->randomElement($authors);

        return [
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraphs(5, true),
            'excerpt' => $this->faker->sentence(),
            'category' => $this->faker->randomElement($categories),
            'author' => $author['name'],
            'author_initials' => $author['initials'],
            'likes' => $this->faker->numberBetween(0, 100),
            'comments' => $this->faker->numberBetween(0, 50),
            'created_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
