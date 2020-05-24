<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Comment::class, function (Faker $faker) {
    return [
        'id' => $faker->uuid,
        'post_id' =>\App\Post::inRandomOrder()->limit(1)->get()->first()->id,
        'user_id' =>\App\User::inRandomOrder()->limit(1)->get()->first()->id,
        'caption' => 'comment text',
        'created_at' => now(),
    ];
});
