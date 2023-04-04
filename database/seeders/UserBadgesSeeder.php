<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UserBadgesSeeder extends Seeder
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
        $numberOfBadges = DB::table('badges')->count();  

        for ($i = 0; $i < 10; $i++) { 
            DB::table('userbadges')->insert([ 
                'user_id' => $faker->numberBetween(1, $numberOfUsers),
                'badge_id' => $faker->numberBetween(1, $numberOfBadges),
            ]); 
        }
    }
}
