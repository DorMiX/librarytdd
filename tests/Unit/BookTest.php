<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function AnAuthorIdIsRecorded()
    {
        Book::create([
            'title' => 'Book title',
            'author_id' => 1,
        ]);

        $this->assertCount(1, Book::all());
    }
}
