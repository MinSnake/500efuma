<?php
namespace Activity\Controller;

use Think\Controller;
use Think\Log;

class RollController extends Controller
{

    public function index()
    {
        Log::write('xx', 'ALERT');
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
        $now_url = urlencode(C('QQ_REDIRECT_URI_ROLL'));
        $state = MODULE_NAME .'-'. CONTROLLER_NAME  . '-' . ACTION_NAME .'-roll-500efuma';
        $qq_login_url = "https://graph.qq.com/oauth2.0/authorize?".
            "response_type=code&" .
            "client_id=101346347&" .
            "redirect_uri=$now_url&" .
            "state=".$state;
//        $qq_logout_url = U('/Home/Public/qqlogout',array('state'=>$state));
        $qq_logout_url = "http://activity.500efuma.com/Public/qqlogout/state/$state";
        session('state',$state);  //设置session


        //roll点排行榜
        $rollModel = M('roll');
        $rollList = $rollModel->order('roll desc')->select();

        foreach ($rollList as $k=>$info)
        {
            $qqLoginModel = new \Admin\Model\QqLoginModel();
            $userInfo = $qqLoginModel->getInfoById($info['qq_id']);
            $rollList[$k]['headimgurl'] = $userInfo['figureurl_qq_1_url'];
            $rollList[$k]['nickname'] = $userInfo['nickname'];
        }

        $this->assign('rollList', $rollList);
        $this->assign('userList', $userList);

        $this->assign('qq_logout_url', $qq_logout_url);
        $this->assign('qq_nickname', $qq_nickname);
        $this->assign('headurl', $headurl);
        $this->assign('is_qq_login', $is_qq_login);
        $this->assign('qq_login_url', $qq_login_url);
        $this->display();
    }
    
    public function setCook()
    {
        $qqLoginModel = new \Admin\Model\QqLoginModel();
        $userInfo = $qqLoginModel->getInfoById(2);
        cookie('qq_nickname',$userInfo['nickname'],3600*24*7);
        cookie('qq_headurl',$userInfo['figureurl_qq_1_url'],3600*24*7);
        cookie('qq_openId',$userInfo['openid'],3600*24*7);
    }

    public function cleanCook(){
        cookie('qq_nickname',null);
        cookie('qq_headurl',null);
        cookie('qq_openId',null);
    }


    public function roll()
    {
        //生成随机数
        $num = rand(0, 100);
        $res['num'] = $num;
        //结果保存
        $qqLoginModel = new \Admin\Model\QqLoginModel();
        $userInfo = $qqLoginModel->getInfoByOpenId();

        Log::write('查询到用户信息'.var_export($userInfo, true), 'ALERT');

        $rollModel = M('roll');

        $cond['qq_id'] = $userInfo['id'];
        $is_has = $rollModel->where($cond)->find();

//        if (!$is_has)
        if (true)
        {
            Log::write('发现没有历史数据，马上创建', 'ALERT');

            $data['qq_id'] = $userInfo['id'];
            $data['roll'] = $num;
            $data['ctm'] = time();
            $is_add = $rollModel->add($data);

            if ($is_add === false)
            {
                Log::write('创建失败', 'ALERT');
                Log::write('SQL:' . $rollModel->_sql() , 'ALERT');
            }

        }

        $this->ajaxReturn($res);
    }

}