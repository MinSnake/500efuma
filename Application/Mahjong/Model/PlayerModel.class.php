<?php
namespace Mahjong\Model;
/**
 * @todo 玩家
 * @author saki
 */
class PlayerModel {

    private $name;
    public $playpoint;
    
    
    /**
     * @Title: __construct 
     * @todo 构造函数，自动生成2个随机的骰子数
     * @author Saki <ilulu4ever816@gmail.com>
     */
    function __construct($name,$playpoint){
        $this->name = $name;
        $this->playpoint = $playpoint;
    }
    
}