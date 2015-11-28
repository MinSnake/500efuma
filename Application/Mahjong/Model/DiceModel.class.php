<?php
namespace Mahjong\Model;
/**
 * @todo 骰子
 * 2个骰子 范围 1-12
 * @author saki
 */
class DiceModel {
	
    private $dice_one;
    private $dice_two;
    private $dice_sum;
    
    /**
     * @Title: __construct 
     * @todo 构造函数，自动生成2个随机的骰子数
     * @author Saki <ilulu4ever816@gmail.com>
     */
    function __construct(){
        $this->dice_one = rand(1, 6);
        $this->dice_two = rand(1, 6);
        $this->dice_sum = $this->dice_one + $this->dice_two;
    }
    
    public function get_dice_one(){
        return $this->dice_one;
    }
    
    public function get_dice_two(){
        return $this->dice_two;
    }
    
    public function get_dice_sum(){
        return $this->dice_sum;
    }
    
    public function get_dice_json(){
        $data['dice_one'] = $this->dice_one;
        $data['dice_two'] = $this->dice_two;        
        $data['dice_sum'] = $this->dice_sum;   
        return json_encode($data);     
    }
    
}