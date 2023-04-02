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

        for ($i = 0; $i < 10; $i++) { 
            DB::table('articles')->insert([ 
                'title' => $faker->sentence(), 
                'content' => $faker->paragraph(), 
                'image' => $faker->imageUrl(600, 400), 
                'topicId' => $faker->numberBetween(1, $numberOfTopics), 
            ]); 
        }
    }
}
