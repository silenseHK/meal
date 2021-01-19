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

    public function lists($where)
    {
        return model($this->Ki_Access, $where)->get();
    }

    public function add($data)
    {
        return $this->Ki_Access->create($data);
    }

    public function detail($id)
    {
        return model($this->Ki_Access, ['access_id'=>['=', $id]])->first();
    }

    public function update($id, $data)
    {
        return model($this->Ki_Access, ['access_id'=>['=', $id]])->update($data);
    }

    public function delete($id)
    {
        return model($this->Ki_Access, ['access_id'=>['=', $id]])->delete();
    }

}
