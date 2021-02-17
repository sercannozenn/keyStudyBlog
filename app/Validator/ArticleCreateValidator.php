<?php


namespace App\Validator;


use App\Services\ArticleService;
use Illuminate\Support\Facades\Validator;

class ArticleCreateValidator extends ValidatorAbstract
{
    protected $data;

    public function __construct($data)
    {
        $this->fields = [
            'title' => 'required|max:255',
            'slug' => 'unique:articles|required|max:255',
            'body' => 'required'
        ];
        $this->data = $data;
    }

    public function validate()
    {
        $validator = Validator::make($this->data, $this->fields);

        if (!$validator->passes())
        {
            return $validator->errors()->all();
        }
        return false;
    }
}
