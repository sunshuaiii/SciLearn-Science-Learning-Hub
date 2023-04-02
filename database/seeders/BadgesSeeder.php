<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File; 
use Faker\Provider\Image;
use Faker\Factory as Faker;

class BadgesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $imagesPath = public_path('..\..\public\images\badge'); // Replace with your directory path 
        $images = File::allFiles($imagesPath);
        
        for ($i = 0; $i < count($images); $i++) { 
            $fileName = pathinfo($images[$i]->getPathname(), PATHINFO_FILENAME);
            $imagePath = $images[$i]->getPathname();
            DB::table('badges')->insert([ 
                'name' => $fileName, 
                'image' => Image::image($imagePath, 500, 500),
            ]); 
        }
    }
}
