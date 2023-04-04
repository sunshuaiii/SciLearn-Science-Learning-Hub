<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $numberOfAvatars = DB::table('avatars')->count(); 
        
        for ($i = 0; $i < 10; $i++) { 
            DB::table('users')->insert([ 
                'username' => $faker->name(), 
                'email' => $faker->unique()->safeEmail(), 
                'password' => bcrypt('password'), 
                // is_admin attribute will be set to false by default
                'avatar_id' => $faker->numberBetween(1, $numberOfAvatars),
            ]); 
        }
    }
}
