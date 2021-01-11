<?php


namespace App\Exceptions;


class ValidatorException extends \Exception
{

    public $message = '';

    public function __construct($message='参数错误')
    {
        $this->message = $message;
    }

}
