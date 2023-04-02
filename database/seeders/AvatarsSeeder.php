<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File; 

class AvatarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $imagesPath = public_path('\images\avatar');  
        $images = File::allFiles($imagesPath);
        
        for ($i = 0; $i < count($images); $i++) { 
            $imagePath = $images[$i]->getPathname();
            DB::table('avatars')->insert([ 
                'image' => $imagePath,
            ]); 
        }
    }
}
