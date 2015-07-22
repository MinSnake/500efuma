<?php
namespace Home\Controller;
use Think\Controller;

/**
 * @ClassName: Home\Controller$HomeBaseController 
 * @Description:  前台总父类
 * @author Saki <ilulu4ever816@gmail.com>
 * @date 2014-12-17 下午3:32:38 
 */
class HomeBaseController extends Controller{
	
	/**
	 * @todo: 初始化
	 * @author Saki <ilulu4ever816@gmail.com>
	 * @date 2014-12-3 下午4:59:13
	 * @version V1.0
	 */
	public function _initialize(){
		$this->text();
		$this->calendar();
		$this->tags();
		$this->recent_posts();
		$action = ACTION_NAME;//当前操作名  
		if($action != 'index' && $action != 'listinfo' && $action != 'me' && $action != 'links' && $action != 'message'){
			//默认为index
			$action = 'index';
		}
		$this->assign('action',$action);
	}
	
	/**
	 * @todo: 傻逼语录插件
	 * @author Saki <ilulu4ever816@gmail.com>
	 * @date 2014-12-17 上午10:35:11
	 * @version V1.0
	 */
	public function text(){
		$model = new \Admin\Model\SystemModel();
		$info = $model->getValue('text');
		$text = $info['value'];
		$this->assign('text',$text);
	}
	
	/**
	 * @todo: 最受关注的文章
	 * @author Saki <ilulu4ever816@gmail.com>
	 * @date 2014-12-27 上午10:35:11
	 * @version V1.0
	 */
	public function recent_posts(){
		$model = new \Admin\Model\ArticleListModel();
		$list = $model->order('pv_num desc,comments_num desc')->limit (5)->select ();
		$this->assign('recent_posts',$list);		
	}
	
	
	
	/**
	 * @todo: 文章标签
	 * @author Saki <ilulu4ever816@gmail.com>
	 * @date 2014-12-24 下午2:20:50 
	 * @version V1.0
	 */
	public function tags(){
		$model = new \Admin\Model\ArticleTypeModel();
		$condition['status'] = 1;
		$type_list = $model->where($condition)->select();
		$this->assign('type_list',$type_list);
	}
	
	/**
	 * @todo: 日历插件
	 * @author Saki <ilulu4ever816@gmail.com>
	 * @date 2014-12-17 上午11:21:33
	 * @version V1.0
	 */
	public function calendar(){
		$str = '';
		$Y = date('Y',time());//当前年份
		$m = date('m',time());	//当前月份
		$w = date('w',time());//当前星期几,0-6,0代表星期天
		$d = date('d',time());
		$beginDate = date('Y-m-01', strtotime(date("Y-m-d")));//当前月的第一天
		$beginTime = strtotime($beginDate);//当前月的第一天的时间戳
		$w_first = date('w',$beginTime);//当前月第一天是星期几
		$day_count = cal_days_in_month(CAL_GREGORIAN,$m,$Y);//当前月总共天数
		//计算总行数等数值
		$row_num = (($day_count+$w_first) % 7) == 0 ? floor(($day_count+$w_first)/7) : floor(($day_count+$w_first)/7+1) ;
		$data = array();
		//每行的具体信息
		for($i=1;$i<=$row_num;$i++){
			if($i==1){//第一行
				$temp['type'] = 'top';
				$temp['colspan'] = $w_first;//开头空格数
				$temp['start'] = 1;
				$temp['end'] = 7-$w_first+1;
				$temp['day_num'] = 7-$w_first;
			}elseif ($i==$row_num){
				$temp['type'] = 'end';
				$temp['colspan'] = 7-(($day_count+$w_first) % 7);
				$temp['start'] = 7*($i-1)+1-$w_first;
				$temp['end'] = $day_count+1;
				$temp['day_num'] = ($day_count+$w_first) % 7;
			}else{
				$temp['type'] = 'center';
				$temp['colspan'] = 0;
				$temp['start'] = 7*($i-1)+1-$w_first;
				$temp['end'] = 7*($i-1)+1-$w_first+6+1;
				$temp['day_num'] = 7;
			}
			//加入到总数组中
			array_push($data, $temp);
		}
		//当前月发表过文章的列表信息
		$model = new \Admin\Model\ArticleListModel();
		$sql = "select group_concat(date_format(ctm,'%d')) as ctm FROM __PREFIX__article_list where date_format(ctm,'%Y-%m')=date_format(now(),'%Y-%m') and status=1";
		$has_ctm = $model->query($sql);
		$this->assign('calendar',$data);
		$this->assign('has_ctm',$has_ctm[0]['ctm']);
		$this->assign('d',$d);
	}
	
	
	
}