<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Book;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * @test
     */
    public function itHasManyBooks(): void
    {
        $user = factory(User::class)->create();

        $user->books()->saveMany([
            factory(Book::class)->make(),
            factory(Book::class)->make()
        ]);

        $this->assertCount(2, $user->books);
    }
}
