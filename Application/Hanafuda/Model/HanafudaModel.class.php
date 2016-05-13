<?php
namespace Hanafuda\Model;

use Think\Log;
use Think\Model;

class HanafudaModel extends Model
{

    protected $tableName = 'hanafuda';


    public function getHanaList()
    {
        return $this->select();
    }

//    public function addHanafuda($data)
//    {
//        $data['ctm'] = date('Y-m-d H:i:s', time());
//        Log::write('接收到参数：' . var_export($data,true),'INFO');
//        $this->add($data);
//        Log::write('SQL:' . $this->_sql(),'INFO');
//    }


}