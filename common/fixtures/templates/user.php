<?php

/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

try {
    return [
        'name' => $faker->firstName . ' ' . $faker->lastName,
        'email' => $faker->unique()->email,
        'password' => Yii::$app->getSecurity()->generatePasswordHash('123456'),
    ];
} catch (\yii\base\Exception $e) {
}
