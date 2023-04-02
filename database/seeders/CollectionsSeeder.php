<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CollectionsSeeder extends Seeder
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
            DB::table('collections')->insert([ 
                'name' => $faker->sentence(6, true), 
                'userId' => $faker->numberBetween(1, $numberOfUsers), 
            ]); 
        }
    }
}
