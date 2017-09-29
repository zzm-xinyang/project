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
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span>政策法规 <span class="c-gray en">&gt;</span>内容管理<a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
    <div class="cl pd-5 bg-1 bk-gray text-l">
        <span class="l mr-5"><a href="javascript:void(0)" onclick="batch_del(this,'1')" class="btn btn-danger radius"><i class="Hui-iconfont"></i> 批量删除</a></span>
        <span class="l"><a class="btn btn-primary radius" onclick="jtzr_add('添加','../Regulations/regulationsAdd.html')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i>添加</a></span>
        <form action="/monitor/index.php/Admin/Regulations/search/" method="post">
        <div class="text-r"> 日期范围：
            <input type="text" name="upTime" onfocus="WdatePicker()" id="logmin" class="input-text Wdate" style="width:120px;">
            -
            <input type="text" name="downTime" onfocus="WdatePicker()" id="logmax" class="input-text Wdate" style="width:120px;">
            <input type="text" name="keyWords" id="key" placeholder=" 关键词" style="width:180px" class="input-text">
            <button name="search" id="sear" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
        </div>
        </form>
    </div>

    <table class="table table-border table-bordered table-hover table-bg table-sort">
        <thead>
        <tr class="text-c">
            <th width="25"><input type="checkbox" name="" value=""></th>
            <th width="35">ID</th>
            <th width="80">类别</th>
            <th>标题</th>
            <th width="80">发布者</th>
            <th width="90">更新时间</th>
            <th width="100">操作</th>
        </tr>
        </thead>
        <form action="/monitor/index.php/Admin/Regulations/ShowAllRegulations" method="post" class="form form-horizontal" id="form-article-update">
            <tbody>
            <?php if(is_array($regulations)): $i = 0; $__LIST__ = $regulations;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c" name="test1">
                <td  class="text-c"><input type="checkbox" value=<?php echo ($vo["rid"]); ?> name="check_id[]"></td>
                <td><?php echo ($key+1); ?></td>
                <td><?php echo ($vo["name"]); ?></td>
                <td><?php echo ($vo["title"]); ?></td>
                <td><?php echo ($vo["author"]); ?></td>
                <td><?php echo ($vo["updatetime"]); ?></td>
                <td>
                    <a title="详情" class="ml-5" target="_blank" href="<?php echo U('Sjzxf/Regulations/showContent');?>?rid=<?php echo ($vo["rid"]); ?>&title=<?php echo ($vo["title"]); ?>&updatetime=<?php echo ($vo["updatetime"]); ?>">详情</a>
                    <a title="修改" class="ml-5" onclick="jtzr_edit('修改政策法规','../Regulations/regulationsUpdate.html?rid=<?php echo ($vo["rid"]); ?>&tid=<?php echo ($vo["tid"]); ?>')" href="javascript:void(0)">修改</a>
                    <a title="删除" class="ml-5" onclick="member_del(this,'<?php echo ($vo["rid"]); ?>')" href="javascript:;" style="text-decoration:none">删除</a>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
        </form>
    </table>
    <div class="text-r mt-20 page">
        <?php echo ($page); ?>
    </div>
</div>

<script type="text/javascript" src="/monitor/Public/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/lib/Validform/5.3.2/Validform.min.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/lib/layer/1.9.3/layer.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/lib/icheck/jquery.icheck.min.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/js/H-ui.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/lib/My97DatePicker/WdatePicker.js"></script>
<!--饼形图-->
<script type="text/javascript" src="/monitor/Public/admin/lib/Highcharts/4.1.7/js/highcharts.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/lib/Highcharts/4.1.7/js/modules/exporting.js"></script>

<script type="text/javascript">
    $(function(){
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });
        $.Huitab("#tab-system .tabBar span","#tab-system .tabCon","current","click","0");
    });

    /*饼形图*/
    $(function () {
        $('#container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: '2017年党委主体责任落实统计'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#f0000',
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                type: 'pie',
                name: '2017年党委主体责任落实统计',
                data: [
                    {
                        name: '已完成',
                        y: 52,
                        color:'#698B22',
                        sliced: true,
                        selected: true
                    },
                    {
                        name: '未完成',
                        y: 17,
                        color:'#ff0000',
                        sliced: true,
                        selected: true
                    },
                    {
                        name: '待完成',
                        y: 31,
                        color:'#EE7621',
                        sliced: true,
                        selected: true
                    }
                ]
            }]
        });
    });
    /*集体责任-编辑*/
    function jtzr_edit(title,url){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }

    function member_edit(title,url,id,w,h){
        layer_show(title,url,w,h);
    }
    /*用户-删除*/
    function member_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            window.location.href= "/monitor/index.php/Admin/Regulations/regulationsDel/id/"+id;
            layer.msg('已删除!',{icon:1,time:1000});
        });
    }
    /*批量-删除*/
    function batch_del(obj,id1){
        layer.confirm('确认要删除吗？',function(index){
            var obj_id = document.getElementsByName('check_id[]');
            check_val = [];
            for(i in obj_id){
                if (obj_id[i].checked){
                    check_val.push(obj_id[i].value);
                }
            }
            window.location.href = "/monitor/index.php/Admin/Regulations/batchDel/check_id/"+check_val;
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
    function solve(o){
        $(o).parent().prev().html('已处理');
        $(o).remove();
    }
</script>
</body>
</html>