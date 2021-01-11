<?php

namespace App\Http\Controllers\Manage;

use App\Exceptions\ValidatorException;
use App\Http\Controllers\Controller;
use App\Http\Dics\RequestMethods;
use App\Http\Services\Manage\AccessService;
use Illuminate\Support\Facades\Validator;

class AccessController extends Controller
{

    protected $AccessService;

    public function __construct
    (
        AccessService $AccessService
    )
    {
        $this->AccessService = $AccessService;
    }

    public function lists():\Illuminate\Http\JsonResponse
    {
        $validator = Validator::make(inputs(), pageRule());
        if($validator->fails())
            throw new ValidatorException($validator->errors()->first());
        $this->AccessService->getLists();
        return $this->serviceReturn($this->AccessService);

    }

    public function first($id)
    {
        return $id;
    }

    public function add()
    {
        $validator = Validator::make(inputs(), [
            'title' => ['required', 'between:1,20', 'alpha_dash'],
            'methods' => ['required', 'in:'.implode(',', RequestMethods::values())],
            'uri' => ['required', 'between:1,100'],
            'pid' => ['required', 'integer', 'min:0'],
            'is_include' => ['required', 'integer', 'in:0,1']
        ]);
        if($validator->fails())
            throw new ValidatorException($validator->errors()->first());
        $this->AccessService->add();
        return $this->serviceReturn($this->AccessService);
    }

    public function edit($id)
    {
        return $id;
    }

    public function update($id)
    {
        return $id;
    }

    public function delete($id)
    {
        return $id;
    }
}
