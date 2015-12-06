<?php
namespace Mahjong\Model;
use Think\Model\RelationModel;

class UserModel extends RelationModel {
	
	/**
	 * @todo: 检测用户名密码的正确性 
	 * @author Saki <ilulu4ever816@gmail.com>
	 * @date 2014-12-30 上午10:23:01 
	 * @version V1.0
	 */
	public function check_email_password($email,$password){
		$condition['email'] = $email;
		$condition['password'] = $password;
		// 把查询条件传入查询方法
		$info = self::where($condition)->find();
// 		$sql = self::getLastSql();
		return $info;
	} 
	
	
	
}