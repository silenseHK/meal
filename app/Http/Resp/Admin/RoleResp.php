<?php


namespace App\Http\Resp\Admin;


use App\Http\Models\KiAccess;
use App\Http\Models\KiRoles;
use Illuminate\Support\Facades\DB;

class RoleResp
{

    private $Ki_Roles, $Ki_Access;

    const ROLE_ACCESS = 'role_access';

    public function __construct
    (
        KiRoles $kiRoles,
        KiAccess $kiAccess
    )
    {
        $this->Ki_Roles = $kiRoles;
        $this->Ki_Access = $kiAccess;
    }

    public function addRole($data)
    {
        return $this->Ki_Roles->create($data);
    }

    public function addRoleAccess($data)
    {
        return DB::table(self::ROLE_ACCESS)->insert($data);
    }

    public function updateRole($id, $data)
    {
        return $this->Ki_Roles->where("role_id", "=", $id)->update($data);
    }

    public function delRoleAccess($role_id)
    {
        return DB::table(self::ROLE_ACCESS)->where("role_id","=", $role_id)->delete();
    }

    public function updateRoleAccess($role_id, $data)
    {
        $this->delRoleAccess($role_id);
        if($data)
            return $this->addRoleAccess($data);
        return true;
    }

    public function deleteRole($id)
    {
        return model($this->Ki_Roles, ['role_id'=>['=',$id]])->delete();
    }

}
