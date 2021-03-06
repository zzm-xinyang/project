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
    <script type="text/javascript" src="/monitorall/Public/admin/lib/html5.js"></script>
    <script type="text/javascript" src="/monitorall/Public/admin/lib/respond.min.js"></script>
    <script type="text/javascript" src="/monitorall/Public/admin/lib/PIE_IE678.js"></script>
    <![endif]-->
    <link href="/monitorall/Public/admin/css/H-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="/monitorall/Public/admin/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
    <link href="/monitorall/Public/admin/skin/default/skin.css" rel="stylesheet" type="text/css" id="skin" />
    <link href="/monitorall/Public/admin/lib/Hui-iconfont/1.0.1/iconfont.css" rel="stylesheet" type="text/css" />
    <link href="/monitorall/Public/admin/css/style.css" rel="stylesheet" type="text/css" />
    <link href="/monitorall/Public/admin/css/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="/monitorall/Public/admin/css/page.css" rel="stylesheet" type="text/css" />
    <link href="/monitorall/Public/admin/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
    <link href="/monitorall/Public/admin/css/new.css" rel="stylesheet" type="text/css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->

    <title>监督执纪问责监控平台</title>
</head>
<body>
<div class="pd-5">
    <form action='<?php echo U("Inleaderlist/update","","");?>' method="post" class="form form-horizontal" id="form-article-add">
        <input type="hidden" name="id" value="<?php echo ($list['id']); ?>" />
        <input type="hidden" id="content" value="<?php echo ($list['content']); ?>" />
        <div class="row cl">
            <label class="form-label col-2">详细内容：</label>
            <div class="formControls col-10">
                <script id="editor" name="content" type="text/plain" style="width:100%;height:400px;"></script>
            </div>
        </div>
        <div class="row cl text-l">
            <div class="col-10 col-offset-2">
                <button  class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i>修改</button>
                <button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
            </div>
        </div>
    </form>
</div>
</div>
<script type="text/javascript" src="/monitorall/Public/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/monitorall/Public/admin/lib/layer/1.9.3/layer.js"></script>
<script type="text/javascript" src="/monitorall/Public/admin/lib/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="/monitorall/Public/admin/lib/icheck/jquery.icheck.min.js"></script>
<script type="text/javascript" src="/monitorall/Public/admin/lib/Validform/5.3.2/Validform.min.js"></script>
<script type="text/javascript" src="/monitorall/Public/admin/lib/webuploader/0.1.5/webuploader.min.js"></script>
<script type="text/javascript" src="/monitorall/Public/admin/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/monitorall/Public/admin/lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="/monitorall/Public/admin/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript" src="/monitorall/Public/admin/js/H-ui.js"></script>
<script type="text/javascript" src="/monitorall/Public/admin/js/H-ui.admin.js"></script>
<script type="text/javascript">
    $(function(){
        var ue = UE.getEditor('editor');
        $("#editor").html($("#content").val());
    });
</script>
</body>
</html>