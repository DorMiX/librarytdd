<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Book;

class BookManagementTest extends TestCase
{
    use RefreshDatabase;
    // public function test_a_book_can_be_added_to_the_library_test() // phpunit
    /** @test */
    public function ABookCanBeAddedToTheLibrary() // Laravel
    {
        // $this->withoutExceptionHandling();

        $response = $this->post('/books', [
          'title' => 'A book title',
          'author' => 'Author of the book'
        ]);

        $book = Book::first();

        // $response->assertOK();
        $this->assertCount(1, Book::all());

        $response->assertRedirect($book->path());
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
        // $this->withoutExceptionHandling();

        $this->post('/books', [
          'title' => 'Title of the Book',
          'author' => 'Author'
        ]);

        $book = Book::first();

        $response = $this->patch($book->path(), [
          'title' => 'New Title',
          'author' => 'New Author'
        ]);

        $this->assertEquals('New Title', Book::first()->title);
        $this->assertEquals('New Author', Book::first()->author);
        $response->assertRedirect($book->fresh()->path());

    }

    /** @test */
    public function ABookCanBeDeleted()
    {
        // $this->withoutExceptionHandling();

        $this->post('/books', [
          'title' => 'Title of the Book',
          'author' => 'Author'
        ]);

        $book = Book::first();
        $this->assertCount(1, Book::all());

        $response = $this->delete($book->path());

        $this->assertCount(0, Book::all());
        $response->assertRedirect('/books');
    }
}
