<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CrmClient;
use App\Model;
use Faker\Generator as Faker;

$factory->define(CrmClient::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'phone_number' => $faker->phoneNumber,
        'pesel' => $faker->unique()->numberBetween(10000000000, 99999999999),
        'gender' => rand(0, 1) == 0 ? 'M' : 'F',
        'birthday' => $faker->date,
        'birth_city' => $faker->city,
        'address_city' => $faker->city,
        'address_street' => $faker->streetAddress,
        'address_postal_code' => $faker->postcode,
        'address_house_number' => $faker->buildingNumber,
        'address_apartment_number' => rand(0, 1) == 0 ? null : $faker->buildingNumber,
    ];
});
