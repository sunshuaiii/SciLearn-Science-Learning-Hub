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

        // Generate an array of unique user and quiz IDs
        $userIds = range(1, $numberOfUsers);
        $quizIds = range(1, $numberOfQuizzes);

        // Shuffle the arrays to randomize the order
        shuffle($userIds);
        shuffle($quizIds);

        // Loop through the arrays and insert each unique pair into the table, up to 1000 iterations
        $count = 0;
        for ($i = 0; $i < count($userIds); $i++) {
            for ($j = 0; $j < count($quizIds); $j++) {
                DB::table('user_quizzes')->insert([
                    'user_id' => $userIds[$i],
                    'quiz_id' => $quizIds[$j]
                ]);
                $count++;
                if ($count >= 1000) {
                    break 2;
                }
            }
        }
    }
}
