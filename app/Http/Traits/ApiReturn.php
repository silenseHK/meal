<?php


namespace App\Http\Traits;


use App\Http\Services\BaseService;

trait ApiReturn
{

    public $code = 200;

    public $msg = '';

    public $data = [];

    public function apiReturn($code=0, $msg='', $data=[]):\Illuminate\Http\JsonResponse
    {
        if(!$code)
            $code = $this->code;
        if(!$msg)
            $msg = $this->msg;
        if(is_array($data) && empty($data))
            $data = $this->data;
        return response()->json(compact('code','msg','data'));
    }

    public function serviceReturn(BaseService $service):\Illuminate\Http\JsonResponse
    {
        return $this->apiReturn(
            $service->code,
            $service->msg,
            $service->data
        );
    }

}
