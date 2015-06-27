<?php
namespace Admin\Model;
use Think\Model\RelationModel;
use Think\Exception;

class LinksModel extends RelationModel {
    
    protected $tableName = 'links';
    
    public function getLinksList_Page($start, $length){
        $model = D('Admin/Links');
        $list = $model->order('ctm desc')->limit($start, $length)->select();
        $sql = $model->getLastSql();
        $data = array ();
        foreach ($list as $key => $link){
            $temp = array();
            $choose = "<input type='checkbox' class='checkboxes' value='".$link['id']."'>";
            array_push ( $temp, $choose );//勾选框
            array_push ( $temp, $link['name']);
            array_push ( $temp, $link['url']);
            array_push ( $temp, $link['description']);
            array_push ( $temp, $link['email']);
            $status = $this->getStatus_HTML($link['status']);
            array_push ( $temp, $status);
            array_push ( $temp, $link['ctm']);
            $action = "<a href='" . $link['url'] . "' target='_blank' class='btn purple btn-sm'>预览</a> " .
                "<button type='button' data-id='".$link['id']."' class='btn btn-sm yellow sendEmail'>发邮件</button> " .
                "<a href='" . U('Links/update',array('id'=>$link['id'])) . "' class='btn blue btn-sm'>编辑</a> " .
                "<a href='" . U('Links/delete',array('id'=>$link['id'])) . "' class='btn red btn-sm'>删除</a> ";
            array_push ( $temp, $action);
            array_push ( $data, $temp );
        }
        return $data;
    }
    
    public function createLink($post){
        $model = D('Admin/Links');
        $data = $post;
        $data['ctm'] = date('Y-m-d H:i:s',time());
        $data['name'] = htmlspecialchars($post['name']);
        $data['url'] = htmlspecialchars($post['url']);
        if(isset($post['description'])){
            $data['description'] = htmlspecialchars($post['description']);
        }
        if (isset($post['email'])){
            $data['email'] = htmlspecialchars($post['email']);
        }
        try {
            $isadd = $model->data($data)->add($data);
            $errcode = $isadd ? 0 : 500;
            $msg = $isadd ? '添加成功' : '添加失败';
        } catch (Exception $e) {
            $msg = $e->getMessage();
            $errcode = 500;
        }
        $res['errcode'] = $errcode;
        $res['msg'] = $msg;
        return $res;
    }
    
    
    public function updateLink($post,$id){
        $model = D('Admin/Links');
        $map['id'] = $id;
        $data = $post;
        $data['name'] = htmlspecialchars($post['name']);
		$data['url'] = htmlspecialchars($post['url']);
		$data['description'] = htmlspecialchars($post['description']);
		$data['utm'] = date('Y-m-d H:i:s',time());
		try {
			$isupdate = $model->where($map)->save($data);
			$errcode = $isupdate ? 0 : 500;
			$msg = $isupdate ? '更新成功' : '更新失败';
		} catch (Exception $e) {
			$msg = $e->getMessage();
			$errcode = 500;
		}
		$res['errcode'] = $errcode;
		$res['msg'] = $msg;
		return $res;
    }
    
    public function deleteLink($id){
        try {
			$isdelete = D('Admin/Links')->delete($id);
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
            $html = '<span class="label label-sm label-warning">未审核</span>';
        }else if($status == 1){
            $html = '<span class="label  label-success">审核通过</span>';
        }else if($status == 2){
            $html = '<span class="label label-sm label-danger">无效外链</span>';
        }
        return $html;
    }
    
}