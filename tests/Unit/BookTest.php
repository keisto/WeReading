<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Book;
use App\Models\User;

class BookTest extends TestCase
{
    /**
     * @test
     */
    public function itIsOrderedBySortOrder(): void
    {
        $user = factory(User::class)->create();

        $books = factory(Book::class, 3)->create(['user_id' => $user->id]);

        $books->first()->update(['sort_order' => 3]);
        $books->last()->update(['sort_order' => 1]);

        $this->assertEquals($books->last()->title, $user->books()->ordered()->first()->title);
    }

    /**
     * @test
     */
    public function itBelongsToAUser(): void
    {
        $book = factory(Book::class)->create([
            'user_id' => factory(User::class)
        ]);

        $this->assertInstanceOf(User::class, $book->user);
    }
}
