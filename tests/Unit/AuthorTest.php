<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Author;

class AuthorTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function ADobIsNullable()
    {
        $this->withoutExceptionHandling();

        Author::firstOrCreate([
            'name' => 'John Doe',
        ]);

        $this->assertCount(1, Author::all());
    }
}
