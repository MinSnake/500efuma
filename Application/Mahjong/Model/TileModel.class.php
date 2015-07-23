<?php
namespace Mahjong\Model;
/**
 * @todo 一张麻将牌的牌面
 * @author Saki <ilulu4ever816@gmail.com>
 * 日本麻将，一共136张
 * 一堆 17 * 2   一共4堆
 * 
 *【数字牌】
 * 筒 ： 1-9 * 4   （1赤）5筒
 * 
 * 条 ： 1-9 * 4   （1赤）5条
 * 
 * 万 ： 1-9 * 4   （1赤）5万
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

    public $tile_id;            //牌的编号
    public $tile_no;            //牌的数字
    public $tile_dora;          //是否为dora牌
    public $tile_dora_points;   //dora牌的番数
    public $tile_type;          //牌的类型
    
    private $dot_list;       //筒列表
    private $bamboo_list;    //索列表    
    private $character_list; //万列表
    
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
    
    function __construct_jp($fn){
        //P
        $dot_model = new \Mahjong\Model\DotModel('dora');
        $this->dot_list = $dot_model->getBambooList();
        //S
        $bamboo_model = new \Mahjong\Model\BambooModel('dora');
        $this->bamboo_list = $bamboo_model->getBambooList();
        //M
        $character_model = new \Mahjong\Model\CharacterModel('dora');
        $this->character_list = $character_model->getCharacterList();
        //字风
        //三元
    }
    
    /**
     * @todo 随机获取牌组中的一张索牌
     * @author Saki <ilulu4ever816@gmail.com>
     * @date 2015-07-23 上午 2:27:19
     */
    public function get_rand_bamboo_tile(){
        $bamboo_tile = array_rand($this->bamboo_list);
        return $this->bamboo_list[$bamboo_tile];
    }
    
    /**
     * @todo 获取整个索子牌组列表
     * @author Saki <ilulu4ever816@gmail.com>
     * @date 2015-07-23 上午 2:27:19
     */
    public function get_bamboo_list(){
        return $this->bamboo_list;
    }
    
    public function get_dot_list(){
        return $this->dot_list;
    }
    
    public function get_character_list(){
        return $this->character_list;
    }
	
}