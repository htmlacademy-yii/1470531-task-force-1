<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

$faker->addProvider(new Faker\Provider\ru_RU\Text($faker));

return [
    'title' => $faker->word(),
];
