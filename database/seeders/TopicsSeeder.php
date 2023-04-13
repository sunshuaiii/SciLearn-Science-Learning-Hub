<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TopicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $tagValues = ['Physics', 'Chemistry', 'Biology', ''];

        for ($i = 0; $i < 40; $i++) {
            $tag = $faker->randomElement($tagValues);
            if ($tag != '') {
                $moduleId = 3;
            } else {
                $moduleId = $faker->numberBetween(1, 2);
            }
            DB::table('topics')->insert([
                'name' => $faker->sentence(),
                'tag' => $tag,
                'image' => 'https://picsum.photos/1000/400?random=' . rand(1, 1000),
                'order' => $i + 1,
                'module_id' => $moduleId,
            ]);
        }
    }
}
