<?php


namespace App\Libs;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;

class Token
{

    const TTL = 2 * 60 * 60;

    public function make($admin_id):string
    {
        return Crypt::encrypt($admin_id . '+' . time());
    }

    public function login($admin_id):string
    {
        $token = $this->make($admin_id);
        Cache::set($token, $admin_id,self::TTL);
        return $token;
    }

    public function check($token)
    {
        return Cache::get($token);
    }

}
