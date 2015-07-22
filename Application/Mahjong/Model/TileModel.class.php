<?php
/**
 * @todo 一张麻将牌的牌面
 * @author Saki <ilulu4ever816@gmail.com>
 * 日本麻将，一共136张
 * 一堆 17 * 2   一共4堆
 * 
 *【数字牌】
 * 筒 ： 1-9 * 4   （1赤）5筒
 * 1 2 3 4 5 6 7 8 9
 * 
 * 条 ： 1-9 * 4   （1赤）5条
 * 10 11 12 13 14 15 16 17 18 
 * 
 * 万 ： 1-9 * 4   （1赤）5万
 * 19 20 21 22 23 24 25 26 27
 * 
 *【字风】
 * 东 ： 1 * 4
 * 南 ： 1 * 4
 * 西 ： 1 * 4
 * 北 ： 1 * 4
 *
 *【三元牌】
 * 发 ： 1 * 4
 * 中 ： 1 * 4
 * 白 ： 1 * 4
 * 
 * 
 * 拿牌后每人13张，庄家14张
 * 
 * 牌山：1张
 * 
 * 每张牌的属性：名字（筒条万，东南西北，发中白），大小（筒条万1-9）
 * 
 * 拿牌：随机从136张中获取13张，相同的最多4张
 * 
 */
class TileModel {

	public $name;
	public $number;
	public $dora;//赤
	
    /**
     * @Title: __construct 
     * @todo 总的构造方法,根据调用的方法名进行处理
     * @author Saki <ilulu4ever816@gmail.com>
     */
    function __construct(){
        $args = func_get_args(); //获取构造函数中的参数
        //获取需要调用的方法
        $fn = $args[0];
        if (method_exists($this,$f='__construct_'.$fn)) {
            call_user_func_array(array($this,$f),$args);
        }
    }
    
    /**
     * @Title: __construct_register
     * @todo 调用注册方法时使用的构造方法
     * @param $conf_id  会员系统ID
     * @author Saki <ilulu4ever816@gmail.com>
     */
    function __construct_register($fn,$conf_id,$card_id,$tenant_id,$wx_wui_id,$json){
        if ($conf_id && $card_id){
            $this->conf_id = $conf_id;
            $this->card_id = $card_id;
            $this->wx_wui_id = $wx_wui_id;
            $this->tenant_id = $tenant_id;
            $this->json = $json;
            $this->checkRegisterParm($conf_id, $card_id, $json);
        }else{
            $res_json = WxTool::json_chinese(1, '注册参数缺失', true);
            exit($res_json);
        }
    }
	
	
	
	
	
	
	
	
}