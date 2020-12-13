<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Book;
use App\Models\Author;

class BookManagementTest extends TestCase
{
    use RefreshDatabase;
    // public function test_a_book_can_be_added_to_the_library_test() // phpunit
    /** @test */
    public function ABookCanBeAddedToTheLibrary() // Laravel
    {
        // $this->withoutExceptionHandling();

        $response = $this->post('/books', $this->adat());

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

        $response = $this->post('/books', array_merge($this->adat(), ['author_id' => '']));

        $response->assertSessionHasErrors('author_id');
    }
    /** @test */
    public function ABookCanBeUpdated()
    {
        // $this->withoutExceptionHandling();

        $this->post('/books', $this->adat());

        $book = Book::first();

        $response = $this->patch($book->path(), [
          'title' => 'New Title',
          'author_id' => 'New Author'
        ]);

        $this->assertEquals('New Title', Book::first()->title);
        $this->assertEquals(2, Book::first()->author_id);
        $response->assertRedirect($book->fresh()->path());

    }

    /** @test */
    public function ABookCanBeDeleted()
    {
        // $this->withoutExceptionHandling();

        $this->post('/books', $this->adat());

        $book = Book::first();
        $this->assertCount(1, Book::all());

        $response = $this->delete($book->path());

        $this->assertCount(0, Book::all());
        $response->assertRedirect('/books');
    }

    /** @test */
    public function ANewAuthorIsAutomaticallyAdded()
    {
        $this->withoutExceptionHandling();

        $this->post('/books', [
          'title' => 'Title of the Book',
          'author_id' => 'Author'
        ]);

        $book = Book::first();
        $author = Author::first();

        $this->assertEquals($author->id, $book->author_id);
        $this->assertCount(1, Author::all());
    }

    private function adat()
    {
        return [
          'title' => 'Title of the Book',
          'author_id' => 'Author',
        ];
    }
}
