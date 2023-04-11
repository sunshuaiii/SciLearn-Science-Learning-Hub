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

        for ($i = 0; $i < 20; $i++) { 
            DB::table('collection_topics')->insert([ 
                'collection_id' => $faker->numberBetween(1, $numberOfCollections),
                'topic_id' => $faker->numberBetween(1, $numberOfTopics),
            ]); 
        }
    }
}
