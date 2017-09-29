<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>石家庄市公安消防支队监督执纪问责监控平台</title>

    <!-- Bootstrap -->
    <link href="/monitorsvn/Public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/monitorsvn/Public/css/index.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav class="navbar navbar-inverse ">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav ">

                <li>
                    <form class="navbar-form  navbar-right" role="search" action="/monitorsvn/index.php/Sjzxf/Index/search">

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="请输入关键字" name="keyw">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">站内搜索</button>
                        </div>
                    </form>
                </li>
                <li><a><span class="glyphicon glyphicon-time"></span> 2017年06月07日  星期三</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li ><a href="#">公安厅现役纪检监察室</a></li>
                <li ><a href="#">消防总队</a></li>
                <li class="active"><a href="<?php echo U('index/index');?>">石家庄消防支队</a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">大队级单位 <b class="caret"></b></a>
                    <ul class="dropdown-menu text-right">
                        <li><a href="zd/index.html">一大队</a></li>
                        <li><a href="#">二大队</a></li>
                        <li><a href="#">三大队</a></li>

                        <li><a href="#">四大队</a></li>


                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<img src="/monitorsvn/Public/images/xfbanner.jpg" class="img-responsive banner" alt=""/>
<div class="container">

    <div class="row">
        <h1 class="title"><span class="glyphicon glyphicon-list-alt"></span> 新闻动态 <a href="<?php echo U('news/newslist');?> " class="label label-primary more">more</a></h1>
        <div class="col-md-6 col-lg-6">
            <img src="/monitorsvn/Public/images/new.jpg" class="img-responsive" alt=""/>
        </div>
        <div class="col-md-6 col-lg-6 news">

            <h2 class="bt"><?php echo ($news['title']); ?><span class="small">(<?php echo ($news['updatetime']); ?>)</span></h2>
            <p style="font-size:16px">&nbsp;<?php echo ($news['content']); ?>　<a href="<?php echo U('news/newscontent');?>" target="_blank">[查看详情]</a></p>




        </div>
    </div>
</div>
<div class="gray">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 pic">
                <div class="col-xs-12 col-md-6 col-lg-6"><a href="<?php echo U('ztzr/ztzr');?>" target="_blank"><img src="/monitorsvn/Public/images/ztzr.jpg" class="img-responsive"></a></div>
                <div class="col-xs-12 col-md-6 col-lg-6"><a href="<?php echo U('jdzr/jdzr');?>" target="_blank"><img src="/monitorsvn/Public/images/jdzr.jpg" class="img-responsive"></a></div>
                <div class="col-xs-12 col-md-6 col-lg-6"><a href="<?php echo U('qlyx/qlyx');?>" target="_blank"><img src="/monitorsvn/Public/images/qljk.jpg" class="img-responsive"></a></div>
                <div class="col-xs-12 col-md-6 col-lg-6"><a href="<?php echo U('zjwz/zjwz_szxttj');?>" target="_blank"><img src="/monitorsvn/Public/images/zjwz.jpg" class="img-responsive"></a></div>
            </div>
            <div class="col-xs-12 col-sm-6  col-md-6 col-lg-6">
                <div class="row">
                    <div class="col-md-5 col-lg-5 gbpj"><a href="<?php echo U('Dflzjs/index','','');?>" target="_blank"><img src="/monitorsvn/Public/images/icon_gbpj.png" width="170" height="75"></a></div>
                    <div class="col-md-2 col-lg-2 zfpj"><a href="zfpj_zzd.html" target="_blank"><img src="/monitorsvn/Public/images/icon_zfpj.png" width="80" height="75"></a></div>
                    <div class="col-md-4 col-lg-4 jyxc"><a href="<?php echo U('Jyxc/index','','');?>" target="_blank"><img src="/monitorsvn/Public/images/icon_jyxc.png" width="80" height="75"></a></div>
                </div>
                <div class="row">

                    <div class="col-md-4 col-lg-4 jwsj"><a href="<?php echo U('Jwsj/jwsj_zzd');?>" target="_blank"><img src="/monitorsvn/Public/images/icon_jwsj.png" width="120" height="75"></a></div>
                    <div class="col-md-3 col-lg-5 wyjb"><a href="<?php echo U('Reports/index');?>" target="_blank"><img src="/monitorsvn/Public/images/icon_wyjb.png" width="80" height="75"></a></div>
                    <div class="col-md-2 col-lg-2 zdjs"><a href="<?php echo U('regulations/index');?>"  target="_blank"><img src="/monitorsvn/Public/images/icon_zdjs.png" width="80" height="75"></a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--------------------------------页脚------------------------------------------------>

<div class="footer ">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-lg-7">
                <h4>友情链接</h4>
                <div class="row">
                  <div class="col-sm-12 col-lg-6">
                   <select class="form-control">
                      <option>全国公安门户网站</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </div>
                  <div class="col-sm-12 col-lg-6">
                    <select class="form-control">
                      <option>省政府各部门</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 col-lg-6">
                   <select class="form-control">
                      <option>各地公安门户网站</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </div>
                  <div class="col-sm-12 col-lg-6">
                    <select class="form-control">
                      <option>各种警种网站</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </div>
                </div>

            </div>
            <div class="col-sm-3  col-lg-3">
                <div class="row ">                    
                    <div class="col-xs-12 col-sm-12  col-lg-12">
                        <h4>来信举报</h4>
                        <ul class="list-unstyled">
                            <li>
                                地址：河北省石家庄市珠江大道239号
                            </li>
                            <li>
                                邮编：050000
                            </li>
                            <li>
                                举报电话：050000
                            </li>
                            <li>
                                来访请到：河北省公安消防总队
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
             <div class="col-sm-3  col-lg-2">
                <div class="row ">                    
                    <div class="col-xs-12 col-sm-12  col-lg-12">
                        <h4>用户登录</h4>
                        <ul class="list-unstyled">
                            <li>
                                <a href="login.html" target="_blank">登录入口</a>
                            </li>
                           
                        </ul>
                    </div>
                </div>

            </div>
            
            
            
        </div>
    </div>
</div>

 <div class=" footer-bottom">
            <ul class=" text-center">
                <li>Copyright &copy;2015.河北省公安厅版权所有&nbsp;&nbsp; 冀ICP备 07008323号&nbsp;&nbsp; 联系方式：0311-67122288</li>
            </ul>
        </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
   <script src="js/jquery-3.2.1.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>