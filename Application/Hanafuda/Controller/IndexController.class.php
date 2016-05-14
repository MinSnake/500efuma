<?php
namespace Hanafuda\Controller;

use Think\Controller;
use Hanafuda\Model;

class IndexController extends Controller
{

    private $hanafudaModel;

    public function _initialize()
    {
        $this->hanafudaModel = new Model\HanafudaModel();
    }

    public function index()
    {
        $hanaList = $this->hanafudaModel->getHanaList();
        $this->assign('hanaList', $hanaList);
        $this->display();
    }

    public function index2()
    {
        $this->display();
    }


    public function index3()
    {
        $hanaList = $this->hanafudaModel->getHanaList();
        $this->assign('hanaList', $hanaList);
        $this->display();
    }


}