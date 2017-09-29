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
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 权利监控 <span class="c-gray en">&gt;</span> 四项监控 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-15">
    <div class="pd-15 radius lh-22 mb-5" style="background: #eee;">
        <h4 style="font-weight: bold;"><?php echo ($major['subject']); ?></h4>
        <div style="text-indent: 2em;" class="sqjk"><span class="init">&nbsp;<?php echo ($major['content']); ?></span>&nbsp;&nbsp;<a title="修改" class="ml-5" onclick="jtzr_edit('修改四权监控内容','<?php echo U("edit",array("id"=>$major["id"],"oid"=>$major["oid"]),"");?>')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a></div>
    </div>
    <div class="cl pd-5 bg-1 bk-gray">
        <span class="l"><a href="javascript:;" class="btn btn-primary radius " onclick=jtzr_add('添加主题','<?php echo U("add","oid=$oid","");?>') ><i class="Hui-iconfont">&#xe600;</i> 添加主题</a></span>
    </div>
    <table class="table table-border table-bordered table-hover table-bg table-sort">
        <thead>
        <tr class="text-c">
            <th width="25">ID</th>
            <th width="100">主题</th>
            <th>内容</th>
            <th width="30">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($subjects)): $k = 0; $__LIST__ = $subjects;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$subject): $mod = ($k % 2 );++$k;?><tr class="text-c">
            <td><?php echo ($k); ?></td>
            <td><?php echo ($subject['subject']); ?></td>
            <td  class="text-l"><?php echo ($subject['content']); ?>
            </td>
            <td> <a title="修改" class="ml-5" onclick="jtzr_edit('修改四权监控内容','<?php echo U("edit2",array("id"=>$subject["id"],"oid"=>$subject["oid"]),"");?>')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a></a><br/><br/>&nbsp;<a title="删除" href="javascript:;" onclick="item_del(this,'1')" class="ml-5" style="text-decoration:none" id="<?php echo U('delete',array('id'=>$subject['id']),'');?>"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>


</div>
<script type="text/javascript" src="/monitor/Public/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/lib/Validform/5.3.2/Validform.min.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/lib/layer/1.9.3/layer.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/lib/icheck/jquery.icheck.min.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/js/H-ui.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/js/H-ui.admin.js"></script>


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
       //如果四权监控的内容为空，则添加前台手动添加内容
        console.log($("h4").text().length)
        if($("h4").text().length==0){
            $("h4").text('四权监控');
        }
        console.log($(".init").text())
        if($(".init").text().length<=1){
            $(".init").text('四权指：依法确权、规范配权、阳光晒权、全程控权；四权指：依法确权、规范配权、阳光晒权、全程控权；四权指：依法确权、规范配权、阳光晒权、全程控权；四权指：依法确权、规范配权、阳光晒权、全程控权；四权指：依法确权、规范配权、阳光晒权、全程控权；四权指：依法确权、规范配权、阳光晒权、全程控权；四权指：依法确权、规范配权、阳光晒权、全程控权；四权指：依法确权、规范配权、阳光晒权、全程控权；四权指：依法确权、规范配权、阳光晒权、全程控权；四权指：依法确权、规范配权、阳光晒权、全程控权；四权指：依法确权、规范配权、阳光晒权、全程控权；四权指：依法确权、规范配权、阳光晒权、全程控权；');
        }
    });

    /*事项-删除*/
    function item_del(obj,id){
        var url = $(obj).attr('id');
        layer.confirm('确认要删除吗？',function(index){
            $.get(url,function(data){
                if(data==1){
                    //location.reload();
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                }

            })

        });
    }
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
        layer.confirm('确认要删除吗？',function(index){
            $(obj).parents("tr").remove();
            layer.msg('已删除!',{icon:1,time:1000});
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