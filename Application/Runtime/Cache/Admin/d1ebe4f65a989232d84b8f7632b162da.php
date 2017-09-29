<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <LINK rel="Bookmark" href="/favicon.ico" >
    <LINK rel="Shortcut Icon" href="/favicon.ico" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/monitor/Public/admin/lib/html5.js"></script>
    <script type="text/javascript" src="/monitor/Public/admin/lib/respond.min.js"></script>
    <script type="text/javascript" src="/monitor/Public/admin/lib/PIE_IE678.js"></script>
    <script type="text/javascript" src="/monitor/Public/admin/js/date.js"></script>
    <script type="text/javascript" src="/monitor/Public/admin/lib/icheck/jquery.icheck.min.js"></script>
    <script type="text/javascript" src="/monitor/Public/admin/lib/Validform/5.3.2/Validform.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="/monitor/Public/admin/lib/html5.js"></script>
    <script type="text/javascript" src="/monitor/Public/admin/lib/respond.min.js"></script>
    <script type="text/javascript" src="/monitor/Public/admin/lib/PIE_IE678.js"></script>
    <script type="text/javascript" src="/monitor/Public/admin/js/date.js"></script>
    <script type="text/javascript" src="/monitor/Public/admin/lib/icheck/jquery.icheck.min.js"></script>
    <script type="text/javascript" src="/monitor/Public/admin/lib/Validform/5.3.2/Validform.min.js"></script>
    <link href="/monitor/Public/admin/css/H-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="/monitor/Public/admin/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
    <link href="/monitor/Public/admin/skin/default/skin.css" rel="stylesheet" type="text/css" id="skin" />
    <link href="/monitor/Public/admin/lib/Hui-iconfont/1.0.1/iconfont.css" rel="stylesheet" type="text/css" />
    <link href="/monitor/Public/admin/css/style.css" rel="stylesheet" type="text/css" />
    <link href="/monitor/Public/admin/css/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="/monitor/Public/admin/css/page.css" rel="stylesheet" type="text/css" />
    <link href="/monitor/Public/admin/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
    <link href="/monitor/Public/admin/css/new.css" rel="stylesheet" type="text/css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>




    <![endif]-->

    <title>监督执纪问责监控平台</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 权利监控 <span class="c-gray en">&gt;</span> 领导岗位权力 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-15">
    <div class="pd-15 radius lh-22 mb-5" style="background: #eee;">
        <h4><strong>领导岗位权力清单</strong>&nbsp;<a class="btn btn-primary radius pl-10 pr-10 add" onclick=jtzr_add('添加权力','<?php echo U("Iposition/add","oid=$oid","");?>') href="javascript:;" >+</a></h4>
        <ul class="list lh-24">
            <?php if(is_array($members)): $i = 0; $__LIST__ = $members;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?><li>
                    <?php if($who == $m['id']): ?><a href="<?php echo U('Iposition/index',array('who'=>$m['id']),'');?>"  class="cur"><span><?php echo ($m['duty']); ?></span><span><?php echo ($m['name']); ?></span><input type="hidden" value="<?php echo ($m['id']); ?>"/></a>&nbsp;&nbsp;
                        <?php else: ?>
                        <a href="<?php echo U('Iposition/index',array('who'=>$m['id']),'');?>"><span><?php echo ($m['duty']); ?></span><span><?php echo ($m['name']); ?></span><input type="hidden" value="<?php echo ($m['id']); ?>"/></a>&nbsp;&nbsp;<?php endif; ?>

                    <a title="修改" class="ml-5" onclick=jtzr_edit("修改","<?php echo U('Iposition/edit',array('id'=>$m['id']),'');?>") href="javascript:;"><img src="/monitor/Public/admin/images/pen.png" width="12"/><a>&nbsp;
                        <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none" id="<?php echo U('Iposition/delete',array('id'=>$m['id']),'');?>"><img src="/monitor/Public/admin/images/delete.png" width="12"/></a>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
    <div class="pd-15 radius lh-22 mb-5 content" style="background: #eee;">
        <h4><span id="who"></span>主要职责清单</h4>
        <div class="pl-20" id="dutys">
            <?php echo ($member['dutys']); ?>
        </div>
        <h4>风险清单</h4>
        <div class="pl-20" id="risks">
            <?php echo ($member['risks']); ?>
        </div>
        <h4>风险等级</h4>
        <div class="pl-20" id="rlevel">
            <?php echo ($member['rlevel']); ?>
        </div>
        <h4>防控清单</h4>
        <div class="pl-20" id="controls">
            <?php echo ($member['controls']); ?>
        </div>
    </div>



</div>
<script type="text/javascript" src="/monitor/Public/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/lib/Validform/5.3.2/Validform.min.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/lib/layer/1.9.3/layer.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/lib/icheck/jquery.icheck.min.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/js/H-ui.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/lib/My97DatePicker/WdatePicker.js"></script>


<script type="text/javascript">
    $(function(){
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });
        $.Huitab("#tab-system .tabBar span","#tab-system .tabCon","current","click","0");
    });

    $(function(){
        $("#who").text($(".list a.cur").text());
    })

    /*集体责任-编辑*/
    function jtzr_edit(title,url){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
    /*用户-删除*/
    function member_del(obj,id){
        var url = $(obj).attr('id');
        layer.confirm('确认要删除吗？',function(index){
            $.get(url,function(data){
                if(data==1){
                    $(obj).parents("li").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                }

            })
        });
    }
    /*集体责任清单-添加*/
    function jtzr_add(title,url){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
</script>
</body>
</html>