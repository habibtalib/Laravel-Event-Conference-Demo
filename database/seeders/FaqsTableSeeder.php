<?php

namespace Database\Seeders;

use App\Faq;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class FaqsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach(range(1, 6) as $key)
        {
            Faq::create([
                'question' => $faker->sentence,
                'answer' => $faker->paragraph
            ]);
        }
    }
}
