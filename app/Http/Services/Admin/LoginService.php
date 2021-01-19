<?php


namespace App\Http\Services\Admin;


use App\Http\Resp\Admin\AdminResp;
use App\Http\Services\BaseService;
use App\Libs\Token;
use Illuminate\Support\Facades\Hash;

class LoginService extends BaseService
{

    private $adminResp, $tokenEngine;

    public function __construct
    (
        AdminResp $adminResp,
        Token $tokenEngine
    )
    {
        $this->adminResp = $adminResp;
        $this->tokenEngine = $tokenEngine;
    }

    public function login():bool
    {
        $account = $this->strInput('account');
        $password = $this->strInput('password');
        $admin = $this->adminResp->getAdminByAccount($account);
        if(!$admin){
            $this->msg = '账号或密码错误';
            $this->code = 401;
            return false;
        }
        if(!Hash::check($password, $admin->password)){
            $this->msg = '账号或密码错误.';
            $this->code = 401;
            return false;
        }
        ##登录成功
        $token = $this->loginSuccess($admin);
        $this->data = compact('token');
        return true;
    }

    protected function loginSuccess($admin):string
    {
        ##生成token
        $token = $this->tokenEngine->login($admin->admin_id);
        return $token;
    }

}
