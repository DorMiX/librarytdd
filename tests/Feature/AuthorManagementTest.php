<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Author;
use Carbon\Carbon;

class AuthorManagementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function AnAuthorCanBeCreated()
    {
        // $this->withoutExceptionHandling();

        $this->post('/authors', [
            'name' => 'Author Name',
            'dob' => '05/19/1976'
        ]);

        $author = Author::all();

        $this->assertCount(1, $author);
        $this->assertInstanceOf(Carbon::class, $author->first()->dob);
        $this->assertEquals('1976/19/05', $author->first()->dob->format('Y/d/m'));
    }
}
