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
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 党风廉政建设官兵评价 <span class="c-gray en">&gt;</span> 差评记录<a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	<div class="cl pd-5 bg-1 bk-gray">  
		<span class="l mt-5 mr-5"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont"></i> 批量删除</a></span>
			<form action="<?php echo U('Bnegatives/bnegativesSearch','','');?>" method="post" >
	<div class="text-r"> 日期范围：
		<input type="text" onfocus="WdatePicker({maxDate:'#F<?php echo ($dp["$D('logmax')"]); ?>'})" id="logmin" name="minDate" class="input-text Wdate" style="width:120px;">
		-
		<input type="text" onfocus="WdatePicker({maxDate:'#F<?php echo ($dp["$D('logmax')"]); ?>'})" name="maxDate"  id="logmax" class="input-text Wdate" style="width:120px;">
		<input type="text" name="keyWords" id="" placeholder=" 关键词" style="width:250px" class="input-text">
		<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
	</div>
	</form>
	</div>
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name=""  id="check_all_box" value=""></th>
				<th width="25">ID</th>				
				<th width="50px">姓名</th>
				<th width="90px">身份证/警官证</th>
				<th width="50px">电话</th>
				<th>差评内容</th>
				<th>评价内容</th>
				<th width="90px" rowspan="2">评价时间</th>
				<th width="60px" rowspan="2">操作</th>
			</tr>
		</thead>
		<tbody>			
		<?php if(is_array($bnegativesLists)): $i = 0; $__LIST__ = $bnegativesLists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$bnegatives): $mod = ($i % 2 );++$i;?><tr class="text-c">
				<td><input type="checkbox" value="<?php echo ($bnegatives['id']); ?>" name="ids"></td>
				<td><?php echo ($i); ?></td>
				<td class="text-l"><?php echo ($bnegatives['name']); ?></td>
				<td><?php echo ($bnegatives['number']); ?></td>
				<td><?php echo ($bnegatives['phone']); ?></td>
				<td><?php echo ($bnegatives['content']); ?></td>
				<td><?php echo ($bnegatives['pcontent']); ?></td>
				<td><?php echo (date("Y-m-d H:i",$bnegatives['evaluatetime'])); ?></td>
				<td><a title="删除" href="javascript:;" onclick="member_del(this,'<?php echo ($bnegatives['id']); ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>			
		</tbody>
	</table>
	<div class="text-r mt-20">
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


<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	$.Huitab("#tab-system .tabBar span","#tab-system .tabCon","current","click","0");
});


///*集体责任-编辑*/
//function jtzr_edit(title,url){
//	var index = layer.open({
//		type: 2,
//		title: title,
//		content: url
//	});
//	layer.full(index);
//}
/*用户-删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.post('<?php echo U('Bnegatives/bnegativesDel','','');?>',{'id':id},function(result){
    		if(result==true){    			
				$(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000});
    		}else{    			
				layer.msg(result,{icon:1,time:1000});
    		}
		});
	});
}
/*批量删除*/
function datadel(){
	layer.confirm('确认要删除所有选中的吗？',function(index){
		var obj=document.getElementsByName('ids');
		var check_boxes = document.getElementsByName("ids");  
        var ids = new Array();  
        for(var i=0;i<check_boxes.length;i++){  
        	if(check_boxes[i].checked){
            ids.push(check_boxes[i].value);  
           }
        }
		$.post('<?php echo U('Bnegatives/bnegativesDelAll','','');?>',{'ids':ids},function(result){
    		if(result==true){    			
				layer.msg('已删除!',{icon:1,time:1000});
				location.reload();				
    		}else{    			
				layer.msg(result,{icon:1,time:1000});
    		}
		});
	});
}
///*集体责任清单-添加*/
//function jtzr_add(title,url){
//	var index = layer.open({
//		type: 2,
//		title: title,
//		content: url
//	});
//	layer.full(index);
//}
</script>
</body>
</html>