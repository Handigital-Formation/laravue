<?php

use Faker\Generator as Faker;

$factory->define(App\Pensee::class, function (Faker $faker) {
    $users = App\User::pluck('id')->toArray();
    return [
        'user_id' => $faker->randomElement($users),
        'text' => $faker->text,
    ];
});
