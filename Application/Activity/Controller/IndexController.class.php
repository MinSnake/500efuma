<?php
namespace Activity\Controller;
use Think\Controller;

class IndexController extends Controller {

    private $user_arr;
    private $K;
    private $M;
    private $N;
    
    //数据初始化
    public function _initialize(){
        $this->user_arr = array('小百合','小龙华','小六花','小假肢','小CC','小小野','小魔王','小透华');
        $this->N = count($this->user_arr);
        $this->K = rand(1, $this->N);
        $this->M = rand(1, $this->N);
    }
    
    public function index(){
        $christmas_model = M('activity_christmas');
        $list = $christmas_model->order('ctm desc')->select();
        foreach ($list as $k=>$temp) {
            $temp['data'] = (array)json_decode($temp['data']);
            $list[$k] = $temp;
        }
        $this->assign('list',$list);
        $this->assign('user_arr',$this->user_arr);
        $this->display();
    }
    
    public function christmas(){
        $temp = array_splice($this->user_arr, $this->K-1,$this->N-($this->K-1));
        array_splice($this->user_arr, 0, 0, $temp);
        $start = $this->user_arr;
        $result = $this->my_sort($this->user_arr);
        //data数据生成
        $data['k'] = $this->K;
        $data['m'] = $this->M;
        $data['start'] = $start;
        $data['result'] = $result;
        //DB操作记录数据
        $christmas_model = M('activity_christmas');
        $save['data'] = json_encode($data);
        $save['ctm'] = date('Y-m-d H:i:s',time());
        $christmas_model->add($save);
    }
    
    private function my_sort($a,$new = array()){
        if (count($a) > 1){
            $i = $this->M % count($a);//余数即踢出的第i个
            $out = array_splice($a, $i-1 ,1);
            array_push($new, $out[0]);
            //重组下
            if ($i != 0){
                $last = array_splice($a, $i-1 ,count($a)-($i-1));
                array_splice($a, 0 ,0 ,$last);
            }
            return $this->my_sort($a, $new);
        }else {
            array_push($new, $a[0]);
            return $new;
        }
    }
    
}