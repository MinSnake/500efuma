<?php
namespace Admin\Controller;

/**
 * @ClassName: Admin\Controller$LinksController 
 * @Description: 留言板-后台管理 
 * @author Saki <ilulu4ever816@gmail.com>
 * @date 2015年6月28日 下午1:59:17 
 */
class MessageController extends AdminBaseController {
	
	public function index(){
		$this->display();
	}
	
	public function jsondb(){
        $draw = $_GET['draw'];
        $start = $_GET['start'];
        $length = $_GET['length'];
        /*列表分页查询*/
        $model = new \Admin\Model\MessageModel();
        $list = $model->getMessageList($start, $length);
        /*查询总条数*/
        $count = D('Admin/Message')->count();
        /*生成JSON数据,安装前段表格框架的形式进行数据返回，jquery.datatable.js*/
        $result['draw'] = $draw;
        $result['recordsTotal'] = $count;
        $result['recordsFiltered'] = $count;
        $result['data'] = $list;
        echo json_encode($result);
    }
    
    public function msglist(){
    	layout(false);
    	$id = $_GET['id'];
    	$model = new \Admin\Model\MessageModel();
    	//当前评论的信息
    	$info = $model->where('id='.$id)->find();
    	$list = $model->getMessageList_By_Id($id);
    	$this->assign('info',$info);
    	$this->assign('list',$list);
    	$content = $this->fetch('Message:listinfo');
    	echo $content;
    }
    
    public function save(){
        if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['email'])){
            $model = new \Admin\Model\MessageModel();
            $data['name'] = $_POST['name'];
            $data['email'] = $_POST['email'];
            $data['content'] = $_POST['content'];
            $data['ip'] = GetIP();
            $data['ua'] = $_SERVER['HTTP_USER_AGENT'];
            //不为空，则不是新建的数据
            if (!empty($_POST['id'])){
                $map['id'] = $_POST['id'];
                $is_save = $model->where($map)->save($data);
            }else{//管理员留言
                $data['headimg_url'] = C('ADMIN_HEADIMG_URL');
                $data['name'] = C('ADMIN_NAME');
                $data['email'] = C('ADMIN_EMAIL');
                $data['ctm'] = date('Y-m-d H:i:s',time());
                $data['is_admin'] = 1;
                $is_save = $model->data($data)->add($data);
                $sql = $model->getLastSql();
            }
            $res['errcode'] = $is_save ? true : false;
            $res['errmsg'] = $is_save ? '操作成功' : $model->getError();
        }else{
            $res['errcode'] = false;
            $res['errmsg'] = '参数缺失';
        }
        echo json_encode($res);
    }
    
    public function update(){
        
    }
    
    public function delete(){
        
    }
    
    
}