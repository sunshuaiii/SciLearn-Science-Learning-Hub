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
        $quizzes = DB::table('quizzes')->pluck('id')->toArray();

        // Loop through each user
        for ($i = 1; $i <= $numberOfUsers; $i++) {
            // Shuffle the quizzes array to randomize the order
            shuffle($quizzes);

            // Select the first 100 distinct quiz ids
            $userQuizIds = array_unique(array_slice($quizzes, 0, 100));

            // Loop through the selected quiz ids and insert each pair into the table
            foreach ($userQuizIds as $quizId) {
                DB::table('user_quizzes')->insert([
                    'user_id' => $i,
                    'quiz_id' => $quizId
                ]);
            }
        }
    }
}
