<?php

namespace App\Http\Controllers;

use App\Helper\RatingCalculatorHelper;
use App\Models\Article;
use App\Services\ArticleRateService;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    protected $articleService, $articleRateService;

    public function __construct(ArticleService $articleService, ArticleRateService $articleRateService)
    {
        $this->articleService = $articleService;
        $this->articleRateService = $articleRateService;
    }

    public function index()
    {
        $list = $this->articleService->allArticleDataFront();

        return view('front.index', compact('list'));
    }

    public function articleDetail(Article $article)
    {
        return view('front.article_detail', compact('article'));
    }

    public function articleRate(Request $request)
    {
        $rate = $request->rate;
        $id = $request->id;

        return $this->articleRateService->createRate($rate, $id);
    }
}
