<?php
namespace Home\Controller;
use Think\Controller;

class TvController extends Controller{
    
    public function index(){
        layout(false);
        $this->display();
    }

    
}