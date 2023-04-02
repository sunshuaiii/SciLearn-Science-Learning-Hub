<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TopicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $numberOfModules = DB::table('modules')->count();
        $tagValues = ['Physics', 'Chemistry', 'Biology', ''];

        for ($i = 0; $i < 10; $i++) { 
            DB::table('topics')->insert([ 
                'name' => $faker->sentence(), 
                'tag' => $faker->randomElement($tagValues), 
                'order' => $i + 1,
                'moduleId' => $faker->numberBetween(1, $numberOfModules),
            ]); 
        }
    }
}
