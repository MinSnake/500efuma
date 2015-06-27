<?php
namespace Admin\Model;
use Think\Model\RelationModel;
use Think\Exception;

class ArticleCommentModel extends RelationModel {
	
	protected $tableName = 'article_comment';
	
	/**
	 * @todo: 获取文章对应的【一级】评论列表
	 * @param $aid   文章ID 
	 * @author Saki <ilulu4ever816@gmail.com>
	 * @date 2014-12-26 下午5:45:28 
	 * @version V1.0
	 */
	public function getComments_First($page,$condition){
		$model = D('Admin/ArticleComment');
		$list = $model->order('ctm asc')->where($condition)->limit($page->firstRow.','.$page->listRows)->select ();
		//二级回复列表
		$pid_arr = listID_2_arrID($list);
		$map['aid'] = $condition['aid'];
		$map['pid']  = array('in',$pid_arr);
		$list_sec = $model->order('ctm asc')->where($map)->select ();
		$sql = $model->getLastSql();
		//进行set
		if($list_sec){
			foreach ($list as $k => $comment){
				$temp = array();
				foreach ($list_sec as $k_sec => $comment_sec){
					if($comment_sec['pid'] == $comment['id']){
						array_push($temp, $comment_sec);
					}
				}
				$temp = count($temp) > 0 ? $temp : null;
				$list[$k]['comment_sec'] = $temp;
			}
		}
		return $list;
	}
	
	/**
	 * @todo: 新增评论
	 * @author Saki <ilulu4ever816@gmail.com>
	 * @date 2014-12-26 下午5:45:28
	 * @version V1.0
	 */
	public function createComment($post){
		$isadd = 0;
		$model = D('Admin/ArticleComment');
		if($post['content'] != ''){
			$data = $post;
			$data['content'] = getContent($data['content']);
			$data['name'] = htmlspecialchars($post['name']);
			$data['ip'] = GetIP();
			$data['ua'] = $_SERVER['HTTP_USER_AGENT'];
			$data['ctm'] = date('Y-m-d H:i:s',time());
			try {
				$isadd = $model->data($data)->add($data);
				if($isadd){
					//评论数+1
					$article_list_model = new \Admin\Model\ArticleListModel();
					$article_list_model->addComment($post['aid']);
				}
			} catch (Exception $e) {
			}
		}
		return $isadd;
	}
	
	/**
	 * @todo: 删除评论
	 * @author Saki <ilulu4ever816@gmail.com>
	 * @date 2014-12-26 下午5:45:28
	 * @version V1.0
	 */
	public function deleteComment($id,$aid){
		$model = D('Admin/ArticleComment');
		try {
			$map['id'] = $id;
			$map['_logic'] = 'OR';
			$map['pid'] = $id;
			$count = $model->where($map)->count();
			$isdelete = $model->where($map)->delete();
			if($isdelete){
				//评论数-n
				$article_list_model = new \Admin\Model\ArticleListModel();
				$article_list_model->minusComment($aid,$count);
			}
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

}