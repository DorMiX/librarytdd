<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Author;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // $author = Author::factory()->create();
        return [
            'title' => $this->faker->sentence,
            // 'author_id' => $author->id,
            'author_id' => Author::factory(),
        ];
    }
}
