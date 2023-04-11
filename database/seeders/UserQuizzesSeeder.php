<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UserQuizzesSeeder extends Seeder
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
        $numberOfQuizzes = DB::table('quizzes')->count(); 

        for ($i = 0; $i < 1000; $i++) { 
            DB::table('user_quizzes')->insert([ 
                'user_id' => $faker->numberBetween(1, $numberOfUsers),
                'quiz_id' => $faker->numberBetween(1, $numberOfQuizzes),
            ]); 
        }
    }
}
