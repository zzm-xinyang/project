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
<div class="pd-20">
    <form action="<?php echo U("update","","");?>" method="post" class="form form-horizontal" id="form-article-add">
        <div class="row cl">
            <label class="form-label col-1"><span class="c-red">*</span>主题：</label>
            <div class="formControls col-11">
                <input type="text" class="input-text" value="<?php echo ($monitor['subject']); ?>" name="subject">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-1">详细内容：</label>
            <input type="hidden"  value="<?php echo ($monitor['content']); ?>" id="content" />
            <div class="formControls col-11">
                <script id="editor" name="content"type="text/plain" style="width:100%;height:400px;"></script>

            </div>
        </div>
        <div class="row cl text-l">
            <div class="col-11 col-offset-1">
                <button  class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i>修改</button>
                <input type="hidden" value="<?php echo ($monitor['id']); ?>" name="id">
                <input type="hidden" value="<?php echo ($oid); ?>" name="oid">
                <button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
            </div>
        </div>
    </form>
</div>
</div>
<script type="text/javascript" src="/monitor/Public/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/lib/layer/1.9.3/layer.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/lib/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/lib/icheck/jquery.icheck.min.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/lib/Validform/5.3.2/Validform.min.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/lib/webuploader/0.1.5/webuploader.min.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="/monitor/Public/admin/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/js/H-ui.js"></script>
<script type="text/javascript" src="/monitor/Public/admin/js/H-ui.admin.js"></script>
<script type="text/javascript">
    $(function(){
        var ue = UE.getEditor('editor');

        //如果主题和内容为空，则自动填充内容
        if(!$("input[name='id']").val()){
            $("input[name='subject']").val('四权监控');
            $("#editor").val('四权指：依法确权、规范配权、阳光晒权、全程控权；四权指：依法确权、规范配权、阳光晒权、全程控权；四权指：依法确权、规范配权、阳光晒权、全程控权；四权指：依法确权、规范配权、阳光晒权、全程控权；四权指：依法确权、规范配权、阳光晒权、全程控权；四权指：依法确权、规范配权、阳光晒权、全程控权；四权指：依法确权、规范配权、阳光晒权、全程控权；四权指：依法确权、规范配权、阳光晒权、全程控权；四权指：依法确权、规范配权、阳光晒权、全程控权；四权指：依法确权、规范配权、阳光晒权、全程控权；四权指：依法确权、规范配权、阳光晒权、全程控权；四权指：依法确权、规范配权、阳光晒权、全程控权；');
        }else{
            $("#editor").val($("#content").val());
        }
    });
</script>
</body>
</html>