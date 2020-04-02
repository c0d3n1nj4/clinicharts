<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
  static $password;

  return [
    'username' => $faker->name,
    'email' => $faker->unique()->safeEmail,
    'password' => $password ?: $password = bcrypt('secret'),
    'lastname' => null,
    'firstname' => null,
    'remember_token' => str_random(10)
  ];
});

$factory->define(App\Patient::class, function (Faker\Generator $faker) {

  return [
    'first_name' => null,
    'middle_name' => null,
    'last_name' => null,
    'sex' => null,
    'birth_date' => null,
    'address' => null,
    'school' => null,
    'father_name' => null,
    'father_age' => null,
    'father_contact_no' => null,
    'mother_name' => null,
    'mother_age' => null,
    'mother_contact_no' => null,
    'picture' => null,
    'remember_token' => str_random(10)
  ];
});

$factory->define(App\BloodTypes::class, function (Faker\Generator $faker) {

  return [
    'name' => null,
    'name' => null,
    'name' => null,
    'name' => null,
    'name' => null,
    'name' => null,
    'name' => null,
    'name' => null,
    'remember_token' => str_random(10)
  ];
});