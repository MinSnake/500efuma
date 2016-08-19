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

    public function login()
    {

    }

    public function roll()
    {


    }

}