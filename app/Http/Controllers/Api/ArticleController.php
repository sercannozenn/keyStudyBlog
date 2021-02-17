<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ArticleService;
use App\Services\AuthService;
use App\Validator\ArticleCreateValidator;
use App\Validator\ArticleUpdateValidator;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected $articleService, $authService;
    protected $responseResult = ['status' => 200];

    public function __construct(ArticleService $articleService, AuthService $authService)
    {
        $this->articleService = $articleService;
        $this->authService = $authService;
    }

    public function index(Request $request)
    {
        $list = $this->articleService->allArticleDataFront();
        return response()->json()
            ->setData($list)
            ->setStatusCode(200)
            ->setCharset('utf-8')
            ->header('Content-Type', 'application/javascript')
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function store(Request $request)
    {
        $data = $request->only('title', 'body', 'publish_date', 'status', 'publish_now', 'slug');
        $data = $this->articleService->prepareRequest($data);

        $validator = new ArticleCreateValidator($data);
        $this->responseResult['status'] = 200;
        if ($response = $validator->validate())
            return $response;

        try
        {
            $this->responseResult['data'] = $this->articleService->createArticleData($data);
        }
        catch (\Exception $exception)
        {
            $this->responseResult = ['status' => 500, 'exceptionMessage' => $exception->getMessage()];
        }
        return response()->json()
            ->setData($this->responseResult)
            ->setStatusCode($this->responseResult['status'])
            ->setCharset('utf-8')
            ->header('Content-Type', 'application/javascript')
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('title', 'body', 'publish_date', 'status', 'publish_now', 'slug', 'id');
        $data['id'] = $id;
        $data = $this->articleService->prepareRequest($data);
        $validator = new ArticleUpdateValidator($data);
        $this->responseResult['status'] = 200;
        if ($response = $validator->validate())
            return $response;

        try
        {
            $this->responseResult['data'] = $this->articleService->updateArticle($id, $data);
        }
        catch (\Exception $exception)
        {
            $this->responseResult = ['status' => 500, 'exceptionMessage' => $exception->getMessage()];
        }

        return response()->json()
            ->setData($this->responseResult)
            ->setStatusCode($this->responseResult['status'])
            ->setCharset('utf-8')
            ->header('Content-Type', 'application/javascript')
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE);
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
            $this->responseResult = ['status' => 500, 'exceptionMessage' => $exception->getMessage()];
        }

        return response()->json()
            ->setData($this->responseResult)
            ->setStatusCode($this->responseResult['status'])
            ->setCharset('utf-8')
            ->header('Content-Type', 'application/javascript')
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function changeStatus(Request $request)
    {
        $id = $request->id;
        try
        {
            $this->responseResult['data'] = $this->articleService->changeStatusById($id);
        }
        catch (\Exception $exception)
        {
            $this->responseResult = ['status' => 500, 'exceptionMessage' => $exception->getMessage()];

        }

        return response()->json()
            ->setData($this->responseResult)
            ->setStatusCode($this->responseResult['status'])
            ->setCharset('utf-8')
            ->header('Content-Type', 'application/javascript')
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

}
