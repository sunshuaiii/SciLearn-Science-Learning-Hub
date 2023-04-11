<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File; 

class ModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $moduleValues = ['famous-scientists', 'fun-facts', 'learning-center', 'challenges'];
        $imagesPath = public_path('images/module');
        $images = File::allFiles($imagesPath);

        for ($i = 0; $i < count($moduleValues); $i++) {
            $fileName = pathinfo($images[$i]->getPathname(), PATHINFO_FILENAME);
            $imagePath = $images[$i]->getPathname();
            DB::table('modules')->insert([
                'name' => $moduleValues[$i],
                'image' => $imagePath,
            ]);
        }
    }
}
