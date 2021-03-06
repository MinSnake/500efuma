<?php
namespace Mahjong\Controller;

use Think\Controller;

class IndexController extends Controller
{

    public function _initialize()
    {
        layout(false);
    }

    public function info()
    {
        phpinfo();
    }

    public function tilelist()
    {
        $name = $_GET['name'];
        $tile_model = new \Mahjong\Model\TileModel($name);
        $list = $tile_model->get_tile_list();
        shuffle($list);
        echo json_encode($list, JSON_UNESCAPED_UNICODE);
    }

    public function dice()
    {
        $dice = new \Mahjong\Model\DiceModel();
        echo $dice->get_dice_json();
    }

    public function game()
    {
        $this->display();
    }


}