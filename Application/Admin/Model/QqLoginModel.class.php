<?php
namespace Admin\Model;
use Think\Model\RelationModel;

/**
 * @todo QQ登录信息处理类
 * @author Saki <ilulu4ever816@gmail.com>
 * @date 2015-05-16 下午7:11:18 
 * @version V1.0
 */
class QqLoginModel extends RelationModel {
	
	protected $tableName = 'qq_login';
	
	public function checkToken($token){
		$result = false;
		$model = D('Admin/QqLogin');
		$map['access_token'] = $token;
		$info = $model->where($map)->find();
		if ($info){
			$last_login_tm = strtotime($info['last_login_tm']);
			$now_tm = time();
			$result = ($now_tm - $last_login_tm >= $info['expires_in']) ? false : $info;
		}
		return $result;
	}
	
	
	public function saveLoginInfo($params,$user_info,$openId){
		$model = D('Admin/QqLogin');
		$data['nickname'] = $user_info->nickname;
		$data['figureurl_qq_1_url'] = $user_info->figureurl_qq_1;
		$data['access_token'] = $params['access_token'];
		$data['openid'] = $openId;
		$data['expires_in'] = $params['expires_in'];
		$data['last_login_tm'] = date('Y-m-d H:i:s',time());
		$model->add($data);
	}

	public function getInfoByOpenId()
	{
        $openId = cookie('qq_openId');

        Log::write('查询到$openId'.var_export($openId, true), 'ALERT');

        $cond['openid'] = $openId;
        return $this->where($cond)->find();
	}
	
	public function updateToken(){
		
		
	}
	
	
}