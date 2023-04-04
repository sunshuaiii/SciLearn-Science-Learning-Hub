<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $numberOfQuizzes = DB::table('quizzes')->count(); 

        for ($i = 0; $i < 10; $i++) { 
            DB::table('questions')->insert([ 
                'question' => $faker->sentence().'?', 
                'option1' => $faker->sentence(),
                'option2' => $faker->sentence(),
                'option3' => $faker->sentence(),
                'option4' => $faker->sentence(),
                'answer' => $faker->numberBetween(1, 4),
                'quiz_id' => $faker->numberBetween(1, $numberOfQuizzes),
            ]); 
        }
    }
}
