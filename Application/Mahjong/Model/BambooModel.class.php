<?php
namespace Mahjong\Model;
/**
 * @todo  条牌
 * 条 ： 1-9 * 4   （1赤）5条--默认
 * @author Saki <ilulu4ever816@gmail.com>
 * @date 2015-07-23 上午 2:27:19 
 */
class BambooModel{
	
	public $number;// 1-9
	public $dora_number;//dora个数，默认1个
	public $dora_tile_no;//制定赤牌号码，默认为5条，默认编号14
	public $dora;//1-赤 0-普通
	private $bamboo_list;//牌组列表
	private $tile_type = 'bamboo';
	private $tile_type_cn = '条';
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
	function __construct_dora($fn,$dora_number=1,$dora_tile_no=5){
		$this->set_bamboo_list($dora_number,$dora_tile_no);
	}
	
	/**
	 * @todo 无赤牌版本
	 * @param  $fn		no_dora
	 * @author Saki <ilulu4ever816@gmail.com>
	 * @date 2015-07-23 上午 2:27:19 
	 */
	function __construct_no_dora($fn,$dora_number=0,$dora_tile_no=0){
		$this->set_bamboo_list();
	}
	
	/**
	 * @todo  设置牌组中的dora
	 * @param $is_dora_no		当前便利到牌的数字
	 * @param $dora_tile_no		设置dora的牌数字
	 * @param $dora_count		当前已经设置的dora个数
	 * @param $dora_number		设置的dora个数
	 * @author Saki <ilulu4ever816@gmail.com>
	 * @date 2015-07-23 上午 2:27:19
	 */
	private function set_dora($is_dora_no,$dora_tile_no,$dora_count,$dora_number){
		if ($is_dora_no === $dora_tile_no){//为指定的dora牌数字
			$temp['tile_dora'] = ($dora_count < $dora_number && $dora_count < 4) ? 1 : 0;
			$dora_count ++;
		}else{
			$temp['tile_dora'] = 0;
		}
		$data['temp'] = $temp;
		$data['dora_count'] = $dora_count;
		return $data;
	}
	
	/**
	 * @todo 设置牌组
	 * @param  $dora_number		设置的dora个数
	 * @param  $dora_tile_no	设置dora的牌数字
	 * @param  $type			牌组类型
	 * @author Saki <ilulu4ever816@gmail.com>
	 * @date 2015-07-23 上午 2:27:19
	 */
	private function set_bamboo_list($dora_number,$dora_tile_no,$type='dora'){
		$bamboo_list = array();
		$dora_count = 0;
		foreach ($this->bamboo_no as $k=>$bamboo){
			$is_dora_no = $bamboo % 9 == 0 ? 9 : $bamboo % 9;
			if ($type === 'dora'){
				$data = $this->set_dora($is_dora_no, $dora_tile_no, $dora_count, $dora_number);
				$temp = $data['temp'];
				$dora_count = $data['dora_count'];
			}
			$temp['tile_no'] = $bamboo;
			$temp['tile_type'] = $this->tile_type;
			$temp['tile_type_cn'] = $this->tile_type_cn;
			$temp['tile_name_cn'] = $is_dora_no . $this->tile_type_cn;
			array_push($bamboo_list, $temp);
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