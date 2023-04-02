<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $moduleValues = ['Famous Scientists', 'Fun Facts', 'Learning Center', 'Challenges'];

        for ($i = 0; $i < count($moduleValues); $i++) { 
            DB::table('modules')->insert([ 
                'name' => $moduleValues[$i], 
            ]); 
        }
    }
}
