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
    <script type="text/javascript" src="/monitorall/Public/admin/lib/html5.js"></script>
    <script type="text/javascript" src="/monitorall/Public/admin/lib/respond.min.js"></script>
    <script type="text/javascript" src="/monitorall/Public/admin/lib/PIE_IE678.js"></script>
    <![endif]-->
    <link href="/monitorall/Public/admin/css/H-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="/monitorall/Public/admin/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
    <link href="/monitorall/Public/admin/skin/default/skin.css" rel="stylesheet" type="text/css" id="skin" />
    <link href="/monitorall/Public/admin/lib/Hui-iconfont/1.0.1/iconfont.css" rel="stylesheet" type="text/css" />
    <link href="/monitorall/Public/admin/css/style.css" rel="stylesheet" type="text/css" />
    <link href="/monitorall/Public/admin/css/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="/monitorall/Public/admin/css/page.css" rel="stylesheet" type="text/css" />
    <link href="/monitorall/Public/admin/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
    <link href="/monitorall/Public/admin/css/new.css" rel="stylesheet" type="text/css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->

    <title>监督执纪问责监控平台</title>
</head>
<body>
<table class="table table-border table-bordered table-hover table-bg table-sort hide">
    <thead>
        <tr class="text-c">
        <th width="25" rowspan="2"><input type="checkbox" name="" value=""></th>
        <th width="25" rowspan="2">ID</th>
        <th colspan="3">责成退缴违纪所得</th>
        <th rowspan="2" width="70px">时间</th>
        <th rowspan="2">摘要</th>
        <th rowspan="2" width="80px">涉及类型</th>
        <th rowspan="2" width="80px">问题线索来源</th>
        <th width="30" rowspan="2">操作</th>

        <tr class="text-c">
        <th width="40px">姓名</th>
        <th width="50px">单位</th>
        <th width="40px">职务</th>
    </tr>
    </thead>
    <tbody>
        <?php if(is_array($wjsdData)): $i = 0; $__LIST__ = $wjsdData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            <td class="text-c"><input type="checkbox" value="1" name=""></td>
            <td class="text-c"><?php echo ($vo['id']); ?></td>
            <td><?php echo ($vo['name2']); ?></td>
            <td><?php echo ($vo['unit2']); ?></td>
            <td><?php echo ($vo['duty2']); ?></td>
            <td><?php echo (date('Y-m-d',$vo['solvetime'])); ?></td>
            <td><?php echo ($vo['summary']); ?></td>
            <td><?php echo ($vo['tname']); ?></td>
            <td><?php echo ($vo['sname']); ?></td>
            <td><a title="修改" class="ml-5" onclick="jtzr_edit('修改执纪问责','zjwzxt1_edit.html')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a></a> <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </tbody>
</table>
<div class="text-r mt-20 page">
    <?php echo ($page); ?>
</div>
</body>
</html>