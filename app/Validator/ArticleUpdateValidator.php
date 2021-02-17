<?php


namespace App\Validator;


use App\Services\ArticleService;
use Illuminate\Support\Facades\Validator;

class ArticleUpdateValidator extends ValidatorAbstract
{
    protected $data;

    public function __construct($data)
    {
        $this->fields = [
            'title' => 'required|max:255',
            'slug' => ['required', 'max:255', 'unique:articles,slug,' . $data['id']],
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
