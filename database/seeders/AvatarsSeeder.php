<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File; 
use Faker\Provider\Image;
use Faker\Factory as Faker;

class AvatarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $imagesPath = public_path('\images\avatar'); // Replace with your directory path 
        $images = File::allFiles($imagesPath);
        
        for ($i = 0; $i < count($images); $i++) { 
            $imagePath = $images[$i]->getPathname();
            DB::table('avatars')->insert([ 
                'image' => Image::image($imagePath, 500, 500),
            ]); 
        }
    }
}
