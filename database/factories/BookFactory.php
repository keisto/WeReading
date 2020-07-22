<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'lookup_id' => $faker->uuid,
        'title' => $faker->sentence,
        'authors' => $faker->name,
        'image' => config('book')['placeholder']['src']
    ];
});
