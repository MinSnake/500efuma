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
				->field('a.id,a.headimg_url,a.name,a.content,a.is_admin,a.status,a.ctm,count(a.pid) as rnum')
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
			$headimg_url = "<img width='40px' src='".$msg['headimg_url']."'>";
			array_push ( $temp, $headimg_url);
			array_push ( $temp, $msg['name']);//
			array_push ( $temp, "<p class='table-content'>".strip_tags($msg['content'])."</p>");//
			array_push ( $temp, $msg['rnum']);//
			$status = $this->getStatus_HTML($msg['status']);
			array_push ( $temp, $status);
			array_push ( $temp, $msg['ctm']);
			$action = 
					"<button class='btn btn-sm blue showMsg' data-id='".$msg['id']."'>查看</button> " .
					"<a href='" . U('Message/delete',array('id'=>$msg['id'])) . "' class='btn red btn-sm'>删除</a> ";
			array_push ( $temp, $action);
			array_push ( $data, $temp );
		}
		return $data;
	}
	
	
	//二级回复列表
	public function getMessageList_By_Id($id){
		$model = D('Admin/Message');
		$list = $model->alias('a')
				->field('a.id,a.pid,a.tid,a.headimg_url,a.name,a.content,a.is_admin,a.status,a.ctm,b.id as bid,b.name as bname')
				->join('left join __MESSAGE__ b on a.tid=b.id')
				->order('a.ctm asc')
				->where('a.pid='.$id)
				->select();
		return $list;
	}
	
	public function deleteMessage($id){
		try {
			$isdelete = D('Admin/Message')->delete($id);
			$errcode = $isdelete ? 0 : 500;
			$msg = $isdelete ? '删除成功' : '删除失败';
		} catch (Exception $e) {
			$errcode = 500;
			$msg = $e->getMessage();
		}
		$res['errcode'] = $errcode;
		$res['msg'] = $msg;
		return $res;
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