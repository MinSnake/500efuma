<?php
namespace Activity\Controller;

use Think\Controller;

class RollController extends Controller
{

    public function index()
    {
        $userList = getAllUserConf();
        unset($userList[6]);
        unset($userList[8]);
        unset($userList[10]);

        //判断用户是否进行了QQ登录
        $qq_headurl = cookie('qq_headurl');
        $qq_nickname = cookie('qq_nickname');
        $headurl = !empty($qq_headurl) ? $qq_headurl : '/Template/admin/img/blog/21.png';
        $is_qq_login = !empty($qq_headurl) ? 1 : 0;
        //qq-login-url
        $now_url = urlencode(C('QQ_REDIRECT_URI'));
        $state = MODULE_NAME .'-'. CONTROLLER_NAME  . '-' . ACTION_NAME .'-roll-500efuma';
        $qq_login_url = "https://graph.qq.com/oauth2.0/authorize?".
            "response_type=code&" .
            "client_id=101346347&" .
            "redirect_uri=$now_url&" .
            "state=".$state;
        $qq_logout_url = U('Public/qqlogout',array('state'=>$state));

        $this->assign('userList', $userList);

        $this->assign('qq_logout_url', $qq_logout_url);
        $this->assign('qq_nickname', $qq_nickname);
        $this->assign('headurl', $headurl);
        $this->assign('is_qq_login', $is_qq_login);
        $this->assign('qq_login_url', $qq_login_url);
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