<?php
namespace Hanafuda\Controller;
use Think\Controller;
use Hanafuda\Model;

class IndexController extends Controller {

    public function index(){
        $this->display();
    }


    public function create(){
        if ($_POST){
            $data = $_POST;
            $hanafudaModel = new Model\HanafudaModel();
            $hanafudaModel->addHanafuda($data);
        }
        $this->display();
    }

}