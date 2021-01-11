<?php


namespace App\Http\Resp\Manage;


use App\Http\Models\KiAccess;

class AccessRepo
{
    private $Ki_Access;

    public function __construct
    (
        KiAccess $Ki_Access
    )
    {
        $this->Ki_Access = $Ki_Access;
    }

    public function lists($where, $page, $size)
    {
        return model($this->Ki_Access, $where)->paginate($page, $size);
    }

    public function add($data)
    {
        return $this->Ki_Access->create($data);
    }

}
