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
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 主体责任 <span class="c-gray en">&gt;</span> 党委领导班子集体责任 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">
    <div class="pd-15 radius lh-22 mb-5" style="background: #eee;">
        <h4><strong>党委领导班子集体责任清单</strong>&nbsp;<a class="btn btn-primary radius pl-10 pr-10 add" onclick=jtzr_add('添加集体责任','<?php echo U("Plist/plists","oid=$oid","");?>') href="javascript:;" >+</a></h4>
        <ul class="list lh-24" type="1" id="list">
            <?php if(is_array($plists)): $k = 0; $__LIST__ = $plists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$plist): $mod = ($k % 2 );++$k;?><li><a href="<?php echo U('Plist/listFind',array('id'=>$plist['id']),'');?>"><?php echo ($plist['item']); ?></a>&nbsp;
                    <a title="修改" class="ml-5" onclick=jtzr_edit("修改","<?php echo U('Plist/listEdit',array('id'=>$plist['id']),'');?>") href="javascript:;"><img src="/monitor/Public/admin/images/pen.png" width="12"/></a>&nbsp;
                    <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none" id="<?php echo U('Plist/listDelete',array('id'=>$plist['id']),'');?>"><img src="/monitor/Public/admin/images/delete.png" width="12"/></a>
                </li>

                <?php if($k == 1): ?><input type="hidden" id="first" value="<?php echo ($plist['content']); ?>" /><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <div class="content l-24 pd-20" id="choiseContent">

        </div>
    </div>

    <!--主体责任分解情况-->
    <div class="pd-15 radius lh-22" style="background: #eee;">
        <h4><strong>主体责任分解清单落实情况</strong>&nbsp;<a class="btn btn-primary radius pl-10 pr-10 add" onclick=jtzr_add('添加事项','<?php echo U("Plist/pitems","oid=$oid","");?>') href="javascript:;" >+</a></h4>
    </div>
    <div class="cl pd-5 bg-1 bk-gray">
        <span class="l"><a href="<?php echo U('Plist/delsome','','');?>"  class="btn btn-danger radius" id="dels"><i class="Hui-iconfont"></i> 批量删除</a></span>
        <form action="<?php echo U('Plist/listsearch');?>" method="post" class="form form-horizontal" id="form-article-add">
        <div class="text-r" style="float:right;">
            <label>责任主体：</label>
            <select name="subject" style="height: 29px;border:1px #ddd solid;">
                <option value="全部">全部</option>
                <option value="党委班子">党委班子</option>
                <option value="党委书记">党委书记</option>
                <option value="党委副书记">党委副书记</option>
                <option value="政治处主任">政治处主任</option>
            </select>
            <label>状态：</label>
            <select name="status" style="height: 29px;border:1px #ddd solid;">
                <option value="0">全部</option>
                <option value="1">待完成</option>
                <option value="2">已完成</option>
                <option value="3">未完成</option>
            </select>
            <input type="text" name="oid" id="oid" class="input-text Wdate" style="width:120px;display:none;" value="<?php echo ($oid); ?>">
            日期范围：
            <input type="text" name="logmin" id="logmin" class="input-text Wdate" style="width:120px;">
            -
            <input type="text" name="logmax" id="logmax" class="input-text Wdate" style="width:120px;">
            -

            <input type="text" name="keyword" id="11" placeholder=" 关键词" style="width:180px" class="input-text">
            <button name="submit" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜事项</button>
        </div>
        </form>
    </div>
    <form method="post" action="<?php echo U('Plist/delsome','','');?>" id="xwdt_del">
    <table class="table table-border table-bordered table-hover table-bg table-sort">
        <thead>
        <tr class="text-c">
            <th width="35"><input type="checkbox" name="" value=""></th>
            <th width="35">序号</th>
            <th width="">落实事项</th>
            <th width="80">责任主体</th>
            <th width="90">开始时间</th>
            <th width="90">完成时限</th>
            <th width="90">履责情况</th>
            <th width="70">完成情况</th>
            <th width="50">预警提示</th>
            <th width="80">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($itemLists)): $i = 0; $__LIST__ = $itemLists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><tr class="text-c">
                <td><input type="checkbox" value="<?php echo ($item["id"]); ?>" name="newsdels[]" class="checkdels"></td>
                <td><?php echo ($i); ?></td>
                <td class="text-l"><?php echo ($item['item']); ?></td>
                <td><?php echo ($item['subject']); ?></td>
                <td><?php echo ($item['starttime']); ?></td>
                <td><?php echo ($item['timelimit']); ?></td>
                <td><a  onclick=jtzr_add('上传文件','<?php echo U("Plist/itemUpload",array("pid"=>$item["id"]),"");?>') href="javascript:;" class="upload">上传文件</a></td>
                <td><?php echo ($item['status']); ?></td>
                <td class="va-m"><img src="/monitor/Public/admin/images/<?php echo ($item['tip']); ?>" /></td>
                <td><a href="" title="显示到前台">&nbsp;&nbsp;<a title="修改" class="ml-5" onclick=jtzr_edit('编辑落实事项','<?php echo U("Plist/itemEdit",array("id" => $item["id"]),"");?>') href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i></a>&nbsp;&nbsp;<a title="删除" href="javascript:;" onclick="item_del(this,'1')" class="ml-5" style="text-decoration:none" id="<?php echo U('Plist/itemDelete',array('id'=>$item['id'],'oid'=>$plist['oid']),'');?>"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>

        </tbody>
    </table>
        <input type="submit" name="submit" style="display: none;" id="submit">

    </form>
    <div class="text-r mt-20 page">
        <?php echo ($page); ?>
    </div>
    <!--2017年党委主体责任落实统计-->
    <!--2017年党委主体责任落实统计-->
    <div class="pd-15 radius lh-22 mt-20" style="background: #eee;">
        <h4 id="pieTitle"><strong><?php echo ($curYear); ?>年<span class="who"></span>党委主体责任落实统计</strong>
            <input type="hidden" id="status1" value="<?php echo ($nums['s1']); ?>" />
            <input type="hidden" id="status2" value="<?php echo ($nums['s2']); ?>" />
            <input type="hidden" id="status3" value="<?php echo ($nums['s3']); ?>" />
            <input type="hidden" id="countUrl" value="<?php echo U('Plist/count',array('oid'=>$oid)),'','';?>" />
            <select id="finish" name="year" style="height: 29px;border:1px #ddd solid;">
                <?php if(is_array($years)): $i = 0; $__LIST__ = $years;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$y): $mod = ($i % 2 );++$i;?><option value="<?php echo ($y); ?>"><?php echo ($y); ?>年</option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select></h4>
        <div id="container" style="min-width:700px;height:400px"></div>
    </div>
</div>
<script type="text/javascript" src="/monitor/Public/admin/lib/jquery/1.9.1/jquery.min.js"></script>

<script type="text/javascript" src="/monitor/Public/admin/lib/Validform/5.3.2/Validform.min.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/lib/layer/1.9.3/layer.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/lib/icheck/jquery.icheck.min.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/js/H-ui.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/js/H-ui.admin.js"></script>
<!--饼形图-->
<script type="text/javascript" src="/monitor/Public/admin/lib/Highcharts/4.1.7/js/highcharts.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/lib/Highcharts/4.1.7/js/modules/exporting.js"></script>

<!--控制开始日期和结束日期-->
<script type="text/javascript" src="/monitor/Public/admin/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/js/date.js"></script>

<script type="text/javascript">
    /**
     * 选中哪个，哪个有颜色标识，并更改相应的内容
     */
    parent.layer.closeAll();
    $(function () {
        $("#list li a:eq(0)").addClass('cur');
        $("#choiseContent").html($("#first").val());

        $("#list li a").click(function(){
            var self = $(this);
            $("#list li a").removeClass('cur');
            self.addClass('cur');
            $.get(self.attr('href'),function (data) {
                $("#choiseContent").html(data);
            });

            return false;
        });
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
    });

    $(function(){
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });
        $.Huitab("#tab-system .tabBar span","#tab-system .tabCon","current","click","0");
    });

    /**
     * 上传文件处理
     */
    $(function () {
        $("a.upload").click(function(){

        });
    });

    /*饼形图*/
    $(function () {
        //根据现有数据创建饼形图
        createPie($('#container'),$("#pieTitle").text(),$("#status1").val()-0,$("#status2").val()-0,$("#status3").val()-0);

        //改变年份时，重新请求数据
        $("#finish").change(function(){
            var url = $("#countUrl").val();
            var whichYear = $(this).val();
            $.get(url,{
                year:whichYear
            },function(data){
                var status = eval('(' + data + ')');
                status1 = status.s1 ? status.s1:0;
                status2 = status.s2 ? status.s2:0;
                status3 = status.s3 ? status.s3:0;

                //根据现有数据创建饼形图
                createPie($('#container'),$("#pieTitle").text(),status1-0,status2-0,status3-0);
            })
        })
    });
    function createPie(ob,title,status1,status2,status3){
        ob.highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: title
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
                name: title,
                data: [
                    {
                        name: '待完成',
                        y: status1,
                        color:'#EE7621',
                        sliced: true,
                        selected: true
                    },
                    {
                        name: '已完成',
                        y: status2,
                        color:'#698B22',
                        sliced: true,
                        selected: true
                    },
                    {
                        name: '未完成',
                        y: status3,
                        color:'#ff0000',
                        sliced: true,
                        selected: true
                    }
                ]
            }]
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
    /*集体责任清单-删除*/
    function member_del(obj,id){
        var url = $(obj).attr('id');
        layer.confirm('确认要删除吗？',function(index){
            $.get(url,function(data){
                if(data==1){
                    $(obj).parents("li").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                }

            })

        });
    }
    /*事项-删除*/
    function item_del(obj,id){
        var url = $(obj).attr('id');
        layer.confirm('确认要删除吗？',function(index){
            $.get(url,function(data){
                if(data==1){
                    //location.reload();
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                }

            })

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
     * 关闭弹出层
     */
    function layer_close(){
        layer.close(layer.index);
    }
</script>
</body>
</html>