<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Book;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    // public function test_a_book_can_be_added_to_the_library_test() // phpunit
    public function ABookCanBeAddedToTheLibrary() // Laravel
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/books', [
          'title' => 'A book title',
          'author' => 'Author of the book'
        ]);

        $response->assertOK();
        $this->assertCount(1, Book::all());
    }
    /** @test */
    public function ATitleIsRequired()
    {
        // $this->withoutExceptionHandling();

        $response = $this->post('/books', [
          'title' => '',
          'author' => 'Author of the book'
        ]);

        $response->assertSessionHasErrors('title');
    }
    /** @test */
    public function AnAuthorIsRequired()
    {
        // $this->withoutExceptionHandling();

        $response = $this->post('/books', [
          'title' => 'Title of the Book',
          'author' => ''
        ]);

        $response->assertSessionHasErrors('author');
    }
    /** @test */
    public function ABookCanBeUpdated()
    {
        $this->withoutExceptionHandling();

        $this->post('/books', [
          'title' => 'Title of the Book',
          'author' => 'Author'
        ]);

        $book = Book::first();

        $response = $this->patch('/books/' . $book->id, [
          'title' => 'New Title',
          'author' => 'New Author'
        ]);

        $this->assertEquals('New Title', Book::first()->title);
        $this->assertEquals('New Author', Book::first()->author);

    }
}
