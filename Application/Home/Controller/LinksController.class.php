<?php
namespace Home\Controller;
// use Think\Controller;

class LinksController extends HomeBaseController {
    
    /**
     * @Title: applyLink 
     * @todo 申请友情链接
     * @author Saki <ilulu4ever816@gmail.com>
     */
    public function applyLink(){
        $data['errcode'] = 0;
        if (isset($_POST['Links'])){
            $check = $this->checkPost($_POST['Links']);
            if ($check['res']){
                $model = new \Admin\Model\LinksModel();
                $map['name'] = $_POST['Links']['name'];
                $map['url'] = $_POST['Links']['url'];
                $map['email'] = $_POST['Links']['email'];
                $map['_logic'] = 'OR';
                $ishas = $model->where($map)->find();
                if ($ishas){
                    $data['errcode'] = 500;
                    $data['msg'] = '已经在友链申请列表中，请不要重复提交';
                }else{
                    $post = $_POST['Links'];
                    $result = $model->createLink($post);
                    $data['errcode'] = ($result['errcode'] == 0) ? 0 : 500; 
                    $data['msg'] = ($result['errcode'] == 0) ? '申请成功' : '申请失败'; 
                }
            }else{
                $data['errcode'] = 500;
                $data['msg'] = $check['msg'];
            }
        }else{
            $data['msg'] = '请提交正确的友链信息';
        }
        echo json_encode($data);
    }
    
    private function checkPost($post){
        if (empty($post['url'])){
            $data['res'] = false;
            $data['msg'] = '请填写链接地址';
            return $data;
        }
        if (empty($post['name'])){
            $data['res'] = false;
            $data['msg'] = '请填写友链名称';
            return $data;
        }
        $data['res'] = true;
        return $data;
    }
    
    
}