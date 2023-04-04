<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class LeaderboardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $numberOfUsers = DB::table('users')->count(); 

        for ($i = 0; $i < 10; $i++) { 
            DB::table('leaderboards')->insert([ 
                'user_id' => $faker->numberBetween(1, $numberOfUsers),
                'rank' => $i + 1,
            ]); 
        }
    }
}
