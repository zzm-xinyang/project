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

<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span>新闻动态<a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ></a></nav>
<div class="pd-20">

	<div class="cl pd-5 bg-1 bk-gray text-l">

		<span class="l mr-5"><a href="<?php echo U('News/xwdt_delsome','','');?>"  class="btn btn-danger radius" id="dels"><i class="Hui-iconfont"></i> 批量删除</a></span>
		<span class="l"><a class="btn btn-primary radius"  href="<?php echo U('News/xwdt_add');?>"><i class="Hui-iconfont">&#xe600;</i>添加新闻</a></span>
        <form action="<?php echo U('News/xwdt_search');?>" method="post" class="form form-horizontal" id="form-article-add">
        <div class="text-r"> 日期范围：
			<input type="text" onfocus="WdatePicker({lang:'zh-cn'})" name="logmin" id="logmin" class="input-text Wdate" style="width:120px;" value="<?php echo ($mintime); ?>">
			-
			<input type="text" onfocus="WdatePicker({lang:'zh-cn'})" name="logmax" id="logmax" class="input-text Wdate" style="width:120px;" value="<?php echo ($maxtime); ?>">
			<input type="text" name="newskeyword" id="" placeholder=" 关键词" style="width:180px" class="input-text" value="<?php echo ($newskeyword); ?>">
			<button name="submit" id="newsearch" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
		</div>
        </form>
	</div>
	<form method="post" action="<?php echo U('News/xwdt_delsome','','');?>" id="xwdt_del">
	<table class="table table-border table-bordered table-hover table-bg table-sort" >
		<thead>
		<tr class="text-c">
			<th width="25"><input type="checkbox" name="" value=""></th>
			<th width="35">ID</th>
			<th>标题</th>
			<th width="80">发布者</th>
			<th width="90">更新时间</th>
			<th width="100">操作</th>
		</tr>
		</thead>
		<tbody>
		<?php if(is_array($newslists)): $i = 0; $__LIST__ = $newslists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$list): $mod = ($i % 2 );++$i;?><tr class="text-c">
			<td  class="text-c"><input type="checkbox" value="<?php echo ($list["id"]); ?>" name="newsdels[]" class="checkdels"></td>
			<td><?php echo ($i); ?></td>
			<td class="text-l"><a target="_blank" href="<?php echo U('Sjzxf/News/newscontent');?>?newsid=<?php echo ($list["id"]); ?>"><?php echo ($list["title"]); ?></a></td>
			<td><?php echo ($session["oid"]); ?></td>
			<td><?php echo (date("Y-m-d H:i:s",$list['updatetime'])); ?></td>
			<td><a title="详情" class="ml-5" target="_blank" href="<?php echo U('Sjzxf/News/newscontent');?>?newsid=<?php echo ($list["id"]); ?>">详情</a><a title="修改" class="ml-5"  href="<?php echo U('News/xwdt_edit');?>?newsid=<?php echo ($list["id"]); ?>">修改</a><a title="删除" href="javascript:;" onclick="member_del(this,'<?php echo ($list["id"]); ?>')" class="ml-5" style="text-decoration:none">删除</a>
			</td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>


		</tbody>
	</table>
		<input type="submit" name="submit" style="display: none;" id="submit">
		<input type="hidden" id="mintime" value="<?php echo ($mintime); ?>" />
		</form>
	<div class="page text-r mt-20">

		<?php echo ($page); ?>
	</div>
	<!--<div class="text-r mt-20">

		<a class="radius bk-gray pd-10">上一页</a>
		<a class="radius bk-gray pd-10" style="background:#0044CC;color:#fff;">1</a>
		<a class="radius bk-gray pd-10">2</a>
		<a class="radius bk-gray pd-1">下一页</a>
	</div>-->



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

	$(function(){
		$("#dels").click(function(){
			$("#submit").click();
			return false;
		});

		//为页码附加搜索条件
		$(".pages .num").each(function(){
			console.log( $("#mintime").val());
			var newText = $(this).text() + $("#mintime").val();
			$(this).text(newText);
		})
	})

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

	function findcheckbox(){
		obj = document.getElementsByName("newsdels");
		check_val = [];
		for(k in obj){
			if(obj[k].checked)
				check_val.push(obj[k].value);
		}
		return check_val;
	}

	function member_edit(title,url,id,w,h){
		layer_show(title,url,w,h);
	}
	/*用户-删除*/
	function member_del(obj,id){
		layer.confirm('确认要删除吗？',function(index){
            window.location.href="/monitor/index.php/Admin/News/delete?newsid="+id;
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