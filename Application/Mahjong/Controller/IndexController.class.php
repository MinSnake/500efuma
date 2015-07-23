<?php
namespace Mahjong\Controller;
use Think\Controller;

class IndexController extends Controller {
	
	public function index(){
		$tile_model = new \Mahjong\Model\TileModel('jp');
		$list = $tile_model->get_tile_list();
		echo json_encode($list,JSON_UNESCAPED_UNICODE);
	}
	
	
}