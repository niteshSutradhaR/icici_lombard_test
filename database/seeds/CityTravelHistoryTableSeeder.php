<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class CityTravelHistoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $history_arr = [];

        for ($i=0; $i <= 10; $i++) { 
            $to_date = $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now', $timezone = null);
            
            $from_date = date('Y-m-d',strtotime($to_date->format('Y-m-d')." - 15 days" ));

            $history_arr[$i] = [
               'id' => $i+1,
               'traveller_id' => $faker->numberBetween(1,11),
               'city_id' => $faker->numberBetween(1,12),
               'from_date' => $from_date,
               'to_date' => $to_date,
            ];
        }

        DB::table('city_travel_history')->insert($history_arr);
    }
}
