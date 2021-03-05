<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

$faker->addProvider(new Faker\Provider\ru_RU\Text($faker));
$faker->addProvider(new Faker\Provider\Base($faker));
$faker->addProvider(new Faker\Provider\Internet($faker));

return [
    'last_login' => $faker->dateTimeThisMonth->format('Y-m-d H:i:s'),
    'birthday' => $faker->dateTimeBetween('-60 years', '-18 years')->format('Y-m-d H:i:s'),
    'about' => $faker->realText($faker->numberBetween(200, 500)),
    'phone' => substr($faker->e164PhoneNumber, 1, 11),
    'skype' => $faker->userName,
    'telegram' => $faker->userName,
    'avatar' => null,
    'address' => $faker->address,
    'user_id' => $faker->unique()->numberBetween(1, 10),
];
