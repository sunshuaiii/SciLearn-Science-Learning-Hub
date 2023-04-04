<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File; 
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
        //$imagesPath = public_path('\images\article');
        $imagesPath = public_path('\images\avatar');
        $images = File::allFiles($imagesPath);
        $numberOfTopics = DB::table('topics')->count(); 

        for ($i = 0; $i < count($images); $i++) { 
            $imagePath = $images[$i]->getPathname();
            DB::table('articles')->insert([ 
                'title' => $faker->sentence(), 
                'content' => $faker->paragraph(), 
                'image' => $imagePath,
                'topic_id' => $faker->numberBetween(1, $numberOfTopics), 
            ]); 
        }
    }
}
