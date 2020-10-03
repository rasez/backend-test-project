<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'parent_id' => null,
        'description' => $faker->sentence,
        'created_at' => now()
    ];
});
