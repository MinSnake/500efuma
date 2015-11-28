<?php
namespace Home\Controller;
use Think\Log;
// use Think\Controller;


class ArticleController extends HomeBaseController{
	
	/**
	 * @todo: 文章内容详情
	 * @author Saki <ilulu4ever816@gmail.com>
	 * @date 2014-12-22 上午9:34:18 
	 * @version V1.0
	 */
	public function View(){
		$id = $_GET['id'];
		$p = isset($_GET['p']) ? $_GET['p'] : 0;//评论分页标志
		//文章详细信息
		$model = new \Admin\Model\ArticleListModel();
		$info = $model->getArticleInfo($id);
		$tags = explode(",",$info['tags']);//tags解析
		//查询评论列表
		$comments_model = new \Admin\Model\ArticleCommentModel();
		//统计总条数
		$condition['aid'] = $id;
		$condition['pid'] = 0;
		$count = $comments_model->where($condition)->count();
		//分页显示设置
		$Page = new \Think\Page($count,3);
		$Page->setConfig('prev','上一页');
		$Page->setConfig('next','下一页');
		$Page->setConfig('theme','%FIRST%  %LINK_PAGE%  %END%');
		$show = $Page->show();
		$comments_list = $comments_model->getComments_First($Page,$condition);
		//增加一个浏览量
		if(Article_Cookie_IP($id)){
			$model->addPv($id);
		}
		//判断用户是否进行了QQ登录
		$qq_headurl = cookie('qq_headurl');
		$qq_nickname = cookie('qq_nickname');
		$headurl = !empty($qq_headurl) ? $qq_headurl : '/Template/admin/img/blog/21.png';
		$is_qq_login = !empty($qq_headurl) ? 1 : 0;
		//qq-login-url 
		$now_url = urlencode(C('QQ_REDIRECT_URI'));
		$state = MODULE_NAME .'-'. CONTROLLER_NAME  . '-' . ACTION_NAME .'-id-' . $id;
		$qq_login_url = "https://graph.qq.com/oauth2.0/authorize?".
						"response_type=code&" . 
						"client_id=101215106&" . 
						"redirect_uri=$now_url&" .
						"state=".$state;
		$qq_logout_url = U('Public/qqlogout',array('state'=>$state));
		session('state',$state);  //设置session
		$this->assign('info',$info);
		$this->assign('tags',$tags);
		$this->assign('comments_list',$comments_list);
		$this->assign('page',$show);
		$this->assign('p',$p);
		$this->assign('qq_login_url',$qq_login_url);
		$this->assign('qq_nickname',$qq_nickname);
		$this->assign('headurl',$headurl);
		$this->assign('is_qq_login',$is_qq_login);
		$this->assign('qq_logout_url',$qq_logout_url);
		$this->display();
	}
	
	/**
	 * @todo: 发送评论
	 * @author Saki <ilulu4ever816@gmail.com>
	 * @date 2014-12-22 上午9:34:18
	 * @version V1.0
	 */
	public function PostComment(){
		$model = new \Admin\Model\ArticleCommentModel();
		$post = $_POST['ArticleComment'];
		$id = $post['aid'];
		$comment_id = $model->createComment($post);
		//发送邮件，这里为游客发送评论，则为管理员邮箱收到邮件
		if($comment_id){
			\Think\Hook::listen('postComment',$comment_id);
			\Think\Hook::add('postComment','Home\\Behaviors\\emailBehavior');
		}
		$this->redirect('Article/view', array('id' => $id,'p'=>1));
	}
	
	
	/**
	 * @todo: 前台点击【文章标签】操作控制器
	 * @author Saki <ilulu4ever816@gmail.com>
	 * @date 2015-1-7 下午3:12:21
	 * @version V1.0
	 */
	public function Tagslog(){
		$model = new \Admin\Model\ArticleListModel();
		$type_model = D('Admin/ArticleType');
		//查询条件判断
		$map['admin_id'] = 1;
		if(isset($_GET['code'])){
			$condition['id'] = $_GET['code'];
			$ishas_type = D('Admin/ArticleType')->where($condition)->limit(1)->find();
			if($ishas_type){
				$map['type_id'] = $_GET['code'];
			}
		}
		$count = $model->where($map)->count();
		//分页显示设置
		$Page = new \Think\Page($count,7);
		$Page->setConfig('prev','上一页');
		$Page->setConfig('next','下一页');
		$Page->setConfig('theme','%FIRST%  %LINK_PAGE%  %END%');
		$show = $Page->show();
		//分页数据处理
		$Parsedown = new \Org\Markdown\Parsedown;
		$list = $model->relation(true)->where($map)->order('ctm desc')->limit ($Page->firstRow.','.$Page->listRows)->select ();
		foreach ($list as $k=>$article){
			//内容的截取
			$content = $article['content'];
			$new_content = strip_tags($Parsedown->text($content));
			$list[$k]['content'] = mb_substr($new_content,0,200, 'utf-8') . '...';
			//时间的处理
			$list[$k]['ctm_M'] = date('M',strtotime($article['ctm']));//月份简写
			$ctm_F = date('F',strtotime($article['ctm']));//月份全写
			$len_M = strlen($list[$k]['ctm_M']);//缩写字符串的长度
			$ctm_F = mb_substr($ctm_F,$len_M);//截取剩余字符串
			$list[$k]['ctm_F'] = $ctm_F;//月份全写截取后的剩余字符串
			$list[$k]['ctm_Y'] = date('Y',strtotime($article['ctm']));//年份
			$list[$k]['ctm_D'] = date('d',strtotime($article['ctm']));//日期
		}
		$this->assign('list',$list);
		$this->assign('page',$show);
		$this->display('tags');
	}
}