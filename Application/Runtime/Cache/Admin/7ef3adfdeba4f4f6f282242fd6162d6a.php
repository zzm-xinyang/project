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
<link href="/monitor/Public/admin/lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
<link href="/monitor/Public/admin/lib/Hui-iconfont/1.0.1/iconfont.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>作风评价结果</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 作风评价<a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
	<div class="cl pd-5 bg-1 bk-gray"> <span class="l"><a class="btn btn-primary radius" onclick="jtzr_add('添加监督内容','<?php echo U(nradd);?>')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i>添加监督内容</a></span> </div>
	<table class="table table-border table-bordered table-hover table-bg table-sort">
		<thead>
			<tr class="text-c">
				<th width="80">类别</th>
				<th>监督内容</th>
				<th width="60">操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($datalist)): $i = 0; $__LIST__ = $datalist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="text-c">
					<td class="text-l"><?php echo ($vo['name']); ?></td>
					<td class="text-l"><?php echo ($vo['content']); ?></td>
					<td><a title="修改" class="ml-5" onclick="jtzr_edit('修改评价内容','<?php echo U(nredit,array(kw=>$vo['id']));?>')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="member_del(this,'<?php echo ($vo[id]); ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> </td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
			<!--
			<tr class="text-c">
				<td rowspan="5">政治纪律</td>
				<td class="text-l">是否存在发表危害党的言论等行为</td>							
				<td><a title="修改" class="ml-5" onclick="jtzr_edit('修改评价内容','zfpj_edit.html')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> </td>
			</tr>
			<tr class="text-c">
				<td class="text-l">是否存在发表危害党的言论等行为</td>							
				<td><a title="修改" class="ml-5" onclick="jtzr_edit('修改评价内容','zfpj_edit.html')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> </td>
			</tr>
			<tr class="text-c">
				<td class="text-l">是否存在发表危害党的言论等行为</td>							
				<td><a title="修改" class="ml-5" onclick="jtzr_edit('修改评价内容','zfpj_edit.html')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> </td>
			</tr>
			<tr class="text-c">
				<td class="text-l">是否存在发表危害党的言论等行为</td>							
				<td><a title="修改" class="ml-5" onclick="jtzr_edit('修改评价内容','zfpj_edit.html')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> </td>
			</tr>
			<tr class="text-c">
				<td class="text-l">是否存在发表危害党的言论等行为</td>							
				<td><a title="修改" class="ml-5" onclick="jtzr_edit('修改评价内容','zfpj_edit.html')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> </td>
			</tr>
			<tr class="text-c">
				<td rowspan="7">组织纪律</td>
				<td class="text-l">是否存在违反民主集中制原则，拒不执行或擅自改变党组织做出的重大决定以及违反议事规则等行为</td>							
				<td><a title="修改" class="ml-5" onclick="jtzr_edit('修改评价内容','zfpj_edit.html')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> </td>
			</tr>
			<tr class="text-c">
				<td class="text-l">是否存在不向组织及时请示、如实报告重大问题、重要事项等行为</td>							
				<td><a title="修改" class="ml-5" onclick="jtzr_edit('修改评价内容','zfpj_edit.html')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> </td>
			</tr>
			<tr class="text-c">
				<td class="text-l">是否存在闹不团结、互相捣毁、工作中互相拆台等行为</td>							
				<td><a title="修改" class="ml-5" onclick="jtzr_edit('修改评价内容','zfpj_edit.html')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> </td>
			</tr>
			<tr class="text-c">
				<td class="text-l">是否在民主推荐测评、组织考察和党内选举中搞拉票助选等违反组织工作原则的行为</td>							
				<td><a title="修改" class="ml-5" onclick="jtzr_edit('修改评价内容','zfpj_edit.html')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> </td>
			</tr>
			<tr class="text-c">
				<td class="text-l">是否存在侵犯党员权力行为</td>							
				<td><a title="修改" class="ml-5" onclick="jtzr_edit('修改评价内容','zfpj_edit.html')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> </td>
			</tr>
			<tr class="text-c">
				<td class="text-l">是否存在拒不执行组织的分配、调动、交流决定等行为</td>							
				<td><a title="修改" class="ml-5" onclick="jtzr_edit('修改评价内容','zfpj_edit.html')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> </td>
			</tr>
			<tr class="text-c">
				<td class="text-l">是否违反有关规定组织、参加自发成立的老乡会、校友会、战友会等行为</td>							
				<td><a title="修改" class="ml-5" onclick="jtzr_edit('修改评价内容','zfpj_edit.html')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> </td>
			</tr>
			<tr class="text-c">
				<td rowspan="6">廉洁纪律</td>
				<td class="text-l">是否存在直系亲属涉足消防工程和消防产品经营等违规活动的行为 </td>							
				<td><a title="修改" class="ml-5" onclick="jtzr_edit('修改评价内容','zfpj_edit.html')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> </td>
			</tr>
			<tr class="text-c">
				<td class="text-l">是否存在利用职权在消防监督检查、工程审核验收、火灾事故调查、消防产品监督中谋取不正当利益等行为</td>							
				<td><a title="修改" class="ml-5" onclick="jtzr_edit('修改评价内容','zfpj_edit.html')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> </td>
			</tr>
			<tr class="text-c">
				<td class="text-l">是否存在违反财经制度，虚报冒领财政拨款或者补贴的行为</td>							
				<td><a title="修改" class="ml-5" onclick="jtzr_edit('修改评价内容','zfpj_edit.html')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> </td>
			</tr>
			<tr class="text-c">
				<td class="text-l">是否存在借婚丧喜庆事宜宴请管理服务对象借机敛财等行为</td>							
				<td><a title="修改" class="ml-5" onclick="jtzr_edit('修改评价内容','zfpj_edit.html')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> </td>
			</tr>
			<tr class="text-c">
				<td class="text-l">是否存在违规占有、使用公款公物等行为</td>							
				<td><a title="修改" class="ml-5" onclick="jtzr_edit('修改评价内容','zfpj_edit.html')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> </td>
			</tr>
			<tr class="text-c">
				<td class="text-l">是否存在违规收受礼品、礼金、消费卡，违规出入私人会所等行为</td>							
				<td><a title="修改" class="ml-5" onclick="jtzr_edit('修改评价内容','zfpj_edit.html')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> </td>
			</tr>
			<tr class="text-c">
				<td rowspan="5">群众纪律</td>
				<td class="text-l">是否存在制定脱离基层部队实际的指标任务，搞形象工程、政绩工程等投机和短期行为 </td>							
				<td><a title="修改" class="ml-5" onclick="jtzr_edit('修改评价内容','zfpj_edit.html')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> </td>
			</tr>
			<tr class="text-c">
				<td class="text-l">是否存在落实从优待警政策缩水走样的行为</td>							
				<td><a title="修改" class="ml-5" onclick="jtzr_edit('修改评价内容','zfpj_edit.html')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> </td>
			</tr>
			<tr class="text-c">
				<td class="text-l">是否存在对官兵和群众反应强烈的问题或合理诉求消极应付、推诿扯皮等行为</td>							
				<td><a title="修改" class="ml-5" onclick="jtzr_edit('修改评价内容','zfpj_edit.html')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> </td>
			</tr>
			<tr class="text-c">
				<td class="text-l">是否存在对待办事群众态度恶劣，简单粗暴、生冷硬推和吃拿卡要等行为</td>							
				<td><a title="修改" class="ml-5" onclick="jtzr_edit('修改评价内容','zfpj_edit.html')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> </td>
			</tr>
			<tr class="text-c">
				<td class="text-l">是否侵占官兵和群众利益</td>							
				<td><a title="修改" class="ml-5" onclick="jtzr_edit('修改评价内容','zfpj_edit.html')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> </td>
			</tr>
			<tr class="text-c">
				<td rowspan="4">工作纪律</td>
				<td class="text-l">是否存在做出违背党和国家方针政策以及决策部署等行为 </td>							
				<td><a title="修改" class="ml-5" onclick="jtzr_edit('修改评价内容','zfpj_edit.html')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> </td>
			</tr>
			<tr class="text-c">
				<td class="text-l">是否存在无故缺席支队重要会议、重大活动的行为</td>							
				<td><a title="修改" class="ml-5" onclick="jtzr_edit('修改评价内容','zfpj_edit.html')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> </td>
			</tr>
			<tr class="text-c">
				<td class="text-l">是否存在不遵守工作作息纪律，无故脱岗的行为</td>							
				<td><a title="修改" class="ml-5" onclick="jtzr_edit('修改评价内容','zfpj_edit.html')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> </td>
			</tr>
			<tr class="text-c">
				<td class="text-l">是否滥用职权和玩忽职守行为</td>							
				<td><a title="修改" class="ml-5" onclick="jtzr_edit('修改评价内容','zfpj_edit.html')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> </td>
			</tr>
			<tr class="text-c">
				<td rowspan="5">生活纪律</td>
				<td class="text-l">是否存在生活奢靡、贪图享乐、追求低级趣味等行为 </td>							
				<td><a title="修改" class="ml-5" onclick="jtzr_edit('修改评价内容','zfpj_edit.html')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> </td>
			</tr>
			<tr class="text-c">
				<td class="text-l">是否存在赌博或带有财物输赢的棋牌等活动的行为</td>							
				<td><a title="修改" class="ml-5" onclick="jtzr_edit('修改评价内容','zfpj_edit.html')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> </td>
			</tr>
			<tr class="text-c">
				<td class="text-l">是否存在发生酗酒滋事等不注意公众形象、不符合身份的行为</td>							
				<td><a title="修改" class="ml-5" onclick="jtzr_edit('修改评价内容','zfpj_edit.html')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> </td>
			</tr>
			<tr class="text-c">
				<td class="text-l">是否存在违反家庭伦理和社会公德等行为</td>							
				<td><a title="修改" class="ml-5" onclick="jtzr_edit('修改评价内容','zfpj_edit.html')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> </td>
			</tr>
			<tr class="text-c">
				<td class="text-l">是否存在与异性进行不正当交往或保持不正当关系的行为</td>							
				<td><a title="修改" class="ml-5" onclick="jtzr_edit('修改评价内容','zfpj_edit.html')" href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a>  <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a> </td>
			</tr>
			-->
		</tbody>
	</table>
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
            data: [1722,1225,1226,235]

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
</body>
</html>