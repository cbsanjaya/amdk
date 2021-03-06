<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    $price = $faker->numberBetween(1000, 3000);

    return [
        'description' => $faker->sentence,
        'unit'        => 'pcs',
        'cost_price'  => $price * 9,
        'price'       => $price * 10,
        'tobuy'       => $faker->randomElement([true, false]),
        'tosell'      => $faker->randomElement([true, false]),
        'raw'         => $faker->randomElement([true, false]),
    ];
});

$factory->state(App\Models\Product::class, 'product', [
    'tobuy'  => false,
    'tosell' => true,
    'raw'    => false,
]);

$factory->state(App\Models\Product::class, 'raw', [
    'tobuy'  => true,
    'tosell' => false,
    'raw'    => true,
]);
