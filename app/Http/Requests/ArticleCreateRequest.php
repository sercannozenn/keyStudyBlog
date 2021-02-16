<?php

namespace App\Http\Requests;

use App\Services\ArticleService;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class ArticleCreateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'title' => ['required', 'max:255'],
            'slug' => ['required', 'max:255', 'unique:articles'],
            'body' => ['required'],
        ];
    }

    protected function getValidatorInstance()
    {
        $data = $this->all();

        $data = ArticleService::prepareRequest($data);

        $this->getInputSource()->replace($data);

        return parent::getValidatorInstance();
    }
}
