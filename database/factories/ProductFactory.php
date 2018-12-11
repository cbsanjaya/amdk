<?php

use Faker\Generator as Faker;

$factory->define(App\Entities\Product::class, function (Faker $faker) {
    return [
        'description' => $faker->title,
        'unit' => 'pcs',
        'cost_price' => 10000,
        'price' => 1000,
        'tobuy' => $faker->randomElement([true, false]),
        'tosell' => $faker->randomElement([true, false]),
        'raw' => $faker->randomElement([true, false]),
        'stock' => $faker->randomNumber(2),
    ];
});
