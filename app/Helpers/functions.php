<?php

function filterException(Exception $e):string
{
    return json_encode([
        'msg' => $e->getMessage(),
        'line' => $e->getLine(),
        'file' => $e->getFile(),
        'previous' => $e->getPrevious(),
        'params' => request()->input()
    ]);
}

function pageRule():array
{
    return [
        'page' => [
            'min:1',
            'integer'
        ],
        'size' => [
            'min:1',
            'max:20',
            'integer'
        ]
    ];
}

function filterStr(string $str):string
{
    return addslashes(strip_tags(trim($str)));
}

function input(string $key, $default)
{
    return request()->input($key, $default);
}

function inputs()
{
    return request()->input();
}

function model($model, $where)
{
    foreach($where as $key => $item){
        if(count($item) == 2){
            switch($item[0]){
                case '=':
                    $model = $model->where($key, $item[1]);
                    break;
                case 'BETWEEN':
                    $model = $model->whereBetween($key, $item[1]);
                    break;
                case 'in':
                    $model = $model->whereIn($key, $item[1]);
                    break;
                case 'IntegerInRaw':
                    $model = $model->whereIntegerInRaw($key,$item[1]);
                    break;
                case 'like':
                    $model = $model->where($key, 'like', $item[1]);
                    break;
            }
        }
    }
    return $model;
}
