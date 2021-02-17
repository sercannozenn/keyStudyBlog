<?php


namespace App\Services;


use App\Repositories\ArticleRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use InvalidArgumentException;

class ArticleService
{
    protected $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function allArticleData()
    {
        return $this->articleRepository->getAllArticle();
    }

    public function allArticleDataFront()
    {
        return $this->articleRepository->getAllArticleFront();
    }

    public function getById($id)
    {
        return $this->articleRepository->getById($id);
    }

    public function createArticleData($data)
    {
        return $this->articleRepository->createArticle($data);
    }

    public function updateArticle($id, $data)
    {
        DB::beginTransaction();
        try
        {
            $article = $this->articleRepository->updateArticle($id, $data);
        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            Log::error('Article Update Error');
            Log::error($exception->getMessage());
            throw new InvalidArgumentException($exception->getMessage());
        }
        DB::commit();

        return $article;
    }

    public function deleteById($id)
    {
        DB::beginTransaction();
        try
        {
            $article = $this->articleRepository->deleteById($id);
        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            Log::error('Article Delete Error');
            Log::error($exception->getMessage());
            throw new InvalidArgumentException($exception->getMessage());
        }
        DB::commit();

        return $article;
    }

    public function changeStatusById($id)
    {
        DB::beginTransaction();
        try
        {
            $article = $this->articleRepository->changeStatusById($id);
        }
        catch (\Exception $exception)
        {
            DB::rollBack();
            Log::error('Article Change Status Error');
            Log::error($exception->getMessage());
            throw new InvalidArgumentException($exception->getMessage());
        }
        DB::commit();

        return $article;
    }

    public static function prepareRequest(array $data): array
    {
        $data['slug'] = Str::slug($data['title']);
        $controlData = ['status', 'publish_now', 'publish_date'];
        foreach ($controlData as $item)
        {
            if (!array_search($item, array_keys($data)))
            {
                $data[$item] = null;
            }
        }
        if (!is_null($data['publish_date']))
        {
            $d = explode('/', explode(' ', $data['publish_date'])[0]);
            $publishDate = Carbon::parse($d[2] . $d[1] . $d[0] . explode(' ', $data['publish_date'])[1]);

            $data['publish_date'] = $publishDate;
        }


        return $data;
    }
}
