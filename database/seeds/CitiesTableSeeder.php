<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
         $cities_arr = [];

         for ($i=0; $i <= 10; $i++) { 
            $cities_arr[$i] = [
                'id' => $i,
                'city_name' => $faker->city
            ];
         }

         DB::table('cities')->insert($cities_arr);
    }
}
