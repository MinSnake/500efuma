<?php
namespace Home\Controller;
use Think\Log;
// use Think\Controller;

/**
 * @ClassName: Home\Controller$PublicController 
 * @Description: 模板布局文件处理以及公共方法调用的处理
 * @author Saki <ilulu4ever816@gmail.com>
 * @date 2014-12-3 下午4:52:06 
 */
class PublicController extends HomeBaseController{

	/**
	 * @todo 处理QQ登入方法
	 * @author Saki <ilulu4ever816@gmail.com>
 	 * @date 2015-05-16 上午2:47:17 
	 */
	public function qqlogin(){
		$qqUtil = new \Org\QQ\QQUtil();
		$code = $_GET['code'];
		$state = $_GET['state'];//存储文章ID
		$session_state = session('state');
		//Step3：通过Authorization Code获取Access Token
		if ($session_state == $state){
			$token_res = $qqUtil->getAccessToken($code);
			$params = $token_res['data'];
			$token = $params['access_token'];
			//判断access_token是否存在，且是否有效，即这个人是否登录过
			$model = new \Admin\Model\QqLoginModel();
			$result = $model->checkToken($token);
			if ($result){
				//token有效
				$openId = $result['openid'];
				$user_info = $qqUtil->getUserInfo($token, $openId);
			}else {
				//Step4：使用Access Token来获取用户的OpenID
				$open_res = $qqUtil->getOpenID($token);
				$openId =  $open_res['data'];
				$user_info = $qqUtil->getUserInfo($token, $openId);
				//添加新的数据
				$model->saveLoginInfo($params, $user_info, $openId);
			}
			//将用户的信息放进Cookie中
			cookie('qq_nickname',$user_info->nickname,3600*24*7);
			cookie('qq_headurl',$user_info->figureurl_qq_1,3600*24*7);
		}
		//跳转到当前浏览的帖子
		$state_arr = explode('-', $state);
		$this->redirect($state_arr[0] . '/' . $state_arr[1].'/'.$state_arr[2],array($state_arr[3]=>$state_arr[4]));
	}
	
	
	/**
	 * @todo 处理QQ退出方法
	 * @author Saki <ilulu4ever816@gmail.com>
	 * @date 2015-05-16 下午8:16:46
	 */
	public function qqlogout(){
	    //清空cookie中的QQ登录信息
	    cookie('qq_nickname',null);
	    cookie('qq_headurl',null);
	    //存储文章ID
	    $state = $_GET['state'];
	    //跳转到当前浏览的帖子
	    $state_arr = explode('-', $state);
	    $this->redirect($state_arr[1].'/'.$state_arr[2],array($state_arr[3]=>$state_arr[4]));
	}


	/**
	 * @todo 生成验证码图片
	 * @author Saki <ilulu4ever816@gmail.com>
	 * @date 2015-12-12 下午6:34:16
	 */
	public function builder_verify_img(){
        $verify = new \Think\Verify();
        $verify->length = 6;
        $verify->fontSize = 100;
        $verify->codeSet = '0123456789QWERTYUIOPASDFGHJKLZXCVBNM';
//         $verify->useImgBg = true;
		$verify->entry();
	}

	
	
}