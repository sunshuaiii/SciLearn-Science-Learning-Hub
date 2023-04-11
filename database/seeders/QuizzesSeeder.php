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
        $articleTitles = DB::table('articles')->pluck('title');

        for ($i = 0; $i < 400; $i++) {
            DB::table('quizzes')->insert([
                'name' => "Quiz " . $articleTitles[$i],
                'article_id' => $i + 1,
            ]);
        }
    }
}
