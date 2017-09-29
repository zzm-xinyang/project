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
    <![endif]-->
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
<link href="/monitor/Public/admin/lib/Hui-iconfont/1.0.1/iconfont.css" rel="stylesheet" type="text/css" />
	<link href="/monitor/Public/admin/css/page.css" rel="stylesheet" type="text/css" />
	<link href="/monitor/Public/admin/css/new.css"  rel="stylesheet" type="text/css"  />
<!--[if IE 6]>
<script type="text/javascript" src="/monitor/Public/admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>第一种形态</title>
<script type="text/javascript">
	//时间戳转日期格式
	function convertdate(timeStamp){
		var date = new Date();
			date.setTime(timeStamp * 1000);
			var y = date.getFullYear();
			var m = date.getMonth() + 1;
			m = m < 10 ? ('0' + m) : m;
			var d = date.getDate();
			d = d < 10 ? ('0' + d) : d;

			return y + '-' + m + '-' + d;
	}
	/*问责-搜索*/
	function wz_search(){
		var ssfs = document.getElementById("ssfsname").value;
		var sjlx = document.getElementById("sjlx").value;
		var xsly = document.getElementById("xsly").value;
		var startdate = document.getElementById("logmin").value;
		var enddate = document.getElementById("logmax").value;

		var url = "/monitor/index.php/Admin/Zjwz/zjwzxt1_search";
		$.ajax({
			type: "post",
			url: url,
			dataType: "json",
			data: {"ssfs":ssfs,"sjlx":sjlx,"xsly":xsly,"startdate":startdate,"enddate":enddate},
			success: function(data){
                $("#datalist").replaceWith("<div  id='datalist'>"
                        +data.content+
                        "</div>");
                click();
			}
		});
	}
</script>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 执纪问责 <span class="c-gray en">&gt;</span> 第一种形态管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-15">
	<div class="pd-15 radius lh-22 mb-5" style="background: #eee;">
		<h4><strong>第一种形态</strong>&nbsp;<a class="btn btn-primary radius pl-10 pr-10 add" onclick="jtzr_add('添加实施方式','<?php echo U(zjwzxt1_add_1);?>')" href="javascript:;" >+</a></h4>
		<ul class="list lh-24">
			<?php if(is_array($fmodes)): $i = 0; $__LIST__ = $fmodes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($key == 0): ?><li>
						<a href="#" class="cur" ><?php echo ($vo['mode']); ?></a>&nbsp;&nbsp;
							<a title="修改" class="ml-5" onclick="jtzr_edit('修改','<?php echo U(zjwzxt1_edit_1,array(kw=>$vo[mode]));?>')" href="javascript:;"><img src="/monitor/Public/admin/images/pen.png" width="12"/></a>
							<a>&nbsp;
								<a title="删除" href="javascript:;" onclick="member_del(this,'<?php echo ($vo[id]); ?>')" class="ml-5" style="text-decoration:none"><img src="/monitor/Public/admin/images/delete.png" width="12"/>
							</a>
					</li>
				<?php else: ?>
					<li>
						<a href="#"><?php echo ($vo['mode']); ?></a>&nbsp;&nbsp;<a title="修改" class="ml-5" onclick="jtzr_edit('修改','<?php echo U(zjwzxt1_edit_1,array(kw=>$vo[mode]));?>')" href="javascript:;"><img src="/monitor/Public/admin/images/pen.png" width="12"/><a>&nbsp;<a title="删除" href="javascript:;" onclick="member_del(this,'<?php echo ($vo[id]); ?>')" class="ml-5" style="text-decoration:none"><img src="/monitor/Public/admin/images/delete.png" width="12"/></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
		</ul>		
	</div>
	<div class="cl pd-5 bg-1 bk-gray"> 
		<span class="l mr-5"><a href="javascript:;" onclick="return datadel();" class="btn btn-danger radius "><i class="Hui-iconfont"></i> 批量删除</a></span>
		<span class="l"><a class="btn btn-primary radius" onclick="wz_edit('添加问责')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i>添加问责</a></span>
		<div class="text-r" style="float:right;"> 
	 
		<input type="hidden" id="ssfsname" name="ssfsname" value="谈话提醒">
		<label>涉及类型：</label>
			<select id="sjlx" name="sjlx" style="height: 29px;border:1px #ddd solid;">
				<option value="0">全部</option>
				<?php if(is_array($ftypes)): $i = 0; $__LIST__ = $ftypes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>	
			</select>
		<label>问题线索来源：</label>
			<select id="xsly" name="xsly" style="height: 29px;border:1px #ddd solid;">
				<option value="0">全部</option>
				<?php if(is_array($fsources)): $i = 0; $__LIST__ = $fsources;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>	
			</select>
		日期范围：
			<input type="text" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M\'}'})" id="logmin" class="input-text Wdate" style="width:120px;">
			-
			<input type="text" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M'})" id="logmax" class="input-text Wdate" style="width:120px;">
			<button class="btn btn-success" type="submit" onclick="wz_search()"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
		</div>
	</div>
	<div id="datalist">
		<!--谈话提醒-->
		<table class="table table-border table-bordered table-hover table-bg table-sort">
			<thead>
				<tr class="text-c">
					<th width="25" rowspan="2"><input type="checkbox" class="all" name="" value=""></th>
					<th width="25" rowspan="2">ID</th>
					<th colspan="2">谈话人</th>
					<th colspan="3">谈话对象</th>
					<th rowspan="2" width="70px">谈话时间</th>
					<th rowspan="2">谈话内容摘要</th>
					<th rowspan="2" width="80px">涉及类型</th>
					<th rowspan="2" width="80px">问题线索来源</th>
					<th width="30" rowspan="2">操作</th>
				<tr class="text-c">
					<th width="40px">姓名</th>
					<th width="50px">职务</th>
					<th width="40px">姓名</th>
					<th width="50px">单位</th>
					<th width="40px">职务</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($thtxData)): $i = 0; $__LIST__ = $thtxData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
						<td class="text-c"><input type="checkbox" value="<?php echo ($vo["id"]); ?>" name="id[]"></td>
						<td class="text-c"><?php echo ($vo['id']); ?></td>
						<td><?php echo ($vo['name1']); ?></td>
						<td><?php echo ($vo['duty1']); ?></td>
						<td><?php echo ($vo['name2']); ?></td>
						<td><?php echo ($vo['unit2']); ?></td>
						<td><?php echo ($vo['duty2']); ?></td>
						<td><?php echo (date('Y-m-d',$vo['solvetime'])); ?></td>
						<td><?php echo ($vo['summary']); ?></td>
						<td><?php echo ($vo['tname']); ?></td>
						<td><?php echo ($vo['sname']); ?></td>
						<td><a title="修改" class="ml-5" onclick="jtzr_edit('修改执纪问责','<?php echo U(zjwzxt1_edit_wz,array(rid=>$vo[id]));?>')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a></a> <a title="删除" href="javascript:;" onclick="wz_del(this,'<?php echo ($vo[id]); ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>			
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

//搜索结果，页码点击
 function click(){
    $('.page a').click(function(){
        var ssfs = document.getElementById("ssfsname").value;
        var sjlx = document.getElementById("sjlx").value;
        var xsly = document.getElementById("xsly").value;
        var startdate = document.getElementById("logmin").value;
        var enddate = document.getElementById("logmax").value;

        var pageObj = this;
        var url = pageObj.href;
        $.ajax({
            dataType:'json',
            type:'post',
            url:url,
            data: {"ssfs":ssfs,"sjlx":sjlx,"xsly":xsly,"startdate":startdate,"enddate":enddate},
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

//全选，目前未生效
$(function(){
	$('.all').click(function (){
		if ($(this).is(':checked')){
			$(':checkbox').attr('checked', 'checked');
		}else{
			$(':checkbox').removeAttr('checked');
		}
	});
});

/*问责-添加*/
function wz_edit(title){
	var ssfs = document.getElementById("ssfsname").value;	
	var realurl = "<?php echo U('zjwzxt1_add_wz');?>?fs="+ssfs;
	
	var index = layer.open({
		type: 2,
		title: title,
		content: realurl
	});
	layer.full(index);
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
		var url = "/monitor/index.php/Admin/Zjwz/zjwzxt1_del_1";
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
/*问责-删除*/
function wz_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		var url = "/monitor/index.php/Admin/Zjwz/zjwzxt1_del_wz";
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
/*批量删除问责*/
function datadel(){
	var check = document.getElementsByName('id[]');
	var rid = new Array();
	//将所有选中复选框的默认值写入到数组中
	for (var i = 0; i < check.length; i++) {
		if (check[i].checked)
			rid.push(check[i].value);
	}
	if(rid.length<1){
		alert("没有选中任何记录！");
		return false;
	}
	layer.confirm('确认要删除吗？',function(index){
		var url = "/monitor/index.php/Admin/Zjwz/zjwzxt1_del_wz";
		$.ajax({
			type: "post",
			url: url,
			dataType: "json",
			data: "id="+rid,
			success: function(msg){
				if(msg){
					//$(obj).parents("li").remove();
					alert(msg);
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

/**
 * 不同实施方式被单击时的页面变化
 */
$(function(){
	$(".list a").click(function(){

		document.getElementById("ssfsname").value = $(this).text();//将当前选中的标签名称传给隐藏域，为后边的添加问责提供便利
		document.getElementById("sjlx").options[0].selected = true; //默认选中全部
		document.getElementById("xsly").options[0].selected = true; //默认选中全部
		document.getElementById("logmin").value = null;
		document.getElementById("logmax").value = null;
		$(".list a").removeClass("cur");
		$(this).addClass("cur");
//		var which = $(this).parent().index();
//		$("table").addClass("hide");
//		$("table:eq("+which+")").removeClass("hide");
		wz_search();
	});
});
</script>
</body>
</html>
</body>
</html>