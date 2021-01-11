<?php


namespace App\Http\Services;


abstract class BaseService
{

    public $code = 200;

    public $msg = "";

    public $data = [];

    public static $STRING = 'string';
    public static $INT = 'int';
    public static $FLOAT = 'float';

    public function intInput(string $key, int $default=0):int
    {
        return intval(input($key, $default));
    }

    public function floatInput(string $key, float $default=0):float
    {
        return floatval(input($key, $default));
    }

    public function strInput(string $key, string $default=""):string
    {
        return filterStr(input($key, $default));
    }

    public function pageInput():int
    {
        return $this->intInput('page',1);
    }

    public function sizeInput(int $default=10):int
    {
        return $this->intInput('size', $default);
    }

    public function getData(array $keys):array
    {
        $data = [];
        foreach($keys as $key => $item){
            switch($item[0]){
                case 'string':
                    $default = $item[1]??"";
                    $method = 'strInput';
                    break;
                case 'int':
                    $default = $item[1]??0;
                    $method = 'intInput';
                    break;
                case 'float':
                    $default = $item[1]??0;
                    $method = 'floatInput';
                    break;
                default:
                    $default = $item[1]??"";
                    $method = 'strInput';
                    break;
            }
            $data[$key] = call_user_func_array([$this, $method], [$key, $default]);
        }
        return $data;
    }

}
