<?php
namespace Admin\Controller;
// use Think\Controller;

/**
 * @ClassName: Admin\Controller$LinksController 
 * @Description: 友链-后台管理 
 * @author Saki <ilulu4ever816@gmail.com>
 * @date 2015年4月24日 上午11:05:14 
 */
class LinksController extends AdminBaseController {
    
    public function index(){
        $this->display();
    }
    
    public function jsondb(){
        $draw = $_GET['draw'];
        $start = $_GET['start'];
        $length = $_GET['length'];
        /*列表分页查询*/
        $model = new \Admin\Model\LinksModel();
        $list = $model->getLinksList_Page($start, $length);
        /*查询总条数*/
        $count = D('Admin/Links')->count();
        /*生成JSON数据,安装前段表格框架的形式进行数据返回，jquery.datatable.js*/
        $result['draw'] = $draw;
        $result['recordsTotal'] = $count;
        $result['recordsFiltered'] = $count;
        $result['data'] = $list;
        echo json_encode($result);
    }
    
    public function create(){
        if(isset($_POST['Links'])){
            $model = new \Admin\Model\LinksModel();
            $admin_info = $this->admin_info;
            $data = $model->createLink($_POST['Links']);
            echo json_encode($data);
        }else{
            $this->assign('action','create');
            $this->display('form');
        }
    }
    
    public function update(){
        $condition['id'] = $id = $_GET['id'];
        $model = new \Admin\Model\LinksModel();
        if(isset($_POST['Links'])){
            $data = $model->updateLink($_POST['Links'], $id);
            echo json_encode($data);
        }else{
            $link_info = $model->where($condition)->find();
            $this->assign('link_info',$link_info);
            $this->assign('action','update');
            $this->display('form');
        }
    }
    
    public function delete(){
        $id = $_GET['id'];
        $model = new \Admin\Model\LinksModel();
        $data = $model->deleteLink($id);
        if($data['errcode'] == 0){
            $this->redirect('Links/index');
        }
    }
    
    public function sendMail(){
    	if (isset($_POST['id'])){
    		$model = new \Admin\Model\LinksModel();
    		$map['id'] = $_POST['id'];
    		$link_info = $model->where($map)->find();
    		if (isset($link_info['email'])){
    			$to_email = $link_info['email'];
    			$title = '您的友链申请已经通过！';
    			$body = "<body>
							<table style='margin: 25px auto;background:#364050;background-image: url(http://500efuma.me/Template/css/images/bg1.png);' border='0' cellspacing='0' cellpadding='0' width='700' align='center'>
								<tr>
									<td style='color:#FFFFFF;'>
										<div style='height: 42px;width: 160px;background-color: #c94663;padding: 0.1em 0.1em 0.1em 0.1em;background-image: url(http://500efuma.me/Template/css/images/bg1.png);text-align: center;margin: 15px;border-radius: 0.4em;'>
											<h1 style='margin-top: 1px;margin-bottom: 1px;'>500efuma</h1>
										</div>
									</td>
								</tr>
								<tr>
									<td style='border-left: 1px solid #364050; padding: 10px 20px; background: #ffffff; border-right: 1px solid #364050;'>
										<p>你好:</p>
										<p>我已经通过了你的友链申请。</p>
										<p>你可以点击这里查看:<br><a href='http://www.500efuma.com/Home/Index/links' target='_blank'>http://www.500efuma.com/Home/Index/links</a>.</p>
									</td>
								</tr>
								<tr>
									<td style='border-bottom: 1px solid #364050; border-left: 1px solid #364050; padding: 0px 20px 20px; background: #ffffff; border-right: 1px solid #364050;'>
										<hr style='color:#ccc;'>
										<p style='color:#c94663;font-size:9pt;'>想了解更多信息，请访问 <a href='http://www.500efuma.com/' target='_blank'>http://www.500efuma.com/</a></p>
									</td>
								</tr>
							</table>";
				$is_send = sendMail($to_email, $to_email, $title, $body);	
				$data = $is_send;		
    		}else{
	    		$data['errcode'] = 404;
	    		$data['msg'] = '该记录没有邮箱';
    		}
    	}else{
    		$data['errcode'] = 500;
    		$data['msg'] = '请求参数错误';
    	}
    	echo json_encode($data);
    }
    
    
    
    
    
}