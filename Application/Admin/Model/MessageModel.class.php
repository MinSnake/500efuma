<?php
namespace Admin\Model;
use Think\Model\RelationModel;
use Think\Exception;

class MessageModel extends RelationModel {
	
	protected $tableName = 'message';
	
	public function getMessageList($start, $length){
		$model = D('Admin/Message');
		$list = $model
				->alias('a')
				->field('a.id,a.headimg_url,a.name,a.content,a.status,a.ctm,count(a.pid) as rnum')
				->join('left join __MESSAGE__ b on a.id=b.pid')
				->order('a.ctm desc')
				->where('a.pid=0')
				->limit($start, $length)
				->group('a.id')
				->select();
		$sql = $model->getLastSql();
		$data = array ();
		foreach ($list as $key => $msg){
			$temp = array();
			$choose = "<input type='checkbox' class='checkboxes' value='".$msg['id']."'>";
			array_push ( $temp, $choose );//勾选框
			$headimg_url = "<img src='".$msg['headimg_url']."'>";
			array_push ( $temp, $headimg_url);
			array_push ( $temp, $msg['name']);//
			array_push ( $temp, $msg['content']);//
			array_push ( $temp, $msg['rnum']);//
			$status = $this->getStatus_HTML($msg['status']);
			array_push ( $temp, $status);
			array_push ( $temp, $msg['ctm']);
			$action = 
// 					"<a href='" . $msg['url'] . "' target='_blank' class='btn purple btn-sm'>预览</a> " .
					"<button type='button' data-id='".$msg['id']."' class='btn btn-sm yellow sendEmail'>发邮件</button> " .
					"<a href='" . U('Links/update',array('id'=>$msg['id'])) . "' class='btn blue btn-sm'>编辑</a> " .
					"<a href='" . U('Links/delete',array('id'=>$msg['id'])) . "' class='btn red btn-sm'>删除</a> ";
			array_push ( $temp, $action);
			array_push ( $data, $temp );
		}
		return $data;
	}
	
	private function getStatus_HTML($status){
		$html = '<span class="label label-sm label-default">无法获取</span>';
		if ($status == 0){
			$html = '<span class="label label-sm label-warning">无效</span>';
		}else if($status == 1){
			$html = '<span class="label  label-success">有效</span>';
		}
		return $html;
	}
	
}