<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Models\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    return [
        'subject' => $faker->sentence,
        'body' => $faker->paragraph,
        'user_id_from' => rand(1,5),
        'user_id_to' => rand(1,5),
        'read' => $faker->boolean(0),
        'deleted' => $faker->boolean(0),
    ];
});
