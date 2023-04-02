<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $moduleValues = ['Famous Scientists', 'Fun Facts', 'Learning Center', 'Challenges'];

        for ($i = 0; $i < 4; $i++) { 
            DB::table('modules')->insert([ 
                'name' => $faker->randomElement($moduleValues), 
            ]); 
        }
    }
}
