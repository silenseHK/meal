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
        $this->AccessService->getLists();
        return $this->serviceReturn($this->AccessService);

    }

    public function detail(int $id)
    {
        $this->AccessService->detail($id);
        return $this->serviceReturn($this->AccessService);
    }

    public function add()
    {
        $validator = Validator::make(inputs(), [
            'title' => ['required', 'between:1,20', 'alpha_dash'],
            'methods' => ['required', 'in:'.implode(',', RequestMethods::values())],
            'uri' => ['required', 'between:1,100'],
            'cid' => ['required', 'integer', 'min:0'],
        ]);
        if($validator->fails())
            throw new ValidatorException($validator->errors()->first());
        $this->AccessService->add();
        return $this->serviceReturn($this->AccessService);
    }

    public function update(int $id) //全量更新
    {
        $validator = Validator::make(inputs(), [
            'title' => ['required', 'between:1,20', 'alpha_dash'],
            'methods' => ['required', 'in:'.implode(',', RequestMethods::values())],
            'uri' => ['required', 'between:1,100'],
            'cid' => ['required', 'integer', 'min:0'],
        ]);
        if($validator->fails())
            throw new ValidatorException($validator->errors()->first());
        $this->AccessService->update($id);
        return $this->serviceReturn($this->AccessService);
    }

    public function delete($id)
    {
        $this->AccessService->delete($id);
        return $this->serviceReturn($this->AccessService);
    }
}
