<?php


namespace App\Repositories;


use App\Models\ArticleRating;
use Illuminate\Support\Facades\Auth;

class ArticleRateRepository
{
    protected $articleRating;

    public function __construct(ArticleRating $articleRating)
    {
        $this->articleRating = $articleRating;
    }

    public function rateCreate($rate, $id)
    {
        $articleRating = new $this->articleRating();
        $articleRating->user_id = Auth::id();
        $articleRating->article_id = $id;
        $articleRating->rate = $rate;
        $articleRating->save();

        return $articleRating->fresh();
    }

    public function rateUpdate(ArticleRating $articleRating, $rate): ArticleRating
    {
        $articleRating->rate = $rate;
        $articleRating->save();

        return $articleRating;
    }

    public function rateDispatch($rate, $id): ArticleRating
    {
        $articleRating = $this->articleRating->where('article_id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if ($articleRating)
        {
            return $this->rateUpdate($articleRating, $rate);
        }
        return $this->rateCreate($rate, $id);
    }
}
