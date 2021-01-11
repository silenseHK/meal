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
        $page = $this->pageInput();
        $size = $this->sizeInput();
        $where = $this->setGetListsWhere();
        $this->data = $this->AccessRepo->lists($where, $page, $size);
    }

    public function add()
    {
        $data = $this->getAddData();
        $this->AccessRepo->add($data);
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
                'pid' => [self::$INT, 0],
                'is_include' => [self::$INT, 0],
            ]
        );
    }

}
