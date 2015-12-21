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
        $this->user_arr = array('A','B','C','D','E','F','G');
        $this->N = count($this->user_arr);
        $this->K = rand(1, $this->N);
        $this->M = rand(1, $this->N);
    }
    
    public function index(){
        //按照K的值将数组进行排序
        echo 'K:' . $this->K . '<br>';
        echo 'M:' . $this->M . '<br>';
        //进行重新排序
        $temp = array();
        foreach ($this->user_arr as $user_k => $user_v){
            if ($user_k+1 < $this->K){
                unset($this->user_arr[$user_k]);
                array_push($this->user_arr, $user_v);
            }
        }
        $this->user_arr= array_merge($this->user_arr,array());//为了让key重新从0开始
        $this->user_arr= array_merge($this->user_arr,$this->user_arr);
        
        
        echo '生成的数组队列：';
        var_dump($this->user_arr);
        echo '开始约瑟夫环计算<br>';
        
        //进行约瑟夫循环
        $new_user_arr = array();
        $result = $this->my_sort($this->user_arr, $new_user_arr);
//         echo '结果：';
//         var_dump($result);
    }
    
    
    public function my_sort($user_arr,$new_user_arr){
        if (count($user_arr) > 0){
            $count = count($user_arr);
            foreach ($user_arr as $k=>$v){
                if ($k+1 == $this->M){
                    
                    echo '当前减掉'.$v.'<br>';
                    
                    array_push($new_user_arr, $user_arr[$k]);//然后加到新的数组里面
                    
                    //把剩余的重新排序,取出M后面的
                    $last_arr = array_slice($user_arr,$this->M);
                    
                    unset($user_arr[$k]);//将这个踢出去
                    unset($user_arr[$k+$this->N]);//将这个踢出去
                    
                    echo '剩余的：'.var_export($user_arr,true) .'<br>';
                    $user_arr = array_merge($user_arr,array());
                    
                    
                    
                    echo '截取到后面的:'.var_export($last_arr,true).'<br>';
                    
                    if (count($last_arr) > 0 ){
                        krsort($last_arr);
                        //放到最前面
                        foreach ($last_arr as $last_k=>$last){
                            array_unshift($user_arr, $last);//往数组头放
                        }
                    }
                    //把后面的都清空
                    foreach ($user_arr as $k=>$v){
                        if ($k > $count-2){
                            unset($user_arr[$k]);
                        }
                    }
                    $user_arr = array_merge($user_arr,array());//重新开始
                    echo '重新计算之后的：'.var_export($user_arr,true).'<br>';
                }
            }
//             var_dump($user_arr);
//             var_dump($new_user_arr);
            $this->my_sort($user_arr, $new_user_arr);
        }else{
            array_push($new_user_arr, $user_arr[0]);
            return $new_user_arr;
        }
    }
    
    
    public function a(){
        
        
        
    }
    
    
    
    
    

    
    

}