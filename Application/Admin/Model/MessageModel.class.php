<?php
namespace Admin\Model;
use Think\Model\RelationModel;
use Think\Exception;

class MessageModel extends RelationModel {
	
	protected $tableName = 'message';
	
	public function getMessageList($page,$condition){
		$model = D('Admin/Message');
		$list = $model->order('ctm asc')->where($condition)->limit($page->firstRow.','.$page->listRows)->select ();
		
		
		
	}
	
	
	
}