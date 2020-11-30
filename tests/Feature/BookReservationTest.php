<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Book;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;
    /** @test **/
    // public function test_a_book_can_be_added_to_the_library_test() // phpunit
    public function testABookCanBeAddedToTheLibraryTest() // Laravel
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/books', [
          'title' => 'A book title',
          'author' => 'Author of the book'
        ]);

        $response->assertOK();
        $this->assertCount(1, Book::all());
    }
}
