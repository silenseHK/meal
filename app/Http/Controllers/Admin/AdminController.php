<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ValidatorException;
use App\Http\Controllers\Controller;
use App\Http\Services\Admin\AdminService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    private $adminService;

    public function __construct
    (
        AdminService $adminService
    )
    {
        $this->adminService = $adminService;
    }

    public function lists()
    {
        return 'lists';
    }

    public function detail($id)
    {
        return $id;
    }

    public function add()
    {
        $validator = Validator::make(inputs(), [
            'title' => ['required', 'max:30'],
            'account' => ['required', 'unique:admins,account', 'between:4,30'],
            'password' => ['required', 'between:6,30', 'alpha_dash'],
            'status' => ['required', 'in:0,1'],
            'role_id' => ['required', 'integer', 'gt:0']
        ]);
        if($validator->fails())
            throw new ValidatorException($validator->errors()->first());
        $this->adminService->add();
        return $this->serviceReturn($this->adminService);
    }

    public function edit($id)
    {
        return $id;
    }

    public function update($id)
    {
        $validator = Validator::make(inputs(), [
            'title' => ['required', 'max:30'],
            'account' => ['required', "unique:admins,account,{$id},admin_id", 'between:4,30'],
            'status' => ['required', 'in:0,1'],
            'role_id' => ['required', 'integer', 'gt:0']
        ]);
        if($validator->fails())
            throw new ValidatorException($validator->errors()->first());
        $this->adminService->update($id);
        return $this->serviceReturn($this->adminService);
    }

    public function delete($id)
    {
        return $id;
    }
}
