<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class QuizzesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $numberOfTopics = DB::table('topics')->count();

        for ($i = 0; $i < 10; $i++) { 
            DB::table('quizzes')->insert([ 
                'name' => "Quiz ".$i + 1, 
                'topicId' => $faker->numberBetween(1, $numberOfTopics),
            ]); 
        }
    }
}
