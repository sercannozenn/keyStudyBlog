<?php


namespace App\Validator;


use Illuminate\Support\Facades\Validator;

abstract class ValidatorAbstract
{
    protected $fields = [];

    public function validate()
    {
        $validator = Validator::make(request()->all(), $this->fields);

        if (!$validator->passes())
        {
            return $validator->errors()->all();
        }
        return false;
    }
}
