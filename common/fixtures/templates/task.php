<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

$faker->addProvider(new Faker\Provider\ru_RU\Text($faker));
$faker->addProvider(new Faker\Provider\Base($faker));
$faker->addProvider(new Faker\Provider\DateTime($faker));

return [
    'title' => $faker->realText($faker->numberBetween(50, 150)),
    'description' => $faker->realText($faker->numberBetween(200, 500)),
    'budget' => $faker->numberBetween(1000, 50000),
    'expire' => $faker->dateTimeBetween('-1 week', '+1 month')->format('Y-m-d H:i:s'),
    'latitude' => $faker->latitude,
    'longitude' => $faker->longitude,
    'address' => $faker->address,
    'category_id' => $faker->numberBetween(1, 20),
    'owner_id' => $faker->numberBetween(1, 10),
];
