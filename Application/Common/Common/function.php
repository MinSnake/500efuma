<?php
/**
 * @todo: 获取客户端的IP
 * @param @return Ambigous <string, unknown>    
 * @return Ambigous <string, unknown>    
 * @author Saki <ilulu4ever816@gmail.com>
 * @date 2014-12-26 下午12:00:25 
 * @version V1.0
 */
function GetIP() {
	if (getenv ( "HTTP_CLIENT_IP" ) && strcasecmp ( getenv ( "HTTP_CLIENT_IP" ), "unknown" ))
		$ip = getenv ( "HTTP_CLIENT_IP" );
	else if (getenv ( "HTTP_X_FORWARDED_FOR" ) && strcasecmp ( getenv ( "HTTP_X_FORWARDED_FOR" ), "unknown" ))
		$ip = getenv ( "HTTP_X_FORWARDED_FOR" );
	else if (getenv ( "REMOTE_ADDR" ) && strcasecmp ( getenv ( "REMOTE_ADDR" ), "unknown" ))
		$ip = getenv ( "REMOTE_ADDR" );
	else if (isset ( $_SERVER ['REMOTE_ADDR'] ) && $_SERVER ['REMOTE_ADDR'] && strcasecmp ( $_SERVER ['REMOTE_ADDR'], "unknown" ))
		$ip = $_SERVER ['REMOTE_ADDR'];
	else
		$ip = "unknown";
	return $ip;
} 

/**
 * @todo: 判断和处理 指定文章中的访问ip 
 * array( '127.0.0.1' , '2014-12-26' );
 * 同一个ip每天只能算作1次的访问
 * @author Saki <ilulu4ever816@gmail.com>
 * @date 2014-12-26 下午12:00:39 
 * @version V1.0
 */
function Article_Cookie_IP($article_id){
	//$ip = GetIP();//当前用户IP
	$ip = get_client_ip();
	$ip_arr = cookie('article_' . $article_id . '_ip');//现有的ip组
	if(!$ip_arr){//如果没有添加过
		cookie('article_' . $article_id . '_ip',array( $ip , date('Y-m-d',time())),3600*24);
		return true;		
	}else{
		$old_ip = $ip_arr[0];
		$old_tm = $ip_arr[1];
		if($old_ip != $ip || $old_tm !=  date('Y-m-d',time())){
			cookie('article_' . $article_id . '_ip',array( $ip , date('Y-m-d',time())),3600*24);
			return true;
		}else{
			return false;
		}
	}
}

/**
 * @todo: list中只取出ID，然后组成数组
 * @return multitype:    
 * @author Saki <ilulu4ever816@gmail.com>
 * @date 2014-12-30 上午9:48:30 
 * @version V1.0
 */
function listID_2_arrID ($list){
	$result = array();
	foreach ($list as $key=>$value){
		array_push($result, $value['id']);	
	}
	return $result;
}


/**
 * 系统邮件发送函数
 * @param string $to    接收邮件者邮箱
 * @param string $name  接收邮件者名称
 * @param string $subject 邮件主题
 * @param string $body    邮件内容
 * @param string $attachment 附件列表
 * @author Saki <zha_zha@outlook.com>
 * @date 2014-9-25 上午10:19:21
 * @version v1.0.0
 */
function sendMail($to, $name, $subject, $body, $attachment = null){
	$config = C('THINK_EMAIL');
	Vendor('PHPMailer.PHPMailerAutoload');
	$mail 			  = new PHPMailer();//PHPMailer对象
	$mail->IsSMTP();  // 设定使用SMTP服务
	$mail->CharSet    = 'UTF-8'; //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
// 	$mail->SMTPDebug  = 0;                     // 关闭SMTP调试功能
	$mail->SMTPAuth   = true;                  // 启用 SMTP 验证功能
// 	$mail->SMTPSecure = 'ssl';                 // 使用安全协议
	$mail->Host       = $config['SMTP_HOST'];  // SMTP 服务器
	$mail->Port       = $config['SMTP_PORT'];  // SMTP服务器的端口号
	$mail->Username   = $config['SMTP_USER'];  // SMTP服务器用户名
	$mail->Password   = $config['SMTP_PASS'];  // SMTP服务器密码
	$mail->SetFrom($config['FROM_EMAIL'], $config['FROM_NAME']);
	$replyEmail       = $config['REPLY_EMAIL']?$config['REPLY_EMAIL']:$config['FROM_EMAIL'];
	$replyName        = $config['REPLY_NAME']?$config['REPLY_NAME']:$config['FROM_NAME'];
	$mail->AddReplyTo($replyEmail, $replyName);
	$mail->Subject    = $subject;//标题
	$mail->MsgHTML($body);//邮件内容
	$mail->AddAddress($to, $name);//收件人的邮箱，名字
	if(is_array($attachment)){ // 添加附件
		foreach ($attachment as $file){
			is_file($file) && $mail->AddAttachment($file);
		}
	}
	$is_send = $mail->Send();
	$data['errcode'] = $is_send ? 1 : 500;
	$data['msg'] = $is_send ? '发送成功' : $mail->ErrorInfo;
	return $data;
}

/**
 * @todo: 邮件的html内容生成
 * @return string    
 * @author Saki <ilulu4ever816@gmail.com>
 * @date 2014-12-31 下午5:48:53 
 * @version V1.0
 */
function getMail($to,$from,$title,$content,$url){
	$text = "<body>
	<table style='margin: 25px auto;background:#364050;background-image: url(http://500efuma.me/Template/css/images/bg1.png);' border='0' cellspacing='0' cellpadding='0' width='700' align='center'>
		<tr>
			<td style='color:#FFFFFF;'>
				<div style='height: 42px;width: 160px;background-color: #c94663;padding: 0.1em 0.1em 0.1em 0.1em;background-image: url(http://500efuma.me/Template/css/images/bg1.png);text-align: center;margin: 15px;border-radius: 0.4em;'>
					<h1 style='margin-top: 1px;margin-bottom: 1px;'>500efuma</h1>
				</div>
			</td>
		</tr>
		
		<tr>
			<td style='border-left: 1px solid #364050; padding: 20px 20px 0px; background: #ffffff;border-right: 1px solid #364050;'>
				<p>%s, 你好 </p>
			</td>
		</tr>
		<tr>
			<td style='border-left: 1px solid #364050; padding: 10px 20px; background: #ffffff; border-right: 1px solid #364050;'>
				<p><strong>%s</strong> 在博客： <strong><a href='#' target='_blank'>%s</a></strong> 发表评论如下:</p>
				<div style='border:1px solid #ddd;padding: 10px 20px; font-family: sans-serif;background:#f2f2f2;line-height:24px;'>%s</div>
				<p>你可以点击这里查看评论:<br><a href='%s' target='_blank'>%s</a>.</p>
			</td>
		</tr>
		<tr>
			<td style='border-bottom: 1px solid #364050; border-left: 1px solid #364050; padding: 0px 20px 20px; background: #ffffff; border-right: 1px solid #364050;'>
				<hr style='color:#ccc;'>
				<p style='color:#c94663;font-size:9pt;'>想了解更多信息，请访问 <a href='http://www.500efuma.com/' target='_blank'>http://www.500efuma.com/</a></p>
			</td>
		</tr>
	</table>";
	$body = sprintf ($text,$to,$from,$title,$content,$url,$url);
	return $body;
}

/**
 * @todo: 处理字符串中的空格，回车的转义操作
 * @author Saki <ilulu4ever816@gmail.com>
 * @date 2014-12-31 下午5:48:25 
 * @version V1.0
 */
function getContent($content){
	$content = htmlspecialchars($content);
	$content = str_replace(" ","&nbsp",$content); //替换空格为
	$content = nl2br($content); //将回车替换为
	return $content;
}

/**
 * 解析xml
 * @author Saki <zha_zha@outlook.com>
 * @date 2014-5-29下午5:09:51
 * @version v1.0.0
 */
function resolveXML($xml){
	//解析xml文件
	$p = xml_parser_create();
	xml_parser_set_option($p, XML_OPTION_CASE_FOLDING, false);
	xml_parse_into_struct($p, $xml, $vals, $index);
	xml_parser_free($p);
	/*遍历xml对象，将key-value放入数组中，然后在包装成object*/
	$newArr = array();
	foreach($vals as $xmlObj){
		if($xmlObj['tag'] != 'xml'){
			$temp[$xmlObj['tag']] = $xmlObj['value'];
			array_push($newArr, $temp);
		}
	}
	$res = (object)end($newArr);
	return $res;
}




