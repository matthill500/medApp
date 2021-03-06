<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Patient;
use Faker\Generator as Faker;

$factory->define(Patient::class, function (Faker $faker) {
    return [
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'medInsurance' => $faker->company,
    ];
});
