<?php
namespace Activity\Controller;

use Think\Controller;

class RollController extends Controller
{

    public function index()
    {
        $userList = getAllUserConf();
        unset($userList[3]);
        unset($userList[6]);
        unset($userList[8]);
        unset($userList[10]);

        $this->assign('userList', $userList);
        $this->display();
    }


    public function roll()
    {
        //生成随机数
        $num = rand(0, 100);
        $data['num'] = $num;
        //结果保存
        $this->ajaxReturn($data);
    }

}