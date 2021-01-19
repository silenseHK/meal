<?php


namespace App\Http\Services\Admin;


use App\Http\Resp\Admin\AdminResp;
use App\Http\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminService extends BaseService
{

    private $adminResp;

    public function __construct
    (
        AdminResp $adminResp
    )
    {
        $this->adminResp = $adminResp;
    }

    public function add():bool
    {
        $data = $this->getAdminData();
        $password = Hash::make(input('password',''));
        $data = array_merge($data, compact('password'));
        $role_id = $this->intInput('role_id');

        DB::beginTransaction();
        try{
            ##新增管理员
            $admin = $this->adminResp->addAdmin($data);
            ##新增管理员对应角色
            $res = $this->adminResp->editAdminRole($admin->admin_id, $role_id);
            if($res === false)
                throw new \Exception('管理员角色创建失败');
            DB::commit();
            return true;
        }catch(\Exception $e){
            DB::rollBack();
            $this->msg = $e->getMessage();
            $this->code = 401;
            return false;
        }
    }

    public function update(int $id):bool
    {
        $data = $this->getAdminData();
        $role_id = $this->intInput('role_id');
        DB::beginTransaction();
        try{
            ##新增管理员
            $admin = $this->adminResp->updateAdmin($id, $data);
            ##新增管理员对应角色
            $res = $this->adminResp->editAdminRole($id, $role_id);
            if($res === false)
                throw new \Exception('管理员角色创建失败');
            DB::commit();
            return true;
        }catch(\Exception $e){
            DB::rollBack();
            $this->msg = $e->getMessage();
            $this->code = 401;
            return false;
        }
    }

    public function getAdminData()
    {
        return $this->getData([
            'title' => ['string'],
            'account' => ['string'],
            'status' => ['int', 0]
        ]);
    }

}
