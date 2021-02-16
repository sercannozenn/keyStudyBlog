<?php


namespace App\Services;


use App\Models\Article;
use App\Repositories\ArticleRateRepository;
use Illuminate\Support\Facades\Auth;

class ArticleRateService
{
    protected $articleRateRepository;

    public function __construct(ArticleRateRepository $articleRateRepository)
    {
        $this->articleRateRepository = $articleRateRepository;
    }

    public function createRate($rate, $id)
    {
        $control = $this->controlRateAuth();

        if ($control)
        {
            return $this->articleRateRepository->rateDispatch($rate, $id);
        }

        return response()->json()
            ->setData(['message' => 'Unauthorized.'])
            ->setStatusCode(401)
            ->setCharset('utf-8')
            ->header('Content-Type', 'application/javascript')
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function controlRateAuth(): bool
    {
        if (!Auth::check())
        {
            return false;
        }
        return true;
    }

    public function calcRate(Article $article)
    {

    }
}
