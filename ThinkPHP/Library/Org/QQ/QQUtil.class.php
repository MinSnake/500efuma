<?php
namespace Org\QQ;
/**
 * @todo: QQ接入处理
 * @author Saki <ilulu4ever816@gmail.com>
 * @date 2015-05-16 上午11:49:18 
 * @version V1.0
 */
class QQUtil {
	
	protected $app_id;
	protected $app_key;
	protected $redirect_uri;
	
	public function __construct(){
		$this->app_id = C('QQ_APP_ID');
		$this->app_key = C('QQ_APP_KEY');
		$this->redirect_uri = C('QQ_REDIRECT_URI');
	}
	
	public function getAccessToken($code){
		$token_url = "https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&"
					. "client_id=" . $this->app_id . "&redirect_uri=" . urlencode($this->redirect_uri)
					. "&client_secret=" . '09fc27016ac20dcbbf14b5be8faddff1' . "&code=" . $code;
		$response = file_get_contents($token_url);
		//获取失败处理
		if (strpos($response, "callback") !== false){
			$lpos = strpos($response, "(");
			$rpos = strrpos($response, ")");
			$response  = substr($response, $lpos + 1, $rpos - $lpos -1);
			$msg = json_decode($response);
			if (isset($msg->error)){
				$data['errcode'] = 0;
				$data['errmsg'] = $msg->error . ':' . $msg->error_description;
			}
		}else {//成功
			$params = array();
			parse_str($response, $params);
			$data['errcode'] = 1;
			$data['data'] = $params;
		}
		var_dump($data);
		exit();
		return $data;
	}
	
	public function getOpenID($access_token){
		$graph_url = "https://graph.qq.com/oauth2.0/me?access_token=".$access_token;
		$str  = file_get_contents($graph_url);
		if (strpos($str, "callback") !== false){
			$lpos = strpos($str, "(");
			$rpos = strrpos($str, ")");
			$str  = substr($str, $lpos + 1, $rpos - $lpos -1);
		}
		$user = json_decode($str);
		if (isset($user->error)){
			$data['errcode'] = 0;
			$data['errmsg'] = $user->error . ':' . $user->error_description;
		}else {
			$data['errcode'] = 1;
			$data['data'] = $user->openid;
		}
		return $data;
	}
	
	public function getUserInfo($access_token,$openid){
		$get_user_info_url = "https://graph.qq.com/user/get_user_info?".
				"access_token=$access_token&".
				"oauth_consumer_key=101215106&".
				"openid=$openid";
		$res_json = file_get_contents($get_user_info_url);
		$res_json_obj = json_decode($res_json);
		return $res_json_obj;
	}
	
	
	
	
}