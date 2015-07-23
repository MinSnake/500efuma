<?php
namespace Mahjong\Model;
/**
 * @todo  条牌
 * 条 ： 1-9 * 4   （1赤）5条--默认
 * @author Saki <ilulu4ever816@gmail.com>
 * @date 2015-07-23 上午 2:27:19 
 */
class BambooModel{
	
    public $tile_no;        //牌的编号
    public $tile_dora;      //是否为dora牌
    public $tile_name;      //牌的名字
    public $tile_name_cn;   //牌的中文名字
    
	private $tile_type = 'bamboo';
	private $tile_type_cn = '索';
	private $bamboo_list;//牌组列表
	private $bamboo_no = array(
		10 ,11 ,12 ,13 ,14 ,15 ,16 ,17 ,18,
		19 ,20 ,21 ,22 ,23 ,24 ,25 ,26 ,27,
		28 ,29 ,30 ,31 ,32 ,33 ,34 ,35 ,36,
		37 ,38 ,39 ,40 ,41 ,42 ,43 ,44 ,45
	);
	
    /**
     * @todo 总的构造方法,根据调用的方法名进行处理
     * @author Saki <ilulu4ever816@gmail.com>
     * @date 2015-07-23 上午 2:27:19 
     */
	function __construct(){
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
	private function __construct_dora($fn,$dora_number=1,$dora_tile_no=5){
		$this->set_bamboo_list($dora_number,$dora_tile_no);
	}
	
	/**
	 * @todo 无赤牌版本
	 * @param  $fn		no_dora
	 * @author Saki <ilulu4ever816@gmail.com>
	 * @date 2015-07-23 上午 2:27:19 
	 */
	private function __construct_no_dora($fn,$dora_number=0,$dora_tile_no=0){
		$this->set_bamboo_list();
	}
	
	/**
	 * @todo  设置牌组中的dora
	 * @param $is_dora_no		当前遍历到牌的数字
	 * @param $dora_tile_no		设置dora的牌数字
	 * @param $dora_count		当前已经设置的dora个数
	 * @param $dora_number		设置的dora个数
	 * @param $type		        设置dora类型，默认为有dora的配置
	 * @author Saki <ilulu4ever816@gmail.com>
	 * @date 2015-07-23 上午 2:27:19
	 */
	private function set_dora($bamboo_model ,$is_dora_no,$dora_tile_no,$dora_count,$dora_number ,$type){
	    $bamboo_model->tile_dora = 0;
		if ($type && $is_dora_no === $dora_tile_no){//为指定的dora牌数字
			$bamboo_model->tile_dora = ($dora_count < $dora_number && $dora_count < 4) ? 1 : 0;
			$dora_count ++;
		}
		return $dora_count;
	}
	
	/**
	 * @todo 设置牌组
	 * @param  $dora_number		设置的dora个数
	 * @param  $dora_tile_no	设置dora的牌数字
	 * @param  $type			牌组类型
	 * @author Saki <ilulu4ever816@gmail.com>
	 * @date 2015-07-23 上午 2:27:19
	 */
	private function set_bamboo_list($dora_number,$dora_tile_no,$type=true){
		$bamboo_list = array();
		$dora_count = 0;
		foreach ($this->bamboo_no as $k=>$bamboo){
		    $bamboo_model = new self();
			$is_dora_no = $bamboo % 9 == 0 ? 9 : $bamboo % 9;
			//设置牌的属性
			$dora_count = $this->set_dora($bamboo_model ,$is_dora_no, $dora_tile_no, $dora_count, $dora_number ,$type);
            $bamboo_model->tile_no = $bamboo;
            $bamboo_model->tile_type = $this->tile_type;
            $bamboo_model->tile_type_cn = $this->tile_type_cn;
            $bamboo_model->tile_name_cn = $is_dora_no . $this->tile_type_cn;
            $bamboo_model->tile_name = $is_dora_no . $this->tile_type;
			array_push($bamboo_list, $bamboo_model);
		}
		$this->bamboo_list = $bamboo_list;
	}
	
	/**
	 * @todo 随机获取牌组中的一张牌
	 * @author Saki <ilulu4ever816@gmail.com>
	 * @date 2015-07-23 上午 2:27:19
	 */
	public function getTile(){
		$bamboo_tile = array_rand($this->bamboo_list);
		return $this->bamboo_list[$bamboo_tile];
	}
	
	/**
	 * @todo 获取整个牌组列表
	 * @author Saki <ilulu4ever816@gmail.com>
	 * @date 2015-07-23 上午 2:27:19
	 */
	public function getBambooList(){
		return $this->bamboo_list;
	}
	
	
}