<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Services\Admin\LoginService;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    private $loginService;

    public function __construct
    (
        LoginService $loginService
    )
    {
        $this->loginService = $loginService;
    }

    public function login()
    {
        $validator = Validator::make(inputs(), [
            'account' => ['required', 'between:4,30'],
            'password' => ['required', 'between:6,30']
        ]);

    }

}
