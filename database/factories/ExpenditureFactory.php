<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Expenditure::class, function (Faker $faker) {
    $source = factory(\App\Models\Source::class)->create();
    $subcategory = factory(\App\Models\Subcategory::class)->create();
    return [
        'datetime'       => $faker->dateTimeThisMonth->format('Y-m-d H:i:s'),
        'location'       => $faker->company,
        'amount'         => $faker->randomFloat(2, 10, 1000),
        'source_id'      => $source->id,
        'subcategory_id' => $subcategory->id,
    ];
});
