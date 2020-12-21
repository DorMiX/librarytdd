<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Book;
use App\Models\Reservation;

class BookCheckoutTest extends TestCase
{
    use RefreshDatabase;

    /** @test
     * A basic feature test example.
     *
     * @return void
     */
    public function ABookCanBeCheckedOutByASignedUser()
    {
        // $this->withoutExceptionHandling();

        $book = Book::factory()->create();

        $this->actingAs($user = User::factory()->create())
            ->post('/checkout/'. $book->id);

        $this->assertCount(1, Reservation::all());
        $this->assertEquals($user->id, Reservation::first()->user_id);
        $this->assertEquals($book->id, Reservation::first()->book_id);
        $this->assertEquals(now(), Reservation::first()->checked_out_at);
    }

    /** @test
     * A basic feature test example.
     *
     * @return void
     */
    public function OnlySignedInUserCanCheckoutABook()
    {
        // $this->withoutExceptionHandling();

        $book = Book::factory()->create();

        $this->post('/checkout/'. $book->id)->assertRedirect('/login');

        $this->assertCount(0, Reservation::all());
    }

    /** @test
     * A basic feature test example.
     *
     * @return void
     */
    public function OnlyRealBooksCanBeCheckedOut()
    {
        // $this->withoutExceptionHandling();

$this->actingAs($user = User::factory()->create())
            ->post('/checkout/9')
            ->assertStatus(404);

        $this->assertCount(0, Reservation::all());
    }
}
