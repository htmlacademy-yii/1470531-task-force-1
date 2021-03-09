<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

$faker->addProvider(new Faker\Provider\ru_RU\Text($faker));

return [
    'text' => $faker->realText($faker->numberBetween(200, 500)),
    'type' => $faker->word(),
    'task_id' => $faker->numberBetween(1, 20),
    'user_id' => $faker->numberBetween(1, 10),
];
