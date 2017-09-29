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
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 党风廉政建设官兵评价 <span class="c-gray en">&gt;</span> 党风廉政建设官兵评价<a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20 pl-5">
		<!--士官选取权力运行情况-->
	<span class="l mt-5 mr-5"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont"></i> 批量删除</a></span>
	<span class="l  mt-5"><a class="btn btn-primary radius" onclick="jtzr_add('添加评价','<?php echo U('Pbuilds/pbuildsAdd','','');?>')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i>添加评价</a></span> 
	<div class="text-r"> 
		<div class="cl pd-5 bg-1 bk-gray"> 
			<form action="<?php echo U('Pbuilds/pbuildsSearch','','');?>" method="post" >
		    日期范围：
			<input type="text" onfocus="WdatePicker({maxDate:'#F<?php echo ($dp["$D('logmax')"]); ?>'})" id="logmin" name="minDate" class="input-text Wdate" style="width:120px;">
			-
			<input type="text" onfocus="WdatePicker({maxDate:'#F<?php echo ($dp["$D('logmax')"]); ?>'})" name="maxDate"  id="logmax" class="input-text Wdate" style="width:120px;">
			<input type="text" name="keyWords" id="" placeholder=" 关键词" style="width:250px" class="input-text">
			<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
			
			</form>
		</div>
	</div>
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="25">ID</th>
				<th width="300">内容</th>
				<th width="50">状态</th>
				<th width="70">添加时间</th>
				<th>评价结果</th>
				<th width="40">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($pbuildsLists)): $i = 0; $__LIST__ = $pbuildsLists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pbuilds): $mod = ($i % 2 );++$i;?><tr class="text-l">
							<td  class="text-c"><?php if($pbuilds['status']==2): ?><input type="checkbox" value="<?php echo ($pbuilds['id']); ?>" name="ids"><?php endif; ?></td>
							<td class="text-c"><?php echo ($i); ?></td>
							<td><?php echo (substr($pbuilds['content'],0,24)); ?>... </td>							
							<td width="50"><?php if($pbuilds['status']==1): ?>已发布
    							<?php else: ?> 未发布<?php endif; ?></td>
							<td><?php echo (date("Y-m-d H:i",$pbuilds['addtime'])); ?></td>
							<td><?php if($pbuilds['status']==1): ?>好（<?php echo ($resultList[$key]['1']); ?>）； 较好（<?php echo ($resultList[$key]['2']); ?>）；一般（<?php echo ($resultList[$key]['3']); ?>）； 差（<?php echo ($resultList[$key]['4']); ?>）<?php endif; ?>
							</td>
							<td><?php if($pbuilds['status']==2): ?><a title="修改" class="ml-5" onclick="jtzr_edit('编辑运行流程','<?php echo U('Pbuilds/pbuildsFind',array('id'=>$pbuilds['id']),'');?>')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a>  
							<a title="发布" class="ml-5" onclick="member_update(this,'<?php echo ($pbuilds['id']); ?>')" href="javascript:;"><i class="Hui-iconfont">&#xe603;</i></a>  
							<a title="删除" href="javascript:;" onclick="member_del(this,'<?php echo ($pbuilds['id']); ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a><?php endif; ?></td>
						</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
	<div class="text-r mt-20">
		<?php echo ($page); ?>
	</div>
	<!--统计图-->
	<div>
		<div style="margin-left:35px;">
			<select name="qlmc" onchange="changeyear(this);" style="height: 29px;border:1px #ddd solid;">
				<?php if(is_array($years)): $i = 0; $__LIST__ = $years;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$year): $mod = ($i % 2 );++$i;?><option value="<?php echo ($year); ?>"><?php echo ($year); ?>年</option><?php endforeach; endif; else: echo "" ;endif; ?>
			</select>
		</div>
		<div id="container" style="min-width:700px;height:400px"></div>	
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
var chart = $('#container').highcharts();
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	$.Huitab("#tab-system .tabBar span","#tab-system .tabCon","current","click","0");
});

/*柱形图*/
$(function () {
   $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: '党风廉政建设责任制评价'
        },
        xAxis: {
            categories: [
                '好',
                '较好',
                '一般',
                '差'
            ]
        },
        yAxis: {
            min: 0,
            allowDecimals:false,
            title: {
                text: '人数'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: '评价人数',
            data: [<?php echo ($resultList1); ?>,<?php echo ($resultList2); ?>,<?php echo ($resultList3); ?>,<?php echo ($resultList4); ?>]

        }]
    });
});	
/*评价-编辑*/
function jtzr_edit(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*发布*/
function member_update(obj,id){
		$.post('<?php echo U('Pbuilds/pbuildsUpdateStatus','','');?>',{'id':id},function(result){
    		if(result==true){    			
				layer.msg('已发布!',{icon:1,time:1000});
				location.reload();
    		}else{    			
				layer.msg(result,{icon:1,time:1000});
    		}
		});
}
/*删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.post('<?php echo U('Pbuilds/pbuildsDel','','');?>',{'id':id},function(result){
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
		$.post('<?php echo U('Pbuilds/pbuildsDelAll','','');?>',{'ids':ids},function(result){
    		if(result==true){    			
				layer.msg('已删除!',{icon:1,time:1000});
				location.reload();				
    		}else{    			
				layer.msg(result,{icon:1,time:1000});
    		}
		});
	});
}
function changeyear(obj){
	var year = obj.value;
	$.post('<?php echo U('Pbuilds/pbuildsTJ','','');?>',{'year':year},function(result){
     	$('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: '党风廉政建设责任制评价'
        },
        xAxis: {
            categories: [
                '好',
                '较好',
                '一般',
                '差'
            ]
        },
        yAxis: {
            min: 0,
            allowDecimals:false,
            title: {
                text: '人数'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: '评价人数',
            data: [parseInt(result[0]),parseInt(result[1]),parseInt(result[2]),parseInt(result[3])]

        }]
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