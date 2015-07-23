<?php
namespace Mahjong\Controller;
use Think\Controller;

class IndexController extends Controller {
	
	public function index(){
		$bamboo_model = new \Mahjong\Model\BambooModel('dora');
		$bamboo_arr = $bamboo_model->getBambooList();
// 		var_dump($bamboo_arr);
		echo json_encode($bamboo_arr,JSON_UNESCAPED_UNICODE);
// 		$bamboo_tile = $bamboo_model->getTile();
// 		echo json_encode($bamboo_tile,JSON_UNESCAPED_UNICODE);
	}
	
	
	
}