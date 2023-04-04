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

        for ($i = 0; $i < 200; $i++) { 
            DB::table('articles')->insert([ 
                'title' => $faker->sentence(), 
                'content' => $faker->paragraph(), 
                'image' => $faker->imageUrl($width = 640, $height = 480, 'science'),
                'topic_id' => $faker->numberBetween(1, $numberOfTopics), 
            ]); 
        }
    }
}
