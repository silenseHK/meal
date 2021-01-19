<?php


namespace App\Http\Controllers\Admin;


use App\Exceptions\ValidatorException;
use App\Http\Controllers\Controller;
use App\Http\Services\Admin\RoleService;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{

    private $roleService;

    public function __construct
    (
        RoleService $roleService
    )
    {
        $this->roleService = $roleService;
    }

    public function lists()
    {

    }

    public function detail(int $id)
    {
        echo request()->route()->uri();
    }

    public function add()
    {
        $validator = Validator::make(inputs(), [
            'title' => ['required', 'max:30', 'unique:roles,title'],
            'access' => ['array']
        ]);
        if($validator->fails())
            throw new ValidatorException($validator->errors()->first());
        $this->roleService->add();
        return $this->serviceReturn($this->roleService);
    }

    public function update(int $id)
    {
        $validator = Validator::make(inputs(), [
            'title' => ['required', 'max:30', "unique:roles,title,{$id},role_id"],
            'access' => ['array']
        ]);
        if($validator->fails())
            throw new ValidatorException($validator->errors()->first());
        $this->roleService->update($id);
        return $this->serviceReturn($this->roleService);
    }

    public function delete($id)
    {
        $this->roleService->delete($id);
        return $this->serviceReturn($this->roleService);
    }

}
