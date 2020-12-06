<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Author;

class AuthorManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function AnAuthorCanBeCreated()
    {
        $this->withoutExceptionHandling();

        $this->post('/authors', [
            'name' => 'Author Name',
            'dob' => '05/19/1976'
        ]);

        $this->assertCount(1, Author::all());
    }
}
