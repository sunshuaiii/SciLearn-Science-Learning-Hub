<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ArticlesSeeder extends Seeder
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

        for ($i = 0; $i < 400; $i++) {
            $paragraphs = $faker->paragraphs(8);
            // Join sentences into paragraphs with 6 sentences each
            $content = '';
            foreach ($paragraphs as $paragraph) {
                $sentences = preg_split('/(?<=[.?!])\s+/', $paragraph);
                $chunks = array_chunk($sentences, 6);
                foreach ($chunks as $chunk) {
                    $content .= implode(' ', $chunk) . "\n\n";
                }
            }
            DB::table('articles')->insert([
                'title' => ucfirst($faker->words(5, true)),
                'content' => $content,
                'image' => $faker->imageUrl($width = 640, $height = 480, 'science'),
                'topic_id' => $faker->numberBetween(1, $numberOfTopics),
            ]);
        }
    }
}
