<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
            'caption' => $faker->name,
            'image' => $faker->imageUrl($width = 640, $height = 480),
            'user_id' => factory(User::class)
    ];
});
