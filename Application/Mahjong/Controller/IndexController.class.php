<?php
namespace Mahjong\Controller;
use Think\Controller;

class IndexController extends Controller {
	
	public function index(){
		$tile_model = new \Mahjong\Model\TileModel('jp');
		echo json_encode($tile_model->get_dot_list(),JSON_UNESCAPED_UNICODE);
		echo json_encode($tile_model->get_bamboo_list(),JSON_UNESCAPED_UNICODE);
		echo json_encode($tile_model->get_character_list(),JSON_UNESCAPED_UNICODE);
	}
	
	
	
}