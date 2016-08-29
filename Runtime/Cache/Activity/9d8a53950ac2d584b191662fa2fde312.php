<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>三周年抽奖</title>
    <meta property="qc:admins" content="351427627416141650056551637572744" />
    <script type="text/javascript" src="/Template/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="/Template/activity/js/index.js"></script>
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/Template/activity/css/index.css" type="text/css"/>
</head>

<body>

<!--<iframe frameborder="no" style="position: absolute;"-->
        <!--border="0" marginwidth="0" marginheight="0"-->
        <!--width=330 height=86-->
        <!--src="http://music.163.com/outchain/player?type=2&id=34916176&auto=1&height=66">-->
<!--</iframe>-->




<div id="left-container">
    <!--<img src="../../../../Template/activity/img/1.png" class="kawayi_moster">-->
    <!--<img src="../../../../Template/activity/img/2.png" class="kawayi_moster">-->
    <!--<img src="../../../../Template/activity/img/3.png" class="kawayi_moster">-->
    <!--<img src="../../../../Template/activity/img/4.png" class="kawayi_moster">-->
    <!--<img src="../../../../Template/activity/img/5.png" class="kawayi_moster">-->
    <!--<img src="../../../../Template/activity/img/6.png" class="kawayi_moster">-->
    <!--<img src="../../../../Template/activity/img/7.png" class="kawayi_moster">-->
    <!--<img src="../../../../Template/activity/img/8.png" class="kawayi_moster">-->
    <!--<img src="../../../../Template/activity/img/9.png" class="kawayi_moster">-->
    <!--<img src="../../../../Template/activity/img/10.png" class="kawayi_moster">-->
    <!--<img src="../../../../Template/activity/img/11.png" class="kawayi_moster">-->
    <!--<img src="../../../../Template/activity/img/12.png" class="kawayi_moster">-->
    <!--<img src="../../../../Template/activity/img/13.png" class="kawayi_moster">-->
    <!--<img src="../../../../Template/activity/img/14.png" class="kawayi_moster">-->
</div>

<div id="right-container">
</div>


<div id="center-container">

    <div class="module_one">
        <img class="logo-img" src="../../../../Template/activity/img/zhounianqingdian.png">
    </div>

    <!--<div class="line"></div>-->

    <div class="module_two">
        <div class="panel panel-primary">
            <div class="panel-heading">ROLL点奖品说明</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-4 col-md-4">
                        <div class="thumbnail">
                            <img src="../../../../Template/activity/img/prize_1.jpg" alt="...">
                            <div class="caption">
                                <h3>黏土手办</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <div class="thumbnail">
                            <img src="../../../../Template/activity/img/prize_2.jpg" alt="...">
                            <div class="caption">
                                <h3>零食</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <div class="thumbnail">
                            <img src="../../../../Template/activity/img/prize_3.jpg" alt="...">
                            <div class="caption">
                                <h3>咸鱼抱枕</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="module_three">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">参加人员</h3>
            </div>
            <div class="panel-body">

                <div class="row">

                    <?php if(is_array($userList)): $i = 0; $__LIST__ = $userList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><div class="col-xs-2 col-md-2">
                            <a href="#" class="thumbnail">
                                <img style="max-width: 50%;" class="img-responsive "
                                     src="<?php echo ($user["headimgurl"]); ?>" alt="...">
                            </a>
                        </div><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>

            </div>
        </div>

    </div>

    <div class="module_four">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">翻滚吧！数字！</h3>
            </div>
            <div class="panel-body">


                <div class="row">
                    <div class="col-xs-4 col-md-4">
                        <a href="javascript:void(0);" class="thumbnail">
                            <h1 class="roll_num" id="num_1">0</h1>
                        </a>
                    </div>
                    <div class="col-xs-4 col-md-4">
                        <a href="javascript:void(0);" class="thumbnail">
                            <h1 class="roll_num" id="num_2">0</h1>
                        </a>
                    </div>
                    <div class="col-xs-4 col-md-4">
                        <a href="javascript:void(0);" class="thumbnail">
                            <h1 class="roll_num" id="num_3">0</h1>
                        </a>
                    </div>
                </div>


                <?php if($is_qq_login != 1): ?><button type="button" class="btn btn-success btn-lg col-md-12" id="qq-login">QQ登录</button>
                    <?php else: ?>
                    <button type="button" class="btn btn-success btn-lg col-md-6" id="roll-btn">ROLL</button>
                    <button type="button" class="btn btn-danger btn-lg col-md-6" id="qq-logout">退出登录</button><?php endif; ?>

            </div>
        </div>
    </div>

    <div class="module_five">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">排行榜</h3>
            </div>
            <div class="panel-body">
                <table class="table table-hover" style="text-align: center">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>头像</th>
                        <th>名称</th>
                        <th>点数</th>
                    </tr>
                    </thead>
                    <?php if(is_array($userList)): $k = 0; $__LIST__ = $userList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($k % 2 );++$k;?><tr>
                            <td width="5%"><?php echo ($k); ?></td>
                            <td width="20%"><img style="width: 30%;border-radius: 55px;" src="<?php echo ($user["headimgurl"]); ?>"></td>
                            <td><?php echo ($user["name"]); ?></td>
                            <td>xxx</td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </table>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">

    $("#qq-login").click(function(){
        window.location.href = '<?php echo ($qq_login_url); ?>';
    });


</script>