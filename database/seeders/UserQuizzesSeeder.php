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

        for ($i = 1; $i <= $numberOfUsers; $i++) {
            $quizIds = $faker->unique()->randomElements(range(1, $numberOfQuizzes), $min = 100);
            foreach ($quizIds as $quizId) {
                DB::table('user_quizzes')->insert([
                    'user_id' => $i,
                    'quiz_id' => $quizId
                ]);
            }
        }
    }
}
