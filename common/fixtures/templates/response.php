<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

return [
    'task_id' => $faker->unique()->numberBetween(1, 20),
    'executor_id' => $faker->numberBetween(1, 10),
];
