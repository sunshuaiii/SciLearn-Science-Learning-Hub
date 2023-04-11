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

        $collectionIds = range(1, $numberOfCollections);
        $topicIds = range(1, $numberOfTopics);
        shuffle($collectionIds);
        shuffle($topicIds);

        $count = 0;
        $i = 0;
        $j = 0;

        while ($count < 20 && $i < count($collectionIds) && $j < count($topicIds)) {
            DB::table('collection_topics')->insert([
                'collection_id' => $collectionIds[$i],
                'topic_id' => $topicIds[$j]
            ]);
            $count++;
            $i++;
            $j++;
            // If we have exhausted the collections or topics array, shuffle it again to generate more random combinations
            if ($i >= count($collectionIds)) {
                shuffle($collectionIds);
                $i = 0;
            }
            if ($j >= count($topicIds)) {
                shuffle($topicIds);
                $j = 0;
            }
        }
    }
}
