<?php

namespace Database\Seeders;

use App\Models\Article;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($i = 0; $i < 100; $i++)
        {
            $title=$faker->text(50);
            Log::info($title);
            Article::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'body' => $faker->paragraph(rand(2, 4)),
                'status' => $i % 10 == 0 ? 0 : 1,
                'user_id' => rand(1,2),
                'publish_date' => $faker->dateTimeBetween('-1 years', '+1 years')
            ]);
        }
    }
}
