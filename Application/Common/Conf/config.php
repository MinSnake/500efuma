<?php
return array(
	//I500efuma
	
	//747599
	
	//ljd910423
	//584521
	
	//'配置项'=>'配置值'
// 	'SHOW_PAGE_TRACE'=>true,
	'URL_HTML_SUFFIX'=>'.html',
	'URL_MODEL'=>2,
	//mysql配置
	'DB_TYPE'=> 'mysql',     	//数据库类型
	'DB_DEPLOY_TYPE'=> 1,
	'DB_RW_SEPARATE'=>true,
	/*本地开发用*/
	'DB_HOST'=> 'localhost', 	
	'DB_USER'=> 'root',    		
	'DB_PWD'=> 'i500efuma',    	//本地数据库密码
	'DB_NAME'=> '500efuma',  	// 数据库名
	'DB_PORT'=> 3306,        	// 端口
	'DB_PREFIX' => 'fm_',
		
	'APP_GROUP_LIST'=>'Home,Admin',	//分组配置
	'DEFAULT_GROUP'=>'Home',		//默认分组
		// '配置项'=>'配置值'
		'LAYOUT_ON' => true,
		'LAYOUT_NAME' => 'Layout/main' ,
	'APP_SUB_DOMAIN_DEPLOY'=>1, 	// 开启子域名配置
	/*子域名配置
	 *格式如: '子域名'=>array('分组名/[模块名]','var1=a&var2=b');
	 */
	'APP_SUB_DOMAIN_RULES'=>array(
			'admin'=>array('Admin/'),  // admin域名指向Admin分组
	),
	//邮件配置，500efuma企业邮箱配置
	'THINK_EMAIL' => array(
		'SMTP_HOST'   => 'SMTP.500efuma.com', //SMTP服务器
		'SMTP_PORT'   => 25, //SMTP服务器端口
		'SMTP_USER'   => 'postmaster@500efuma.com', //SMTP服务器用户名
		'SMTP_PASS'   => 'Yinlu584521816', //SMTP服务器密码
		'FROM_EMAIL'  => 'postmaster@500efuma.com', //发件人EMAIL
		'FROM_NAME'   => '魔王的傻逼主页', //发件人名称
		'REPLY_EMAIL' => '', //回复EMAIL（留空则为发件人EMAIL）
		'REPLY_NAME'  => '', //回复名称（留空则为发件人名称）
	),
		//*163配置如下*//
// 		'THINK_EMAIL' => array(
// 				'SMTP_HOST'   => 'smtp.163.com', //SMTP服务器
// 				'SMTP_PORT'   => 25, //SMTP服务器端口
// 				'SMTP_USER'   => 'inclulu@163.com', //SMTP服务器用户名
// 				'SMTP_PASS'   => 'q584521816!', //SMTP服务器密码
// 				'FROM_EMAIL'  => 'no-reply@500efuma.com', //发件人EMAIL
// 				'FROM_NAME'   => '魔王的傻逼主页', //发件人名称
// 				'REPLY_EMAIL' => '', //回复EMAIL（留空则为发件人EMAIL）
// 				'REPLY_NAME'  => '', //回复名称（留空则为发件人名称）
// 		),
);
?>
