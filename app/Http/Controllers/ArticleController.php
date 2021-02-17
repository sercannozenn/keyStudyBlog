<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleCreateRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Services\ArticleService;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    protected $articleService, $authService;
    protected $responseResult = ['status' => 200];

    public function __construct(ArticleService $articleService, AuthService $authService)
    {
        $this->articleService = $articleService;
        $this->authService = $authService;
    }

    public function index()
    {
        $list = $this->articleService->allArticleData();
        return view('admin.article_list', compact('list'));
    }

    public function store(ArticleCreateRequest $request)
    {
        $this->responseResult = ['status' => 200];
        $data = $request->only('title', 'body', 'publish_date', 'status', 'publish_now', 'slug');
        $guard = $this->authService->guard();

        try
        {
            $this->responseResult['data'] = $this->articleService->createArticleData($data);
        }
        catch (\Exception $exception)
        {
            $this->responseResult = [
                'status' => 500,
                'exceptionMessage' => $exception->getMessage()
            ];
            if ($guard == 'api')
                return response()->json()
                    ->setData($this->responseResult['exceptionMessage'])
                    ->setStatusCode($this->responseResult['status'])
                    ->setCharset('utf-8')
                    ->header('Content-Type', 'application/javascript')
                    ->setEncodingOptions(JSON_UNESCAPED_UNICODE);
            else if ($guard == 'web')
                abort($this->responseResult['status'], $this->responseResult['exceptionMessage']);
        }

        switch ($guard)
        {
            case 'web':
                alert('Success', 'The article was created', 'success');
                return redirect()->route('article.list');
            case 'api':
                    return response()->json()
                        ->setData($this->responseResult['data'])
                        ->setStatusCode($this->responseResult['status'])
                        ->setCharset('utf-8')
                        ->header('Content-Type', 'application/javascript')
                        ->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }
    }

    public function create()
    {
        return view('admin.article_create_edit');
    }

    public function edit(Request $request, $id)
    {
        $guard = $this->authService->guard();

        $article = $this->articleService->getById($id);

        switch ($guard)
        {
            case 'web':
                return view('admin.article_create_edit', compact('article'));
            case 'api':
                return response()->json()
                    ->setData($article)
                    ->setStatusCode(200)
                    ->setCharset('utf-8')
                    ->header('Content-Type', 'application/javascript')
                    ->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }
    }

    public function update(ArticleUpdateRequest $request, $id)
    {
        $data = $request->only('title', 'body', 'publish_date', 'status', 'publish_now', 'slug');
        $guard = $this->authService->guard();

        try
        {
            $this->responseResult['data'] = $this->articleService->updateArticle($id, $data);
        }
        catch (\Exception $exception)
        {
            $this->responseResult = [
                'status' => 500,
                'exceptionMessage' => $exception->getMessage()
            ];
            if ($guard == 'api')
                return response()->json()
                    ->setData($this->responseResult['exceptionMessage'])
                    ->setStatusCode($this->responseResult['status'])
                    ->setCharset('utf-8')
                    ->header('Content-Type', 'application/javascript')
                    ->setEncodingOptions(JSON_UNESCAPED_UNICODE);
            else if ($guard == 'web')
                abort($this->responseResult['status'], $this->responseResult['exceptionMessage']);
        }

        switch ($guard)
        {
            case 'web':
                alert('Success', 'The article was updated', 'success');
                return redirect()->route('article.list');
            case 'api':
                return response()->json()
                    ->setData($this->responseResult['data'])
                    ->setStatusCode($this->responseResult['status'])
                    ->setCharset('utf-8')
                    ->header('Content-Type', 'application/javascript')
                    ->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        try
        {
            $this->responseResult['data'] = $this->articleService->deleteById($id);
        }
        catch (\Exception $exception)
        {
            return response()->json()
                ->setData($this->responseResult['exceptionMessage'])
                ->setStatusCode($this->responseResult['status'])
                ->setCharset('utf-8')
                ->header('Content-Type', 'application/javascript')
                ->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }

        return response()->json()
            ->setData($this->responseResult['data'])
            ->setStatusCode($this->responseResult['status'])
            ->setCharset('utf-8')
            ->header('Content-Type', 'application/javascript')
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE);

    }

    public function show(Request $request, $id)
    {
        $guard = $this->authService->guard();

        $article = $this->articleService->getById($id);

        switch ($guard)
        {
            case 'web':
                return view('admin.article_show', compact('article'));
            case 'api':
                return response()->json()
                    ->setData($article)
                    ->setStatusCode(200)
                    ->setCharset('utf-8')
                    ->header('Content-Type', 'application/javascript')
                    ->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }
    }
}
