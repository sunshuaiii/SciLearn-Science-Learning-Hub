<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CollectionTopicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $numberOfCollections = DB::table('collections')->count(); 
        $numberOfTopics = DB::table('topics')->count(); 

        for ($i = 0; $i < 10; $i++) { 
            DB::table('collectiontopics')->insert([ 
                'collectionId' => $faker->numberBetween(1, $numberOfCollections),
                'topicId' => $faker->numberBetween(1, $numberOfTopics),
            ]); 
        }
    }
}