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
                'name' => $faker->name, 
                'email' => $faker->unique()->safeEmail, 
                'password' => bcrypt('password'), 
                'quizId' => $faker->numberBetween(1, $numberOfQuizzes),
            ]); 
        }
    }
}
