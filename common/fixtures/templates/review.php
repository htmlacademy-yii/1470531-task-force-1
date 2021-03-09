<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

$faker->addProvider(new Faker\Provider\ru_RU\Text($faker));

return [
    'rate' => $faker->numberBetween(1, 5),
    'text' => $faker->text,
    'task_id' => $faker->numberBetween(1, 20),
    'user_id' => $faker->numberBetween(1, 10),
];
