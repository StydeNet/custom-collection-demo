<?php

use Faker\Generator as Faker;

$factory->define(App\Transaction::class, function (Faker $faker) {
    return [
        'amount' => $faker->numberBetween(10, 100),
    ];
});
