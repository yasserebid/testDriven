<?php

namespace Tests\Feature;

use App\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;



    /** @test */
    public function a_book_can_be_added_to_library()
    {
        $response = $this->post("/book", [
            "title" => "Holly quran Tafseer",
            "auther" => "Ebn Katheer"
        ]);
        $response->assertOk();
        $this->assertCount(1, Book::all());
    }

    /** @test */
    public function a_title_is_required()
    {

        $response = $this->post("/book", [
            "title" => "",
            "auther" => "Ebn Katheer"
        ]);

        $response->assertSessionHasErrors('title');
    }

    /** @test */
    public function an_auther_is_required()
    {
        $response = $this->post("/book", [
            "title" => "Holly quran Tafseer",
            "auther" => ""
        ]);

        $response->assertSessionHasErrors('auther');
    }

    /** @test */
    public function an_book_can_be_updated()
    {
        $this->post("/book", [
            "title" => "Holly quran Tafseer",
            "auther" => "Ebn Katheer"
        ]);

        $book = Book::first();

        $response = $this->patch('/book/' . $book->id, [
            "title" => "Begining and End",
            "auther" => "SomeOne"
        ]);

        $this->assertEquals('Begining and End', Book::first()->title);
        $this->assertEquals('SomeOne', Book::first()->auther);
    }
}
