<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Message::class, function (Faker $faker) {
    return [
        'id' => $faker->uuid,
        'user_id' =>\App\User::inRandomOrder()->limit(1)->get()->first()->id,
        'caption' => 'post text',
        'created_at' => now(),
    ];
});
