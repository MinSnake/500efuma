<?php
namespace Mahjong\Model;
/**
 * @todo  筒牌
 * 条 ： 1-9 * 4   （1赤）5筒--默认
 * @author Saki <ilulu4ever816@gmail.com>
 * @date 2015-07-23 上午 2:27:19 
 */
class DotModel {
	
	public $dot_list;    //索列表
	
	private $tile_type;
	private $dot_id_list;
	
    /**
     * @todo 总的构造方法,根据调用的方法名进行处理
     * @author Saki <ilulu4ever816@gmail.com>
     * @date 2015-07-23 上午 2:27:19 
     */
	function __construct(){
	    $this->set_dot_tile_type();
	    $this->set_dot_id_list();
        $args = func_get_args();
        $fn = $args[0];
        if (method_exists($this,$f='__construct_'.$fn)) {
            call_user_func_array(array($this,$f),$args);
        }
    }
	
	/**
	 * @todo 有赤牌版本
	 * @param $fn 				dora
	 * @param $dora_number		dora个数,最多4个
	 * @param $dora_tile_no		定义为dora的数字		
	 * @author Saki <ilulu4ever816@gmail.com>
	 * @date 2015-07-23 上午 2:27:19 
	 */
	private function __construct_dora($fn,$number_dora=1,$dora_tile_no=5){
	    $tile_list = array();
	    $tile_type = $this->tile_type;
	    $tile_id_list = $this->dot_id_list;
	    $tile_list = set_tile_list($tile_list, $tile_id_list, $tile_type, $number_dora, $dora_tile_no);
	    $this->dot_list = $tile_list;
	}
	
	/**
	 * @todo 无赤牌版本
	 * @param  $fn		no_dora
	 * @author Saki <ilulu4ever816@gmail.com>
	 * @date 2015-07-23 上午 2:27:19 
	 */
	private function __construct_no_dora($fn,$number_dora=0,$dora_tile_no=0){
	    $tile_list = array();
	    $tile_type = $this->tile_type;
	    $tile_no_list = $this->dot_id_list;
	    $tile_list = set_tile_list($tile_list, $tile_no_list, $tile_type, $number_dora, $dora_tile_no,false);
	    $this->dot_list = $tile_list;
	}
	
	private function set_dot_id_list(){
	    $dot_id_list = array();
	    for ($i = 1 ; $i <= 36 ; $i++){
	        array_push($dot_id_list, $i);
	    }
	    $this->dot_id_list = $dot_id_list;
	}
	
	private function set_dot_tile_type(){
	    $this->tile_type = 'dot';
	}
	
	/**
	 * @todo 获取整个牌组列表
	 * @author Saki <ilulu4ever816@gmail.com>
	 * @date 2015-07-23 上午 2:27:19
	 */
	public function getBambooList(){
		return $this->dot_list;;
	}
	

}