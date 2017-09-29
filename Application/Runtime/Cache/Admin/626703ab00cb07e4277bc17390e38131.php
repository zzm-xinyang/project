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
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/monitor/Public/admin/lib/html5.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/lib/respond.min.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/lib/PIE_IE678.js"></script>
<![endif]-->
<link href="/monitor/Public/admin/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="/monitor/Public/admin/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
<link href="/monitor/Public/admin/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
	<link href="/monitor/Public/admin/css/page.css" rel="stylesheet" type="text/css" />
<link href="/monitor/Public/admin/lib/Hui-iconfont/1.0.1/iconfont.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="/monitor/Public/admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>官兵监督</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 作风评价 <span class="c-gray en">&gt;</span> 官兵监督<a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	<div class="cl pd-5 bg-1 bk-gray">  
		<span class="l mt-5 mr-5"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont"></i> 批量删除</a></span>
		<div class="text-r">
			日期范围：
			<input type="text" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M\'}'})" id="logmin" class="input-text Wdate" style="width:120px;">
			-
			<input type="text" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M'})" id="logmax" class="input-text Wdate" style="width:120px;">
			<input type="text" name="kwd" id="kwd" placeholder=" 关键词" style="width:180px" class="input-text">
			
			<button name="" id="" class="btn btn-success" onclick="wz_search()" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
		</div>
	</div>
	<div id="datalist">
		<table class="table table-border table-bordered table-hover table-bg table-sort">
			<thead>
			<tr class="text-c">
				<th width="25" rowspan="2"><input type="checkbox" class="all" name="" value=""></th>
				<th width="25" rowspan="2">ID</th>
				<th colspan="3">评价对象</th>
				<th colspan="4">官兵</th>
				<th width="90px" rowspan="2">评价时间</th>
				<th width="60px" rowspan="2">操作</th>
			</tr>
			<tr class="text-c">
				<th width="60px">部门</th>
				<th width="50px">姓名</th>
				<th width="50px">职务</th>
				<th width="50px">姓名</th>
				<th width="90px">身份证/警官证</th>
				<th width="50px">电话</th>
				<th>内容</th>
			</tr>
			</thead>
			<tbody>
			<?php if(is_array($dataList)): $i = 0; $__LIST__ = $dataList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
					<td class="text-c"><input type="checkbox" value="<?php echo ($vo["id"]); ?>" name="id[]"></td>
					<td><?php echo ($i); ?></td>
					<td class="text-l"><?php echo ($vo['dname']); ?></td>
					<td><?php echo ($vo['oname']); ?></td>
					<td><?php echo ($vo['dduty']); ?></td>
					<td><a href=""><?php echo ($vo['jname']); ?></a></td>
					<td><?php echo ($vo['number']); ?></td>
					<td><?php echo ($vo['phone']); ?></td>
					<td><?php echo ($vo['content']); ?></td>
					<td><?php echo (date('Y-m-d',$vo['evaluatetime'])); ?></td>
					<td><a title="删除" href="javascript:;" onclick="member_del(this,'<?php echo ($vo[id]); ?>')" class="ml-5"
						   style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			<!--
			<tr class="text-c">
				<td  class="text-c"><input type="checkbox" value="1" name=""></td>
				<td>1</td>
				<td class="text-l">司令部</td>
				<td>X X X</td>
				<td>X X X</td>
				<td><a href="">X X X</a></td>
				<td>1234556778834546</td>
				<td>13789765467</td>
				<td>X X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X X</td>
				<td>2017-07-12</td>
				<td><a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
			</tr>
			<tr class="text-c">
				<td  class="text-c"><input type="checkbox" value="1" name=""></td>
				<td>2</td>
				<td class="text-l">司令部</td>
				<td>X X X</td>
				<td>X X X</td>
				<td><a href="">X X X</a></td>
				<td>1234556778834546</td>
				<td>13789765467</td>
				<td>X X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X X</td>
				<td>2017-07-12</td>
				<td><a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
			</tr><tr class="text-c">
				<td  class="text-c"><input type="checkbox" value="1" name=""></td>
				<td>3</td>
				<td class="text-l">司令部</td>
				<td>X X X</td>
				<td>X X X</td>
				<td><a href="">X X X</a></td>
				<td>1234556778834546</td>
				<td>13789765467</td>
				<td>X X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X X</td>
				<td>2017-07-12</td>
				<td><a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
			</tr><tr class="text-c">
				<td  class="text-c"><input type="checkbox" value="1" name=""></td>
				<td>4</td>
				<td class="text-l">司令部</td>
				<td>X X X</td>
				<td>X X X</td>
				<td><a href="">X X X</a></td>
				<td>1234556778834546</td>
				<td>13789765467</td>
				<td>X X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X X</td>
				<td>2017-07-12</td>
				<td><a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
			</tr><tr class="text-c">
				<td  class="text-c"><input type="checkbox" value="1" name=""></td>
				<td>5</td>
				<td class="text-l">司令部</td>
				<td>X X X</td>
				<td>X X X</td>
				<td><a href="">X X X</a></td>
				<td>1234556778834546</td>
				<td>13789765467</td>
				<td>X X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X X</td>
				<td>2017-07-12</td>
				<td><a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
			</tr>
			<tr class="text-c">
				<td  class="text-c"><input type="checkbox" value="1" name=""></td>
				<td>6</td>
				<td class="text-l">司令部</td>
				<td>X X X</td>
				<td>X X X</td>
				<td><a href="">X X X</a></td>
				<td>1234556778834546</td>
				<td>13789765467</td>
				<td>X X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X X</td>
				<td>2017-07-12</td>
				<td><a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
			</tr>
			<tr class="text-c">
				<td  class="text-c"><input type="checkbox" value="1" name=""></td>
				<td>7</td>
				<td class="text-l">司令部</td>
				<td>X X X</td>
				<td>X X X</td>
				<td><a href="">X X X</a></td>
				<td>1234556778834546</td>
				<td>13789765467</td>
				<td>X X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X X</td>
				<td>2017-07-12</td>
				<td><a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
			</tr>
			<tr class="text-c">
				<td  class="text-c"><input type="checkbox" value="1" name=""></td>
				<td>8</td>
				<td class="text-l">司令部</td>
				<td>X X X</td>
				<td>X X X</td>
				<td><a href="">X X X</a></td>
				<td>1234556778834546</td>
				<td>13789765467</td>
				<td>X X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X X</td>
				<td>2017-07-12</td>
				<td><a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
			</tr>
			<tr class="text-c">
				<td  class="text-c"><input type="checkbox" value="1" name=""></td>
				<td>9</td>
				<td class="text-l">司令部</td>
				<td>X X X</td>
				<td>X X X</td>
				<td><a href="">X X X</a></td>
				<td>1234556778834546</td>
				<td>13789765467</td>
				<td>X X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X X</td>
				<td>2017-07-12</td>
				<td><a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
			</tr>
			<tr class="text-c">
				<td  class="text-c"><input type="checkbox" value="1" name=""></td>
				<td>10</td>
				<td class="text-l">司令部</td>
				<td>X X X</td>
				<td>X X X</td>
				<td><a href="">X X X</a></td>
				<td>1234556778834546</td>
				<td>13789765467</td>
				<td>X X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X XX X X</td>
				<td>2017-07-12</td>
				<td><a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
			</tr>
			-->
			</tbody>
		</table>
		<div class="text-r mt-20 page">
			<?php echo ($page); ?>
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

/*问责-搜索*/
function wz_search(){
	var kwd = document.getElementById("kwd").value;
	var startdate = document.getElementById("logmin").value;
	var enddate = document.getElementById("logmax").value;

	var url = "/monitor/index.php/Admin/Gbjd/gbjd_search";
	$.ajax({
		type: "post",
		url: url,
		dataType: "json",
		data: {"kwd":kwd,"startdate":startdate,"enddate":enddate},
		success: function(data){
			$("#datalist").replaceWith("<div  id='datalist'>"
					+data.content+
					"</div>");
			click();
		}
	});
}

//搜索结果，页码点击
function click(){
	$('.page a').click(function(){
		var kwd = document.getElementById("kwd").value;
		var startdate = document.getElementById("logmin").value;
		var enddate = document.getElementById("logmax").value;

		var pageObj = this;
		var url = pageObj.href;
		$.ajax({
			dataType:'json',
			type:'post',
			url:url,
			data: {"kwd":kwd,"startdate":startdate,"enddate":enddate},
			success:function(res){
				$("#datalist").replaceWith("<div  id='datalist'>"
						+res.content+
						"</div>");
				click();
			}
		});
		return false;
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
		var url = "/monitor/index.php/Admin/Gbjd/gbjd_del";
		$.ajax({
			type: "post",
			url: url,
			dataType: "json",
			data: "id="+id,
			success: function(msg){
				if(msg){
					//$(obj).parents("li").remove();
					history.go(0);
					layer.msg('已删除!',{icon:1,time:1000});
				}
			}
		});
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
</body>
</html>