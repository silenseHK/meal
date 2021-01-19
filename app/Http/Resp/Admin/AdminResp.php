<?php


namespace App\Http\Resp\Admin;


use App\Http\Models\KiAdmins;
use App\Http\Models\KiRoles;
use Illuminate\Support\Facades\DB;

class AdminResp
{

    private $Ki_Roles, $Ki_Admins;

    const ADMIN_ROLE = 'admin_role';

    public function __construct
    (
        KiRoles $kiRoles,
        KiAdmins $kiAdmins
    )
    {
        $this->Ki_Roles = $kiRoles;
        $this->Ki_Admins = $kiAdmins;
    }

    public function addAdmin($data)
    {
        return $this->Ki_Admins->create($data);
    }

    public function editAdminRole($admin_id, $role_id)
    {
        return DB::table(self::ADMIN_ROLE)->updateOrInsert(
            ['admin_id' => $admin_id],
            ['role_id' => $role_id]
        );
    }

    public function updateAdmin($id, $data)
    {
        return model($this->Ki_Admins, ['admin_id'=>['=', $id]])
            ->update($data);
    }

    public function getAdminByAccount($account)
    {
        return model($this->Ki_Admins, ['account'=>['=', $account]])->first();
    }

}
