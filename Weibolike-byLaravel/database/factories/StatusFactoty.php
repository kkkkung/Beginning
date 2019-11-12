<?php

use Faker\Generator as Faker;

$factory->define(App\Status::class, function (Faker $faker) {
    $date_time = $faker->dateTime();
    return [
        'content' => $faker->text(),
        'created_at' => $date_time,
        'updated_at' => $date_time,
    ];
});
