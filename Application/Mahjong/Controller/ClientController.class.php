<?php
namespace Mahjong\Controller;
use Think\Controller;

class ClientController extends Controller {
    
    public function _initialize(){
        layout(false);
    }
    
	public function index(){
	    $this->display();
	}
	
	public function login(){
		$email = $_POST['email'];
		$password = $_POST['password'];
		$user_model = new \Mahjong\Model\UserModel('user','mj_','mysql://root:i500efuma@localhost/mahjong');
		$check = $user_model->check_email_password($email, $password);
		if ($email && $password && $check){
			$this->redirect('Client/hall');
		}else{
			$this->redirect('Client/index');
		}
	}
	
	public function hall(){
		
		
		echo '欢迎来到游戏大厅';
	}
	
	
	
}