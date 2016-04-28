<?php
namespace Wechat\Controller;
use Think\Controller;

class IndexController extends Controller {
	
	public $wechatUtil;
	
	public function _initialize(){
		$this->token = '500efuma';
		layout(false);
		$config = C('THINK_EMAIL');//调用系统配置
		$this->wechatUtil = new \Org\Wechat\WechatUtil($config['AppID'], $config['AppSecret'], $config['Token']);
		/*网站接入*/
		$this->wechatUtil->valid();
	}
	
	public function index(){
		//接受微信xml文件
		$xml = file_get_contents('php://input');
		if($xml){
			$xmlObj = resolveXML($xml);
			//获取用户openid
			$Developers = $xmlObj->ToUserName;//开发者微信号
			$OpenID = $xmlObj->FromUserName;//用户OpenID
			if($OpenID){
				//判断事件类型
				if($xmlObj->MsgType == 'text'){
					/*如果为文本消息*/
					$message = trim($xmlObj->Content);//用户发送的内容
					$Content = $this->wechatUtil->resolveText($message, $OpenID);
					$text = $this->wechatUtil->createTextXML($OpenID, $Developers, $Content);
				}elseif($xmlObj->MsgType == 'event'){
					/*如果为按钮事件*/
// 					if($xmlObj->Event == 'CLICK'){
// 					}
					/*如果为关注事件*/
					if($xmlObj->Event == 'subscribe'){
						$Content = "欢迎关注\n我是魔王的助手\n如果您是500efuma成员请输入\n'saki,xxxx'(QQ号)进行身份认证";
						$text = $this->wechatUtil->createTextXML($OpenID, $Developers, $Content);
					}
					/*如果为取消关注事件*/
// 					else if($xmlObj->Event == 'unsubscribe'){
// 					}
					/*如果为地理位置事件*/
// 					else if($xmlObj->Event == 'LOCATION'){
// 					}
				}
			}
			/*推送xml信息返回给用户*/
			echo $text;
		}
	}
	
	public function friend(){
		
		
		$this->display('index');
	}
	
	
	
}