<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleRating;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ArticleRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($i = 0; $i < 12; $i++)
        {
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt($faker->password)
            ]);
            $user->syncRoles('Reader');
        }

        $articles = Article::StatusActive()->Published()->get();
        foreach ($articles as $article)
        {
            for ($i = 0; $i < 12; $i++)
            {
                ArticleRating::create([
                    'article_id' => $article->id,
                    'user_id' => $i + 2,
                    'rate' => rand(1, 5)
                ]);
            }
        }

    }
}
