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

        $this->post('/authors', $this->authorData());

        $author = Author::all();

        $this->assertCount(1, $author);
        $this->assertInstanceOf(Carbon::class, $author->first()->dob);
        $this->assertEquals('1976/19/05', $author->first()->dob->format('Y/d/m'));
    }

    /** @test */
    public function ANameIsRequired()
    {
        // $this->withoutExceptionHandling();

        $response = $this->post('/authors', array_merge($this->authorData(), ['name' => '']));

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function ADobIsRequired()
    {
        // $this->withoutExceptionHandling();

        $response = $this->post('/authors', array_merge($this->authorData(), ['dob' => '']));

        $response->assertSessionHasErrors('dob');
    }

    private function authorData()
    {
        return [
            'name' => 'Author Name',
            'dob' => '05/19/1976'
        ];
    }
}
