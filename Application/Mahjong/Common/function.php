<?php
/**
 * @Title: set_dora 
 * @todo  设置dora
 * @param $tile_model
 * @param $has_dora
 * @param $dora_count
 * @param $number_dora
 * @param $dora_tile_no
 * @param $tile_no
 * @author Saki <ilulu4ever816@gmail.com>
 * @date 2015-07-23 下午 5:07:19
 */
function set_dora($tile_model,$has_dora,$dora_count,$number_dora,$dora_tile_no,$tile_no){
    $tile_model->tile_dora = 0;
    $tile_model->tile_dora_points = 1;
    if ($has_dora && $tile_no === $dora_tile_no){//为指定的dora牌数字
        $tile_model->tile_dora = ($dora_count < $number_dora && $dora_count < 4) ? 1 : 0;
        $dora_count ++;
    }
    return $dora_count;
}

/**
 * @Title: set_bamboo_list 
 * @todo   设置牌组
 * @param  $tile_model
 * @param  $tile_no_list
 * @param  $tile_type
 * @param  $number_dora
 * @param  $dora_tile_no
 * @author Saki <ilulu4ever816@gmail.com>
 */
function set_suit_list($tile_list,$tile_id_list,$tile_type,$number_dora,$dora_tile_no,$has_dora=true){
    $dora_count = 0;//dora总数
    foreach ($tile_id_list as $tile_id){
        $tile_model = new \Mahjong\Model\TileModel();
        $tile_no = $tile_id % 9 == 0 ? 9 : $tile_id % 9;
        $dora_count = set_dora($tile_model, $has_dora, $dora_count, $number_dora, $dora_tile_no, $tile_no);
        $tile_model->tile_id = $tile_id;
        $tile_model->tile_no = $tile_no;
        $tile_model->tile_type = $tile_type;
        array_push($tile_list, $tile_model);
    }
    return $tile_list;
}

function set_honor_tile_list($tile_list,$tile_id_list,$tile_type,$number_dora,$dora_tile_no,$has_dora=true,$type=true){
    $dora_count = 0;//dora总数
    foreach ($tile_id_list as $tile_id){
        $tile_model = new \Mahjong\Model\TileModel();
        if($type){//东南西北-true   白发中-false
            $tile_no = $tile_id % 4 == 0 ? 4 : $tile_id % 4;
        }else{
            $tile_no = $tile_id % 3;
        }
        $dora_count = set_dora($tile_model, $has_dora, $dora_count, $number_dora, $dora_tile_no, $tile_no);
        $tile_model->tile_id = $tile_id;
        $tile_model->tile_no = $tile_no;
        $tile_model->tile_type = $tile_type;
        array_push($tile_list, $tile_model);
    }
    return $tile_list;
}

