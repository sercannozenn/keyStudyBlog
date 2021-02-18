<?php


namespace App\Repositories;


use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ArticleRepository
{
    protected $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function createArticle($data)
    {
        $data = (object)$data;
        $article = new $this->article;
        $article->title = $data->title;
        $article->body = $data->body;
        $article->user_id = auth()->id();
        $article->slug = Str::slug($data->title);
        $article->status = $data->status ? 1 : 0;
        $article->publish_date = $data->publish_now ? now() : ($data->publish_date ? $data->publish_date : now());

        $article->save();

        return $article->fresh();
    }

    public function getAllArticle()
    {
        return $this->article
            ->skipCache()
            ->UserArticles()
            ->with('user')
            ->orderBy('publish_date', 'DESC')
            ->paginate(10);
    }

    public function getAllArticleFront()
    {
        return $this->article
            ->with('user')
            ->StatusActive()
            ->Published()
            ->orderBy('publish_date', 'DESC')
            ->paginate(12);
    }

    public function getById($id)
    {
        return $this->article
            ->skipCache()
            ->UserArticles()
            ->findOrFail($id);
    }

    public function updateArticle($id, $data)
    {
        $data = (object)$data;
        $article = $this->article
            ->skipCache()
            ->UserArticles()
            ->findOrFail($id);
        $article->title = $data->title;
        $article->slug = $data->slug;
        $article->body = $data->body;
        $publishDate = Carbon::parse($article->publish_date);
        if ($publishDate > now())
        {
            $article->publish_date = $data->publish_now ? now() : $data->publish_date;
        }
        $article->status = $data->status ? 1 : 0;
        $article->save();

        return $article;
    }

    public function deleteById($id)
    {
        $article = $this->article
            ->skipCache()
            ->UserArticles()
            ->where('id', $id)
            ->firstOrFail();
        return $article->delete();
    }

    public function changeStatusById($id)
    {
        $article = $this->article
            ->skipCache()
            ->UserArticles()
            ->where('id', $id)
            ->firstOrFail();
        $article->status = $article->status ? 0 : 1;
        $article->save();
        return $article;
    }

}
