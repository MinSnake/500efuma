<?php
/**
 * 菜单列表
 * @author Saki <zha_zha@outlook.com>
 * @date 2014-8-2 上午9:35:21
 * @version v1.0.0
 */
function sidebar(){
	return array(
		'home' => array(
			'name'=>'首页',
			'key'=>'home',	
			'url'=> U('Admin/Home/index'),
			'icon'=>'fa-home',
		),
		'article' => array(
			'name'=>'文章管理',
			'key'=>'article',
			'url'=>'',
			'icon'=>'fa-bar-chart-o',
			'child'=>array(
				'workType'=>array(
					'name'=>'文章类型',
					'key'=>'articleType',
					'url'=> U('Admin/ArticleType/index'),
				),
				'workList'=>array(
					'name'=>'文章列表',
					'key'=>'articleList',
					'url'=> U('Admin/ArticleList/index'),
				),
			),
		),
// 		'reply' => array(
// 			'name'=>'回复管理',
// 			'key'=>'reply',
// 			'url'=>U('Admin/Reply/index'),
// 			'icon'=>'fa-bar-chart-o',
// 		),
		'self' => array(
			'name'=>'简历管理',
			'key'=>'self',
			'url'=>U('Admin/Self/index'),
			'icon'=>'fa-file-text',
			'child'=>array(
				'selfInfo'=>array(
					'name'=>'基本信息',
					'key'=>'selfInfo',
					'url'=>U('Admin/Self/info'),
				),
				'selfSkill'=>array(
					'name'=>'天赋技能',
					'key'=>'selfSkill',
					'url'=>U('Admin/Self/skill'),
				),
				'selfCompany'=>array(
					'name'=>'历史成就',
					'key'=>'selfCompany',
					'url'=>U('Admin/Self/company'),
				),
				'selfProject'=>array(
					'name'=>'首领击杀',
					'key'=>'selfProject',
					'url'=>U('Admin/Self/project'),
				),
			),
		),
		'system' => array(
			'name'=>'系统管理',
			'key'=>'system',
			'url'=>'',
			'icon'=>'fa-cogs',
			'child'=>array(
				'sysMsg'=>array(
					'name'=>'傻逼语录',
					'key'=>'sysMsg',
					'url'=>U('Admin/System/editText'),
				),
// 				'sysPhone'=>array(
// 					'name'=>'联系方式',
// 					'key'=>'sysPhone',
// 					'url'=>U('Admin/System/index'),
// 				),
			),
		),
		'links' => array(
			'name'=>'友链管理',
			'key'=>'links',
			'url'=>U('Admin/Links/index'),
			'icon'=>'fa-exchange',
		),
		'message' => array(
			'name'=>'留言板管理',
			'key'=>'message',
			'url'=>U('Admin/Message/index'),
			'icon'=>'fa-comments-o',
		),
	    
	);
}