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
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 权力监控 <span class="c-gray en">&gt;</span> 权力运行流程<a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>

    <div id="tab-system" class="HuiTab">
        <div class="tabBar cl">
            <?php if(is_array($departments)): $i = 0; $__LIST__ = $departments;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$department): $mod = ($i % 2 );++$i;?><span name="<?php echo ($department['id']); ?>"><?php echo ($department['name']); ?></span><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <div class="tabCon">
            <div class="pd-15 radius lh-22 mb-5" style="background: #eee;">
                <h4><strong>岗位权力流程清单</strong>&nbsp;<a class="btn btn-primary radius pl-10 pr-10 add" onclick=ql_add('添加运行流程','<?php echo U("Pflow/add",array("oid"=>$oid,"mid"=>$mid),"");?>') href="javascript:;" >+</a></h4>
                <ul class="list lh-24">
                    <?php if(is_array($contents[0])): $k = 0; $__LIST__ = $contents[0];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($k % 2 );++$k;?><li>
                            <?php if($k == 1): ?><a href="<?php echo U('Pflow/find',array('id'=>$m['id']),'');?>"  class="cur"><?php echo ($m['power']); ?><input type="hidden" value="<?php echo ($m['id']); ?>"/></a>&nbsp;&nbsp;
                                <?php else: ?>
                                <a href="<?php echo U('Pflow/find',array('id'=>$m['id']),'');?>"><?php echo ($m['power']); ?><input type="hidden" value="<?php echo ($m['id']); ?>"/></a>&nbsp;&nbsp;<?php endif; ?>

                            <a title="修改" class="ml-5" onclick=ql_edit("修改","<?php echo U('Pflow/edit',array('id'=>$m['id']),'');?>") href="javascript:;"><img src="/monitor/Public/admin/images/pen.png" width="12"/><a>&nbsp;
                                <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none" id="<?php echo U('Pflow/delete',array('id'=>$m['id']),'');?>"><img src="/monitor/Public/admin/images/delete.png" width="12"/></a>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
            <div class="pd-15 radius lh-22 mb-5 content" style="background: #eee;">
                <h4><span class="who"></span>流程</strong></h4>
                <div class="text-c content">
                    <input id="server" value="/monitor/uploads/" type="hidden" />
                    <img src="/monitor/uploads/<?php echo ($contents[0][0]['flow']); ?>"  />
                </div>
            </div>
        </div>
        <div class="tabCon">
            <div class="pd-15 radius lh-22 mb-5" style="background: #eee;">
                <h4><strong>岗位权力流程清单</strong>&nbsp;<a class="btn btn-primary radius pl-10 pr-10 add" onclick=ql_add('添加运行流程','<?php echo U("Pflow/add",array("oid"=>$oid,"mid"=>$mid),"");?>') href="javascript:;" >+</a></h4>
                <ul class="list lh-24">
                    <?php if(is_array($contents[1])): $k = 0; $__LIST__ = $contents[1];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($k % 2 );++$k;?><li>
                            <?php if($k == 1): ?><a href="<?php echo U('Pflow/find',array('id'=>$m['id']),'');?>"  class="cur"><?php echo ($m['power']); ?><input type="hidden" value="<?php echo ($m['id']); ?>"/></a>&nbsp;&nbsp;
                                <?php else: ?>
                                <a href="<?php echo U('Pflow/find',array('id'=>$m['id']),'');?>"><?php echo ($m['power']); ?><input type="hidden" value="<?php echo ($m['id']); ?>"/></a>&nbsp;&nbsp;<?php endif; ?>

                            <a title="修改" class="ml-5" onclick=ql_edit("修改","<?php echo U('Pflow/edit',array('id'=>$m['id']),'');?>") href="javascript:;"><img src="/monitor/Public/admin/images/pen.png" width="12"/><a>&nbsp;
                                <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none" id="<?php echo U('Pflow/delete',array('id'=>$m['id']),'');?>"><img src="/monitor/Public/admin/images/delete.png" width="12"/></a>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
            <div class="pd-15 radius lh-22 mb-5 content" style="background: #eee;">
                <h4><span class="who"></span>流程</strong></h4>
                <div class="text-c content">
                    <input id="server" value="/monitor/uploads/" type="hidden" />
                    <img src="/monitor/uploads/<?php echo ($contents[1][0]['flow']); ?>"  />
                </div>
            </div>
        </div>
        <div class="tabCon">
            <div class="pd-15 radius lh-22 mb-5" style="background: #eee;">
                <h4><strong>岗位权力流程清单</strong>&nbsp;<a class="btn btn-primary radius pl-10 pr-10 add" onclick=ql_add('添加权力','<?php echo U("Pflow/add",array("oid"=>$oid,"mid"=>$mid),"");?>') href="javascript:;" >+</a></h4>
                <ul class="list lh-24">
                    <?php if(is_array($contents[2])): $k = 0; $__LIST__ = $contents[2];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($k % 2 );++$k;?><li>
                            <?php if($k == 1): ?><a href="<?php echo U('Pflow/find',array('id'=>$m['id']),'');?>"  class="cur"><?php echo ($m['power']); ?><input type="hidden" value="<?php echo ($m['id']); ?>"/></a>&nbsp;&nbsp;
                                <?php else: ?>
                                <a href="<?php echo U('Pflow/find',array('id'=>$m['id']),'');?>"><?php echo ($m['power']); ?><input type="hidden" value="<?php echo ($m['id']); ?>"/></a>&nbsp;&nbsp;<?php endif; ?>

                            <a title="修改" class="ml-5" onclick=ql_edit("修改","<?php echo U('Pflow/edit',array('id'=>$m['id']),'');?>") href="javascript:;"><img src="/monitor/Public/admin/images/pen.png" width="12"/><a>&nbsp;
                                <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none" id="<?php echo U('Pflow/delete',array('id'=>$m['id']),'');?>"><img src="/monitor/Public/admin/images/delete.png" width="12"/></a>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
            <div class="pd-15 radius lh-22 mb-5 content" style="background: #eee;">
                <h4><span class="who"></span>流程</strong></h4>
                <div class="text-c content">
                    <input id="server" value="/monitor/uploads/" type="hidden" />
                    <img src="/monitor/uploads/<?php echo ($contents[2][0]['flow']); ?>"  />
                </div>
            </div>
        </div>
        <div class="tabCon">
            <div class="pd-15 radius lh-22 mb-5" style="background: #eee;">
                <h4><strong>岗位权力流程清单</strong>&nbsp;<a class="btn btn-primary radius pl-10 pr-10 add" onclick=ql_add('添加权力','<?php echo U("Pflow/add",array("oid"=>$oid,"mid"=>$mid),"");?>') href="javascript:;" >+</a></h4>
                <ul class="list lh-24">
                    <?php if(is_array($contents[3])): $k = 0; $__LIST__ = $contents[3];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($k % 2 );++$k;?><li>
                            <?php if($k == 1): ?><a href="<?php echo U('Pflow/find',array('id'=>$m['id']),'');?>"  class="cur"><?php echo ($m['power']); ?><input type="hidden" value="<?php echo ($m['id']); ?>"/></a>&nbsp;&nbsp;
                                <?php else: ?>
                                <a href="<?php echo U('Pflow/find',array('id'=>$m['id']),'');?>"><?php echo ($m['power']); ?><input type="hidden" value="<?php echo ($m['id']); ?>"/></a>&nbsp;&nbsp;<?php endif; ?>

                            <a title="修改" class="ml-5" onclick=ql_edit("修改","<?php echo U('Pflow/edit',array('id'=>$m['id']),'');?>") href="javascript:;"><img src="/monitor/Public/admin/images/pen.png" width="12"/><a>&nbsp;
                                <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none" id="<?php echo U('Pflow/delete',array('id'=>$m['id']),'');?>"><img src="/monitor/Public/admin/images/delete.png" width="12"/></a>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
            <div class="pd-15 radius lh-22 mb-5 content" style="background: #eee;">
                <h4><span class="who"></span>流程</strong></h4>
                <div class="text-c content">
                    <input id="server" value="/monitor/uploads/" type="hidden" />
                    <img src="/monitor/uploads/<?php echo ($contents[3][0]['flow']); ?>"  />
                </div>
            </div>

        </div>
        <input type="hidden" value="<?php echo ($mid); ?>" id="mid" />
    </div>
    <script type="text/javascript" src="/monitor/Public/admin/lib/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="/monitor/Public/admin/lib/Validform/5.3.2/Validform.min.js"></script>
    <script type="text/javascript" src="/monitor/Public/admin/lib/layer/1.9.3/layer.js"></script>
    <script type="text/javascript" src="/monitor/Public/admin/lib/icheck/jquery.icheck.min.js"></script>
    <script type="text/javascript" src="/monitor/Public/admin/js/H-ui.js"></script>
    <script type="text/javascript" src="/monitor/Public/admin/js/H-ui.admin.js"></script>

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
            //先选中哪个部门是显示的
            for(var i=0; i<$(".tabBar span").length; i++){
                $(".who:eq("+i+")").text($(".tabCon:eq("+i+") .cur") .text());
            }
            var which = $("#mid").val();
            $("span[name='"+which+"']").click();

            //单击哪个动态请求哪个的数据
            $(".list a").click(function(){
                var self = $(this);
                $(".list a").removeClass('cur');
                self.addClass('cur');
                var url = self.attr('href');
                $.get(url,function(data){
                    data = eval('(' + data + ')');
                    var area = self.parents($(".tabCon"));
                    area.find('.content img').attr("src",$("#server").val()+data.flow);
                    area.find('.who').html(self.text()); //流程主题改变
                });
                return false;
            });
        });
        /**
         * 确定是哪个部门要修改权力
         * */
        function ql_edit(title,url){
            var mid = $(".current").attr('name');
            url += '/mid/';
            url += mid;
            jtzr_edit(title,url);
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
        /**
         * 确定是哪个部门要添加权力
         * */
        function ql_add(title,url){
            var mid = $(".current").attr('name');
            url += '/mid/';
            url += mid;
            jtzr_add(title,url);
        }
        /*权力-添加*/
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