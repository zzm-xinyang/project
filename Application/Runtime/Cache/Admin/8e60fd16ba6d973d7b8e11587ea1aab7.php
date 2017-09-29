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
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 党风廉政建设官兵评价<span class="c-gray en">&gt;</span> 意见和建议<a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	<div class="cl pd-5 bg-1 bk-gray"> 
	<span class="l mt-5 mr-5"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont"></i> 批量删除</a></span>
	<div class="text-r"> 
		<form action="<?php echo U('Psuggests/psuggestsSearch','','');?>" method="post" >
	   <div class="text-r"> 日期范围：
		<input type="text" onfocus="WdatePicker({maxDate:'#F<?php echo ($dp["$D('logmax')"]); ?>'})" id="logmin" name="minDate" class="input-text Wdate" style="width:120px;">
		-
		<input type="text" onfocus="WdatePicker({maxDate:'#F<?php echo ($dp["$D('logmax')"]); ?>'})" name="maxDate"  id="logmax" class="input-text Wdate" style="width:120px;">
		<input type="text" name="keyWords" id="" placeholder=" 关键词" style="width:250px" class="input-text">
		<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
	</div>
	</form>
	</div>
	</div>
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="25">ID</th>
				<th>内容</th>
				<th width="100">添加时间</th>
				<th width="40">操作</th>
			</tr>
		</thead>
		<tbody>
		<?php if(is_array($psuggestsLists)): $i = 0; $__LIST__ = $psuggestsLists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$psuggests): $mod = ($i % 2 );++$i;?><tr class="text-l">
				<td  class="text-c"><input type="checkbox" value="<?php echo ($psuggests['id']); ?>" name="ids"></td>
				<td class="text-c"><?php echo ($i); ?></td>
				<td><?php echo ($psuggests['content']); ?></td>							
				<td><?php echo (date("Y-m-d H:i",$psuggests['addtime'])); ?></td>
				<td><a title="删除" href="javascript:;" onclick="member_del(this,'<?php echo ($psuggests['id']); ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> </td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>						
		</tbody>
	</table>
	<div class="text-r mt-20">
		<!--<a class="radius bk-gray pd-10">上一页</a>
		<a class="radius bk-gray pd-10" style="background:#0044CC;color:#fff;">1</a>
		<a class="radius bk-gray pd-10">2</a>
		<a class="radius bk-gray pd-1">下一页</a>-->
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
//$(function(){
//	$('.skin-minimal input').iCheck({
//		checkboxClass: 'icheckbox-blue',
//		radioClass: 'iradio-blue',
//		increaseArea: '20%'
//	});
//	$.Huitab("#tab-system .tabBar span","#tab-system .tabCon","current","click","0");
//});

///*柱形图*/
//$(function () {
//  $('#container').highcharts({
//      chart: {
//          type: 'column'
//      },
//      title: {
//          text: '党风廉政建设责任制评价'
//      },
//      xAxis: {
//          categories: [
//              '好',
//              '较好',
//              '一般',
//              '差'
//          ]
//      },
//      yAxis: {
//          min: 0,
//          allowDecimals:false,
//          title: {
//              text: '人数'
//          }
//      },
//      tooltip: {
//          headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
//          pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
//              '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
//          footerFormat: '</table>',
//          shared: true,
//          useHTML: true
//      },
//      plotOptions: {
//          column: {
//              pointPadding: 0.2,
//              borderWidth: 0
//          }
//      },
//      series: [{
//          name: '评价人数',
//          data: [1722,1225,1226,235]
//
//      }]
//  });
//});	
/*集体责任-编辑*/
//function jtzr_edit(title,url){
//	var index = layer.open({
//		type: 2,
//		title: title,
//		content: url
//	});
//	layer.full(index);
//}
/*删除*/
function member_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.post('<?php echo U('Psuggests/psuggestsDel','','');?>',{'id':id},function(result){
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
		$.post('<?php echo U('Psuggests/psuggestsDelAll','','');?>',{'ids':ids},function(result){
    		if(result==true){    			
				layer.msg('已删除!',{icon:1,time:1000});
				location.reload();				
    		}else{    			
				layer.msg(result,{icon:1,time:1000});
    		}
		});
	});
}
</script>
</body>
</html>