<?php


namespace App\Validator;


use Illuminate\Support\Facades\Validator;

class LoginValidator extends ValidatorAbstract
{
    public function __construct()
    {
        $this->fields = [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }


}
