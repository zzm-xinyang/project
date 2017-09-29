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
<script type="text/javascript" src="lib/html5.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<script type="text/javascript" src="lib/PIE_IE678.js"></script>
<![endif]-->
<link href="/monitor/Public/admin/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="/monitor/Public/admin/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
<link href="/monitor/Public/admin/css/style.css" rel="stylesheet" type="text/css" />
<link href="/monitor/Public/admin/lib/Hui-iconfont/1.0.1/iconfont.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>线索来源统计</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 执纪问责<span class="c-gray en">&gt;</span> 线索来源统计 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-5">
	<div class="mt-20">
		<div style="margin-left:35px;">
			<select name="qlmc" style="height: 29px;border:1px #ddd solid;"  onchange="show(this.value)">
				<?php if($nd == 2017): ?><option value="2017" selected="selected">2017年</option>
				<?php else: ?>
					<option value="2017">2017年</option><?php endif; ?>	
				<?php if($nd == 2018): ?><option value="2018" selected="selected">2018年</option>
				<?php else: ?>
					<option value="2018">2018年</option><?php endif; ?>	
				<?php if($nd == 2019): ?><option value="2019" selected="selected">2019年</option>
				<?php else: ?>
					<option value="2019">2019年</option><?php endif; ?>	
				<?php if($nd == 2020): ?><option value="2020" selected="selected">2020年</option>
				<?php else: ?>
					<option value="2020">2020年</option><?php endif; ?>	
				<?php if($nd == 2021): ?><option value="2021" selected="selected">2021年</option>
				<?php else: ?>
					<option value="2021">2021年</option><?php endif; ?>	
				<?php if($nd == 2022): ?><option value="2022" selected="selected">2022年</option>
				<?php else: ?>
					<option value="2022">2022年</option><?php endif; ?>	
				<?php if($nd == 2023): ?><option value="2023" selected="selected">2023年</option>
				<?php else: ?>
					<option value="2023">2023年</option><?php endif; ?>	
				<?php if($nd == 2024): ?><option value="2024" selected="selected">2024年</option>
				<?php else: ?>
					<option value="2024">2024年</option><?php endif; ?>	
				<?php if($nd == 2025): ?><option value="2025" selected="selected">2025年</option>
				<?php else: ?>
					<option value="2025">2025年</option><?php endif; ?>	
				<?php if($nd == 2026): ?><option value="2026" selected="selected">2026年</option>
				<?php else: ?>
					<option value="2026">2026年</option><?php endif; ?>	
				<?php if($nd == 2027): ?><option value="2027" selected="selected">2027年</option>
				<?php else: ?>
					<option value="2027">2027年</option><?php endif; ?>					
			</select>
		</div>
		<div id="container" style="min-width:700px;height:400px"></div>	
	</div>
</div>
<script type="text/javascript" src="/monitor/Public/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/monitor/Public/admin/lib/layer/1.9.3/layer.js"></script> 
<script type="text/javascript" src="/monitor/Public/admin/js/H-ui.js"></script> 
<script type="text/javascript" src="/monitor/Public/admin/js/H-ui.admin.js"></script> 

<!--柱状图-->
<script type="text/javascript" src="/monitor/Public/admin/lib/Highcharts/4.1.7/js/highcharts.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/lib/Highcharts/4.1.7/js/modules/exporting.js"></script>
<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: <?php echo ($nd); ?>+'年线索来源统计图'
        },
        xAxis: {
            categories: eval('<?php echo json_encode($typesName);?>')
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
                '<td style="padding:0"><b>{point.y}</b></td></tr>',
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
		exporting: {
			enabled:false
		},
		credits: {
			enabled:false
		},
        series: [{
            name: '数量',
            data: charstoint(eval('<?php echo json_encode($szxtnum);?>'))

        }]
    });
});	

function charstoint(chars){
	var intArr = new Array();
	for(var i=0; i<chars.length; i++){
		intArr[i] = parseInt(chars[i]);
	}
	return intArr;
}

function show(index){
	var url = "/monitor/index.php/Admin/Sjlxtj/index";
	$.ajax({
		dataType:'json',
		type:'post',
		url:url,
		data: "nd="+index,
		success:function(msg){
			$('#container').highcharts({
				chart: {
					type: 'column'
				},
				title: {
					text: index+'年四种形态统计图'
				},
				xAxis: {
					categories: msg.typesName
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
					'<td style="padding:0"><b>{point.y}</b></td></tr>',
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
				exporting: {
					enabled:false
				},
				credits: {
					enabled:false
				},
				series: [{
					name: '数量',
					data: charstoint(msg.sjlxNum)
				}]
			});
		}
	});
}

</script>
</body>
</html>
</body>
</html>