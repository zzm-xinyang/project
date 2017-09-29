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
<div class="pd-20">
    <form action="<?php echo U('save','','');?>" method="post" class="form form-horizontal" id="form-admin-add">


        <div class="row cl">
            <label class="form-label col-1">组织：</label>
            <div class="formControls col-4">
                <select name="oid"  class="select pd-5">
                    <?php if(is_array($organizes)): $i = 0; $__LIST__ = $organizes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$organize): $mod = ($i % 2 );++$i;?><option value="<?php echo ($organize['id']); ?>"><?php echo ($organize['organize']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-1">角色：</label>
            <div class="formControls col-6">
                <input type="text" class="input-text"  name="user-name" id="user-name" datatype="*2-16" nullmsg="角色名称不能为空">
            </div>
            <div class="col-5"> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-1">网站权限：</label>
            <div class="formControls col-11">
                <?php if(is_array($modular)): $k1 = 0; $__LIST__ = $modular;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v1): $mod = ($k1 % 2 );++$k1;?><dl class="permission-list">
                        <dt>
                            <label>
                                <input type="checkbox" value=<?php echo ($k1-1); ?> name="user-Character-0" id="user-Character-0">
                                <?php echo ($v1["title"]); ?></label>
                        </dt>
                        <dd>
                            <?php if(is_array($submodule[$k1-1])): $k2 = 0; $__LIST__ = $submodule[$k1-1];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v2): $mod = ($k2 % 2 );++$k2;?><dl class="cl permission-list2">
                                    <dt>
                                        <label class="">
                                            <input type="checkbox" value=<?php echo ($k2-1); ?> name="user-Character-0-0" id="user-Character-0-0" >
                                            <?php echo ($v2['title']); ?></label>
                                    </dt>
                                    <dd>
                                        <?php if(is_array($operation[$k1-1][$k2-1])): $k3 = 0; $__LIST__ = $operation[$k1-1][$k2-1];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v3): $mod = ($k3 % 2 );++$k3;?><label class="">
                                                <input type="checkbox" value=<?php echo ($v3['id']); ?> name="user-Character-0-0-0[]" id="user-Character-0-0-1">
                                                    <?php echo ($v3['title']); ?>
                                            </label><?php endforeach; endif; else: echo "" ;endif; ?>
                                    </dd>
                                </dl><?php endforeach; endif; else: echo "" ;endif; ?>
                        </dd>
                    </dl><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>

        <div class="row cl">
            <div class="col-11 col-offset-1">
                <button type="submit" class="btn btn-primary radius" id="admin-role-save" name="admin-role-save" onclick="is_checked()"><i class="icon-ok"></i> 确定</button>
                <button type="submit" class="btn btn-default radius" id="admin-role-save" name="admin-role-save"><i class="icon-ok"></i> 取消</button>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript" src="/monitor/Public/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/lib/layer/1.9.3/layer.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/lib/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/js/H-ui.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/lib/icheck/jquery.icheck.min.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/lib/Validform/5.3.2/Validform.min.js"></script>
<script>
    $(function(){
        $(".permission-list dt input:checkbox").click(function(){
            $(this).closest("dl").find("dd input:checkbox").prop("checked",$(this).prop("checked"));
        });
        $(".permission-list2 dd input:checkbox").click(function(){
            var l =$(this).parent().parent().find("input:checked").length;
            var l2=$(this).parents(".permission-list").find(".permission-list2 dd").find("input:checked").length;
            if($(this).prop("checked")){
                $(this).closest("dl").find("dt input:checkbox").prop("checked",true);
                $(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",true);
            }
            else{
                if(l==0){
                    $(this).closest("dl").find("dt input:checkbox").prop("checked",false);
                }
                if(l2==0){
                    $(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",false);
                }
            }

        });

    }(jQuery));


    function is_checked() {
        var operation_obj = document.getElementsByName('user-Character-0-0-0[]');
        operation_check_val = [];
        for (k in operation_obj){
            if (operation_obj[k].checked ){
                operation_check_val[index].push(operation_obj.value);
            }
        }
        window.location.href = "/monitor/index.php/Admin/Group/update/user-Character-0-0-0/" + operation_check_val;
    }

</script>

</body>
</html>