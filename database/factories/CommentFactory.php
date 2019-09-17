<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'text' => $faker->text,
        'user_id' => factory('App\User')->create()->id,
        'published' => rand(0, 1)
    ];
});
