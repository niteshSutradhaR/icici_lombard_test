<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TravellersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $travellers_arr = [];

        for ($i=0; $i <= 10; $i++) { 
           $travellers_arr[$i] = [
               'id' => $i+1,
               'traveller_name' => $faker->name
           ];
        }

        DB::table('travellers')->insert($travellers_arr);
    }
}
