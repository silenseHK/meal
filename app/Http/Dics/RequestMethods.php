<?php


namespace App\Http\Dics;


class RequestMethods
{

    protected static $data = [
        'GET' => [
            'value' => 1,
            'name' => 'GET'
        ],
        'POST' => [
            'value' => 2,
            'name' => 'POST'
        ],
        'PUT' => [
            'value' => 3,
            'name' => 'PUT'
        ],
        'DELETE' => [
            'value' => 4,
            'name' => 'DELETE'
        ],
    ];

    public static function value($type):int
    {
        return self::$data[$type]['value'];
    }

    public static function values():array
    {
        return array_map('array_shift',self::$data);
    }

}
