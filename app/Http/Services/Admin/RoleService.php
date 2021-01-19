<?php


namespace App\Http\Services\Admin;


use App\Http\Resp\Admin\RoleResp;
use App\Http\Services\BaseService;
use Illuminate\Support\Facades\DB;

class RoleService extends BaseService
{

    private $roleResp;

    public function __construct
    (
        RoleResp $roleResp
    )
    {
        $this->roleResp = $roleResp;
    }

    public function add():bool
    {
       $data = $this->getAddData();
       $access = input('access',[]);
       $access_data = [];

       DB::beginTransaction();
       try{
           $role = $this->roleResp->addRole($data);
           if($access){
               foreach($access as $access_id){
                   $access_data[] = [
                       'role_id' => $role->role_id,
                       'access_id' => $access_id
                   ];
               }
               $res = $this->roleResp->addRoleAccess($access_data);
               if($res === false)
                   throw new \Exception('角色权限创建失败');
           }
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
        $data = $this->getAddData();
        $access = input('access',[]);
        $access_data = [];
        foreach($access as $access_id){
            $access_data[] = [
                'role_id' => $id,
                'access_id' => $access_id
            ];
        }
        DB::beginTransaction();
        try{
            $res = $this->roleResp->updateRole($id, $data);
            if($res === false)
                throw new \Exception('角色更新失败');
            $res = $this->roleResp->updateRoleAccess($id, $access_data);
            if($res === false)
                throw new \Exception('角色权限创建失败');
            DB::commit();
            return true;
        }catch(\Exception $e){
            DB::rollBack();
            $this->msg = $e->getMessage();
            $this->code = 401;
            return false;
        }
    }

    public function getAddData()
    {
        return $this->getData(
            [
                'title' => ['string', '']
            ]
        );
    }

    public function delete($id)
    {
        $this->roleResp->deleteRole($id);
    }

}
