<?php


namespace App\Http\Services\Manage;


use App\Http\Resp\Manage\AccessRepo;
use App\Http\Services\BaseService;

class AccessService extends BaseService
{

    protected $AccessRepo;

    public function __construct
    (
        AccessRepo $accessRepo
    )
    {
        $this->AccessRepo = $accessRepo;
    }

    public function getLists():void
    {
        $where = $this->setGetListsWhere();
        $this->data = $this->AccessRepo->lists($where);
    }

    public function add()
    {
        try{
            $data = $this->getAddData();
            $this->AccessRepo->add($data);
        }catch(\Exception $e){
            $this->msg = $e->getMessage();
            $this->code = 402;
        }

    }

    public function detail(int $id)
    {
        $detail = $this->AccessRepo->detail($id);
        if(!$detail){
            $this->msg = '数据不存在';
            $this->code = 204;
            return;
        }
        $this->data = $detail;
    }

    public function update(int $id)
    {
        try{
            $data = $this->getAddData();
            $this->AccessRepo->update($id, $data);
        }catch(\Exception $e){
            $this->msg = $e->getMessage();
            $this->code = 402;
        }
    }

    public function delete(int $id)
    {
        $this->AccessRepo->delete($id);
    }

    protected function setGetListsWhere():array
    {
        return [];
    }

    protected function getAddData():array
    {
        return $this->getData(
            [
                'title' => [self::$STRING, ''],
                'methods' => [self::$INT, 0],
                'uri' => [self::$STRING, ''],
                'cid' => [self::$INT, 0],
            ]
        );
    }

}
