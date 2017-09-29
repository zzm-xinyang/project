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
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 权力监控 <span class="c-gray en">&gt;</span> 部门岗位权力<a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="pd-20">

    <div id="tab-system" class="HuiTab">
        <div class="tabBar cl">
            <?php if(is_array($departments)): $i = 0; $__LIST__ = $departments;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$department): $mod = ($i % 2 );++$i; if($mid == $department['id']): ?><span name="<?php echo ($department['id']); ?>" class="current"><?php echo ($department['name']); ?></span>
                <?php else: ?>
                    <span name="<?php echo ($department['id']); ?>"><?php echo ($department['name']); ?></span><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            <input type="hidden" id="oid" value="<?php echo ($oid); ?>" />
        </div>
        <div class="tabCon important">
            <div class="pl-20 lh-22 pd-10" style="background: #eee;">
                <h4><strong>岗位权力清单</strong>&nbsp;<a class="btn btn-primary radius pl-10 pr-10 add" onclick=ql_add('添加权力','<?php echo U("Pcontrol/add",array("oid"=>$oid),"");?>') href="javascript:;" >+</a></h4>
            </div>
            <div class="cl pd-5 bg-1 bk-gray">
                <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius "><i class="Hui-iconfont"></i> 批量删除</a></span>
                <div class="text-r" style="float:right;">
                    <label>办理主体：</label>
                    <select name="finish" style="height: 29px;border:1px #ddd solid;">
                        <option value="0">办公室</option>
                        <option value="1">政治部</option>
                    </select>
                    <label>公开范围：</label>
                    <select name="finish" style="height: 29px;border:1px #ddd solid;">
                        <option value="0">内部</option>
                        <option value="1">社会</option>
                    </select>
                    日期范围：
                    <input type="text"  id="logmin" class="input-text Wdate" style="width:120px;">
                    -
                    <input type="text"  id="logmax" class="input-text Wdate" style="width:120px;">
                    <input type="text" name="" id="" placeholder=" 关键词" style="width:180px" class="input-text">

                    <button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜事项</button>
                </div>
            </div>
            <table class="table table-border table-bordered table-hover table-bg table-sort">
                <thead>
                <tr class="text-l">
                    <th width="25" class="text-c"><input type="checkbox" name="" value=""></th>
                    <th width="25">序号</th>
                    <th width="100">权力名称</th>
                    <th width="100">权力类别</th>
                    <th>设置依据</th>
                    <th width="80">办理主体</th>

                    <th width="80">公开范围</th>
                    <th width="80">办理日期</th>
                    <th width="60">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($contents[0])): $k = 0; $__LIST__ = $contents[0];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$con): $mod = ($k % 2 );++$k;?><tr class="text-l">
                        <td class="text-c"><input type="checkbox" value="<?php echo ($con['id']); ?>" name="ids[]"></td>
                        <td class="text-c"><?php echo ($k); ?></td>
                        <td><?php echo ($con['power']); ?></td>
                        <td><?php echo ($con['type']); ?></td>
                        <td><?php echo ($con['reasons']); ?></td>
                        <td><?php echo ($con['activity']); ?></td>
                        <td><?php echo ($con['notice']); ?></td>
                        <td><?php echo ($con['inputtime']); ?></td>
                        <td> <a title="修改" class="ml-5" onclick=ql_edit("修改","<?php echo U('Pcontrol/edit',array('id'=>$con['id']),'');?>") href="javascript:;"><img src="/monitor/Public/admin/images/pen.png" width="12"/></a>   <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none" id="<?php echo U('delete',array('id'=>$con['id']),'');?>"><img src="/monitor/Public/admin/images/delete.png" width="12"/></a></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>

                </tbody>
            </table>
            <div class="text-r mt-20 page">
               <?php echo ($contents[0][0]['page']); ?>
            </div>
            <div class="pd-15 radius lh-22 mt-15" style="background: #eee;"  >

                <h4><strong>监控重点</strong>&nbsp;<a class="btn btn-primary radius pl-10 pr-10 add" onclick=ql_add('编辑监控重点','<?php echo U("Cimportant/edit",array("oid"=>$oid),"");?>') href="javascript:;" ><img src="/monitor/Public/admin/images/pen.png" width="12"/></a></h4>
                <ul class="list lh-24">
                    <?php if(is_array($controls[0])): $i = 0; $__LIST__ = $controls[0];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$important): $mod = ($i % 2 );++$i; if($which[0] == $important['id']): ?><li><a href="<?php echo U('Pcontrol/change',array('which'=>$important['id']),'');?>" class="cur" name="<?php echo ($important['id']); ?>"><?php echo ($important['power']); ?></a></li>
                        <?php else: ?>
                            <li><a href="<?php echo U('Pcontrol/change',array('which'=>$important['id']),'');?>"><?php echo ($important['power']); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>

                </ul>
            </div>
            <?php if($hasKey[0] == 1): ?><div class="pd-15 radius lh-22 mt-15" style="background: #eee;">

                <h4 style="float:left"><strong>士官选取权力运行情况</strong>&nbsp;<?php if($addTable[0] != 1): ?>&nbsp;<a class="btn btn-primary radius pl-10 pr-10 add" onclick=ql_add('添加权力运行','<?php echo U("Progressing/add",array("tableName"=>$tname[0],"iid"=>$which[0]),"");?>') href="javascript:;" >+</a><?php endif; ?></h4>
             <?php if($editTable[0] == 1): ?><div class="text-r pt-10" style="float:right;"> <a class="btn btn-primary radius" onclick=model_choise(this,'修改表结构','<?php echo U("Cimportant/editModel",array("tableName"=>$tname[0]),"");?>') href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i>修改表结构</a></div><?php endif; ?>
            <?php if($addTable[0] == 1): ?><div class="text-r pt-10" style="float:right;"> <a class="btn btn-primary radius" onclick=model_choise(this,'选择或创建表结构','<?php echo U("Cimportant/choiseModel","","");?>') href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i>选择或创建表结构</a></div><?php endif; ?>
            </div>

            <?php if($viewTable[0] == 1): ?><div class="cl pd-5 bg-1 bk-gray">
                    <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius "><i class="Hui-iconfont"></i> 批量删除</a></span>
                    <div class="text-r" style="float:right;">
                        日期范围：
                        <input type="text" id="logmin" class="input-text Wdate" style="width:120px;">
                        -
                        <input type="text"  id="logmax" class="input-text Wdate" style="width:120px;">
                        <input type="text" name="" id="" placeholder=" 关键词" style="width:180px" class="input-text">

                        <button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜事项</button>
                    </div>
                </div>
            <table class="table table-border table-bordered table-hover table-bg table-sort">
                <thead>
                <tr class="text-c">
                <th width="30px"><input type="checkbox" /></th>
                <th width="30px">序号</th>
                <?php if(is_array($fields[0])): $i = 0; $__LIST__ = array_slice($fields[0],5,null,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$field): $mod = ($i % 2 );++$i;?><th><?php echo ($field['comment']); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
                <th>办理时间</th>
                <th>评价</th>
                <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($progressings[0])): $k = 0; $__LIST__ = $progressings[0];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$progressing): $mod = ($k % 2 );++$k;?><tr class="text-c">
                        <td><input type="checkbox" name="" value="<?php echo ($progressing['id']); ?>"></td>
                        <td><?php echo ($k); ?></td>
                        <?php if(is_array($progressing['add'])): $i = 0; $__LIST__ = $progressing['add'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$add): $mod = ($i % 2 );++$i; if(strpos($add, '/') == 10): ?><td><a href="/monitor/uploads/<?php echo ($add); ?>">下载</a></td>
                            <?php else: ?>
                                <td><?php echo ($add); ?></td><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                        <td><?php echo (date("Y-m-d H:i",$progressing['processingtime'])); ?></td>
                        <td></td>
                        <td> <a title="修改" class="ml-5" onclick=jtzr_edit("修改","<?php echo U('Progressing/edit',array('id'=>$progressing['id'],'tableName'=>$tname[0]));?>") href="javascript:;"><img src="/monitor/Public/admin/images/pen.png" width="12"/><a>&nbsp;
                            <a title="删除" href="javascript:;" onclick="processing_del(this,'1')" class="ml-5" style="text-decoration:none" id="<?php echo U('Progressing/delete',array('id'=>$progressing['id'],'tableName'=>$tname[0]),'');?>"><img src="/monitor/Public/admin/images/delete.png" width="12"/></a></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
            <div class="text-r mt-20">
                <?php echo ($page); ?>
            </div>
            <input type="hidden" value="<?php echo ($passesses[0]); ?>" id="data1"/>
            <div id="container" style="min-width:700px;height:400px"></div><?php endif; endif; ?>
            </div>
        <div class="tabCon important">
            <div class="pl-20 lh-22 pd-10" style="background: #eee;">
                <h4><strong>岗位权力清单</strong>&nbsp;<a class="btn btn-primary radius pl-10 pr-10 add" onclick=ql_add('添加权力','<?php echo U("Pcontrol/add",array("oid"=>$oid),"");?>') href="javascript:;" >+</a></h4>
            </div>
            <div class="cl pd-5 bg-1 bk-gray">
                <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius "><i class="Hui-iconfont"></i> 批量删除</a></span>
                <div class="text-r" style="float:right;">
                    <label>办理主体：</label>
                    <select name="finish" style="height: 29px;border:1px #ddd solid;">
                        <option value="0">办公室</option>
                        <option value="1">政治部</option>
                    </select>
                    <label>公开范围：</label>
                    <select name="finish" style="height: 29px;border:1px #ddd solid;">
                        <option value="0">内部</option>
                        <option value="1">社会</option>
                    </select>
                    日期范围：
                    <input type="text"  id="logmin" class="input-text Wdate" style="width:120px;">
                    -
                    <input type="text"  id="logmax" class="input-text Wdate" style="width:120px;">
                    <input type="text" name="" id="" placeholder=" 关键词" style="width:180px" class="input-text">

                    <button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜事项</button>
                </div>
            </div>
            <table class="table table-border table-bordered table-hover table-bg table-sort">
                <thead>
                <tr class="text-l">
                    <th width="25" class="text-c"><input type="checkbox" name="" value=""></th>
                    <th width="25">序号</th>
                    <th width="100">权力名称</th>
                    <th width="100">权力类别</th>
                    <th>设置依据</th>
                    <th width="80">办理主体</th>

                    <th width="80">公开范围</th>
                    <th width="80">办理日期</th>
                    <th width="60">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($contents[1])): $k = 0; $__LIST__ = $contents[1];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$con): $mod = ($k % 2 );++$k;?><tr class="text-l">
                        <td class="text-c"><input type="checkbox" value="<?php echo ($con['id']); ?>" name="ids[]"></td>
                        <td class="text-c"><?php echo ($k); ?></td>
                        <td><?php echo ($con['power']); ?></td>
                        <td><?php echo ($con['type']); ?></td>
                        <td><?php echo ($con['reasons']); ?></td>
                        <td><?php echo ($con['activity']); ?></td>
                        <td><?php echo ($con['notice']); ?></td>
                        <td><?php echo ($con['inputtime']); ?></td>
                        <td> <a title="修改" class="ml-5" onclick=ql_edit("修改","<?php echo U('Pcontrol/edit',array('id'=>$con['id']),'');?>") href="javascript:;"><img src="/monitor/Public/admin/images/pen.png" width="12"/></a>   <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none" id="<?php echo U('delete',array('id'=>$con['id']),'');?>"><img src="/monitor/Public/admin/images/delete.png" width="12"/></a></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>

                </tbody>
            </table>
            <div class="text-r mt-20 page">
                <?php echo ($contents[1][0]['page']); ?>
            </div>
            <div class="pd-15 radius lh-22 mt-15" style="background: #eee;"  >

                <h4><strong>监控重点</strong>&nbsp;<a class="btn btn-primary radius pl-10 pr-10 add" onclick=ql_add('编辑监控重点','<?php echo U("Cimportant/edit",array("oid"=>$oid),"");?>') href="javascript:;" ><img src="/monitor/Public/admin/images/pen.png" width="12"/></a></h4>
                <ul class="list lh-24">
                    <?php if(is_array($controls[1])): $i = 0; $__LIST__ = $controls[1];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$important): $mod = ($i % 2 );++$i; if($which[1] == $important['id']): ?><li><a href="<?php echo U('Pcontrol/change',array('which'=>$important['id']),'');?>" class="cur" name="<?php echo ($important['id']); ?>"><?php echo ($important['power']); ?></a></li>
                            <?php else: ?>
                            <li><a href="<?php echo U('Pcontrol/change',array('which'=>$important['id']),'');?>"><?php echo ($important['power']); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>

                </ul>
            </div>
            <?php if($hasKey[1] == 1): ?><div class="pd-15 radius lh-22 mt-15" style="background: #eee;">

                    <h4 style="float:left"><strong>士官选取权力运行情况</strong>&nbsp;<?php if($addTable[1] != 1): ?><a class="btn btn-primary radius pl-10 pr-10 add" onclick=ql_add('添加权力运行','<?php echo U("Progressing/add",array("tableName"=>$tname[1],"iid"=>$which[1]),"");?>') href="javascript:;" >+</a><?php endif; ?></h4>
                    <?php if($editTable[1] == 1): ?><div class="text-r pt-10" style="float:right;"> <a class="btn btn-primary radius" onclick=model_choise(this,'修改表结构','<?php echo U("Cimportant/editModel",array("tableName"=>$tname[1]),"");?>') href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i>修改表结构</a></div>
                </div><?php endif; ?>
            <?php if($addTable[1] == 1): ?><div class="text-r pt-10" style="float:right;"> <a class="btn btn-primary radius" onclick=model_choise(this,'选择或创建表结构','<?php echo U("Cimportant/choiseModel","","");?>') href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i>选择或创建表结构</a></div>
        </div><?php endif; ?>
</div>

<?php if($viewTable[1] == 1): ?><div class="cl pd-5 bg-1 bk-gray">
        <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius "><i class="Hui-iconfont"></i> 批量删除</a></span>
        <div class="text-r" style="float:right;">
            日期范围：
            <input type="text" id="logmin" class="input-text Wdate" style="width:120px;">
            -
            <input type="text"  id="logmax" class="input-text Wdate" style="width:120px;">
            <input type="text" name="" id="" placeholder=" 关键词" style="width:180px" class="input-text">

            <button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜事项</button>
        </div>
    </div>
    <table class="table table-border table-bordered table-hover table-bg table-sort">
        <thead>
        <tr class="text-c">
            <th width="30px"><input type="checkbox" /></th>
            <th width="30px">序号</th>
            <?php if(is_array($fields[1])): $i = 0; $__LIST__ = array_slice($fields[1],5,null,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$field): $mod = ($i % 2 );++$i;?><th><?php echo ($field['comment']); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
            <th>办理时间</th>
            <th>评价</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($progressings[1])): $k = 0; $__LIST__ = $progressings[1];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$progressing): $mod = ($k % 2 );++$k;?><tr class="text-c">
                <td><input type="checkbox" name="" value="<?php echo ($progressing['id']); ?>"></td>
                <td><?php echo ($k); ?></td>
                <?php if(is_array($progressing['add'])): $i = 0; $__LIST__ = $progressing['add'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$add): $mod = ($i % 2 );++$i; if(strpos($add, '/') == 10): ?><td><a href="/monitor/uploads/<?php echo ($add); ?>">下载</a></td>
                        <?php else: ?>
                        <td><?php echo ($add); ?></td><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                <td><?php echo (date("Y-m-d H:i",$progressing['processingtime'])); ?></td>
                <td></td>
                <td> <a title="修改" class="ml-5" onclick=jtzr_edit("修改","<?php echo U('Progressing/edit',array('id'=>$progressing['id'],'tableName'=>$tname[1]));?>") href="javascript:;"><img src="/monitor/Public/admin/images/pen.png" width="12"/><a>&nbsp;
                    <a title="删除" href="javascript:;" onclick="processing_del(this,'1')" class="ml-5" style="text-decoration:none" id="<?php echo U('Progressing/delete',array('id'=>$progressing['id'],'tableName'=>$tname[1]),'');?>"><img src="/monitor/Public/admin/images/delete.png" width="12"/></a></td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
                <div class="text-r mt-20">
                   <?php echo ($page); ?>
                </div>

                <div id="container2" style="min-width:700px;height:400px"></div><?php endif; endif; ?>
        </div>
        <div class="tabCon important">
            <div class="pl-20 lh-22 pd-10" style="background: #eee;">
                <h4><strong>岗位权力清单</strong>&nbsp;<a class="btn btn-primary radius pl-10 pr-10 add" onclick=ql_add('添加权力','<?php echo U("Pcontrol/add",array("oid"=>$oid),"");?>') href="javascript:;" >+</a></h4>
            </div>
            <div class="cl pd-5 bg-1 bk-gray">
                <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius "><i class="Hui-iconfont"></i> 批量删除</a></span>
                <div class="text-r" style="float:right;">
                    <label>办理主体：</label>
                    <select name="finish" style="height: 29px;border:1px #ddd solid;">
                        <option value="0">办公室</option>
                        <option value="1">政治部</option>
                    </select>
                    <label>公开范围：</label>
                    <select name="finish" style="height: 29px;border:1px #ddd solid;">
                        <option value="0">内部</option>
                        <option value="1">社会</option>
                    </select>
                    日期范围：
                    <input type="text"  id="logmin" class="input-text Wdate" style="width:120px;">
                    -
                    <input type="text"  id="logmax" class="input-text Wdate" style="width:120px;">
                    <input type="text" name="" id="" placeholder=" 关键词" style="width:180px" class="input-text">

                    <button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜事项</button>
                </div>
            </div>
            <table class="table table-border table-bordered table-hover table-bg table-sort">
                <thead>
                <tr class="text-l">
                    <th width="25" class="text-c"><input type="checkbox" name="" value=""></th>
                    <th width="25">序号</th>
                    <th width="100">权力名称</th>
                    <th width="100">权力类别</th>
                    <th>设置依据</th>
                    <th width="80">办理主体</th>

                    <th width="80">公开范围</th>
                    <th width="80">办理日期</th>
                    <th width="60">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($contents[2])): $k = 0; $__LIST__ = $contents[2];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$con): $mod = ($k % 2 );++$k;?><tr class="text-l">
                        <td class="text-c"><input type="checkbox" value="<?php echo ($con['id']); ?>" name="ids[]"></td>
                        <td class="text-c"><?php echo ($k); ?></td>
                        <td><?php echo ($con['power']); ?></td>
                        <td><?php echo ($con['type']); ?></td>
                        <td><?php echo ($con['reasons']); ?></td>
                        <td><?php echo ($con['activity']); ?></td>
                        <td><?php echo ($con['notice']); ?></td>
                        <td><?php echo ($con['inputtime']); ?></td>
                        <td> <a title="修改" class="ml-5" onclick=ql_edit("修改","<?php echo U('Pcontrol/edit',array('id'=>$con['id']),'');?>") href="javascript:;"><img src="/monitor/Public/admin/images/pen.png" width="12"/></a>   <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none" id="<?php echo U('delete',array('id'=>$con['id']),'');?>"><img src="/monitor/Public/admin/images/delete.png" width="12"/></a></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>

                </tbody>
            </table>
            <div class="text-r mt-20 page">
                <?php echo ($contents[2][0]['page']); ?>
            </div>
            <div class="pd-15 radius lh-22 mt-15" style="background: #eee;"  >

                <h4><strong>监控重点</strong>&nbsp;<a class="btn btn-primary radius pl-10 pr-10 add" onclick=ql_add('编辑监控重点','<?php echo U("Cimportant/edit",array("oid"=>$oid),"");?>') href="javascript:;" ><img src="/monitor/Public/admin/images/pen.png" width="12"/></a></h4>
                <ul class="list lh-24">
                    <?php if(is_array($controls[2])): $i = 0; $__LIST__ = $controls[2];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$important): $mod = ($i % 2 );++$i; if($which[2] == $important['id']): ?><li><a href="<?php echo U('Pcontrol/change',array('which'=>$important['id']),'');?>" class="cur" name="<?php echo ($important['id']); ?>"><?php echo ($important['power']); ?></a></li>
                            <?php else: ?>
                            <li><a href="<?php echo U('Pcontrol/change',array('which'=>$important['id']),'');?>"><?php echo ($important['power']); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>

                </ul>
            </div>
            <?php if($hasKey[2] == 1): ?><div class="pd-15 radius lh-22 mt-15" style="background: #eee;">

                    <h4 style="float:left"><strong>士官选取权力运行情况</strong>&nbsp;<?php if($addTable[2] != 1): ?><a class="btn btn-primary radius pl-10 pr-10 add" onclick=ql_add('添加权力运行','<?php echo U("Progressing/add",array("tableName"=>$tname[2],"iid"=>$which[2]),"");?>') href="javascript:;" >+</a><?php endif; ?></h4>
                    <?php if($editTable[2] == 1): ?><div class="text-r pt-10" style="float:right;"> <a class="btn btn-primary radius" onclick=model_choise(this,'修改表结构','<?php echo U("Cimportant/editModel",array("tableName"=>$tname[2]),"");?>') href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i>修改表结构</a></div>
                </div><?php endif; ?>
            <?php if($addTable[2] == 1): ?><div class="text-r pt-10" style="float:right;"> <a class="btn btn-primary radius" onclick=model_choise(this,'选择或创建表结构','<?php echo U("Cimportant/choiseModel","","");?>') href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i>选择或创建表结构</a></div>
        </div><?php endif; ?>
</div>

<?php if($viewTable[2] == 1): ?><div class="cl pd-5 bg-1 bk-gray">
        <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius "><i class="Hui-iconfont"></i> 批量删除</a></span>
        <div class="text-r" style="float:right;">
            日期范围：
            <input type="text" id="logmin" class="input-text Wdate" style="width:120px;">
            -
            <input type="text"  id="logmax" class="input-text Wdate" style="width:120px;">
            <input type="text" name="" id="" placeholder=" 关键词" style="width:180px" class="input-text">

            <button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜事项</button>
        </div>
    </div>
    <table class="table table-border table-bordered table-hover table-bg table-sort">
        <thead>
        <tr class="text-c">
            <th width="30px"><input type="checkbox" /></th>
            <th width="30px">序号</th>
            <?php if(is_array($fields[2])): $i = 0; $__LIST__ = array_slice($fields[2],5,null,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$field): $mod = ($i % 2 );++$i;?><th><?php echo ($field['comment']); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
            <th>办理时间</th>
            <th>评价</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($progressings[2])): $k = 0; $__LIST__ = $progressings[2];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$progressing): $mod = ($k % 2 );++$k;?><tr class="text-c">
                <td><input type="checkbox" name="" value="<?php echo ($progressing['id']); ?>"></td>
                <td><?php echo ($k); ?></td>
                <?php if(is_array($progressing['add'])): $i = 0; $__LIST__ = $progressing['add'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$add): $mod = ($i % 2 );++$i; if(strpos($add, '/') == 10): ?><td><a href="/monitor/uploads/<?php echo ($add); ?>">下载</a></td>
                        <?php else: ?>
                        <td><?php echo ($add); ?></td><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                <td><?php echo (date("Y-m-d H:i",$progressing['processingtime'])); ?></td>
                <td></td>
                <td> <a title="修改" class="ml-5" onclick=jtzr_edit("修改","<?php echo U('Progressing/edit',array('id'=>$progressing['id'],'tableName'=>$tname[2]));?>") href="javascript:;"><img src="/monitor/Public/admin/images/pen.png" width="12"/><a>&nbsp;
                    <a title="删除" href="javascript:;" onclick="processing_del(this,'1')" class="ml-5" style="text-decoration:none" id="<?php echo U('Progressing/delete',array('id'=>$progressing['id'],'tableName'=>$tname[2]),'');?>"><img src="/monitor/Public/admin/images/delete.png" width="12"/></a></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
    <div class="text-r mt-20">
        <?php echo ($page); ?>
    </div>

    <div id="container3" style="min-width:700px;height:400px"></div><?php endif; endif; ?>
        </div>
        <div class="tabCon important">
            <div class="pl-20 lh-22 pd-10" style="background: #eee;">
                <h4><strong>岗位权力清单</strong>&nbsp;<a class="btn btn-primary radius pl-10 pr-10 add" onclick=ql_add('添加权力','<?php echo U("Pcontrol/add",array("oid"=>$oid),"");?>') href="javascript:;" >+</a></h4>
            </div>
            <div class="cl pd-5 bg-1 bk-gray">
                <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius "><i class="Hui-iconfont"></i> 批量删除</a></span>
                <div class="text-r" style="float:right;">
                    <label>办理主体：</label>
                    <select name="finish" style="height: 29px;border:1px #ddd solid;">
                        <option value="0">办公室</option>
                        <option value="1">政治部</option>
                    </select>
                    <label>公开范围：</label>
                    <select name="finish" style="height: 29px;border:1px #ddd solid;">
                        <option value="0">内部</option>
                        <option value="1">社会</option>
                    </select>
                    日期范围：
                    <input type="text"  id="logmin" class="input-text Wdate" style="width:120px;">
                    -
                    <input type="text"  id="logmax" class="input-text Wdate" style="width:120px;">
                    <input type="text" name="" id="" placeholder=" 关键词" style="width:180px" class="input-text">

                    <button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜事项</button>
                </div>
            </div>
            <table class="table table-border table-bordered table-hover table-bg table-sort">
                <thead>
                <tr class="text-l">
                    <th width="25" class="text-c"><input type="checkbox" name="" value=""></th>
                    <th width="25">序号</th>
                    <th width="100">权力名称</th>
                    <th width="100">权力类别</th>
                    <th>设置依据</th>
                    <th width="80">办理主体</th>

                    <th width="80">公开范围</th>
                    <th width="80">办理日期</th>
                    <th width="60">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($contents[3])): $k = 0; $__LIST__ = $contents[3];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$con): $mod = ($k % 2 );++$k;?><tr class="text-l">
                        <td class="text-c"><input type="checkbox" value="<?php echo ($con['id']); ?>" name="ids[]"></td>
                        <td class="text-c"><?php echo ($k); ?></td>
                        <td><?php echo ($con['power']); ?></td>
                        <td><?php echo ($con['type']); ?></td>
                        <td><?php echo ($con['reasons']); ?></td>
                        <td><?php echo ($con['activity']); ?></td>
                        <td><?php echo ($con['notice']); ?></td>
                        <td><?php echo ($con['inputtime']); ?></td>
                        <td> <a title="修改" class="ml-5" onclick=ql_edit("修改","<?php echo U('Pcontrol/edit',array('id'=>$con['id']),'');?>") href="javascript:;"><img src="/monitor/Public/admin/images/pen.png" width="12"/></a>   <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none" id="<?php echo U('delete',array('id'=>$con['id']),'');?>"><img src="/monitor/Public/admin/images/delete.png" width="12"/></a></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>

                </tbody>
            </table>
            <div class="text-r mt-20 page">
                <?php echo ($contents[3][0]['page']); ?>
            </div>
            <div class="pd-15 radius lh-22 mt-15" style="background: #eee;"  >

                <h4><strong>监控重点</strong>&nbsp;<a class="btn btn-primary radius pl-10 pr-10 add" onclick=ql_add('编辑监控重点','<?php echo U("Cimportant/edit",array("oid"=>$oid),"");?>') href="javascript:;" ><img src="/monitor/Public/admin/images/pen.png" width="12"/></a></h4>
                <ul class="list lh-24">
                    <?php if(is_array($controls[3])): $i = 0; $__LIST__ = $controls[3];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$important): $mod = ($i % 2 );++$i; if($which[3] == $important['id']): ?><li><a href="<?php echo U('Pcontrol/change',array('which'=>$important['id']),'');?>" class="cur" name="<?php echo ($important['id']); ?>"><?php echo ($important['power']); ?></a></li>
                            <?php else: ?>
                            <li><a href="<?php echo U('Pcontrol/change',array('which'=>$important['id']),'');?>"><?php echo ($important['power']); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>

                </ul>
            </div>
            <?php if($hasKey[3] == 1): ?><div class="pd-15 radius lh-22 mt-15" style="background: #eee;">

                    <h4 style="float:left"><strong>士官选取权力运行情况</strong>&nbsp;<?php if($addTable[3] != 1): ?><a class="btn btn-primary radius pl-10 pr-10 add" onclick=ql_add('添加权力运行','<?php echo U("Progressing/add",array("tableName"=>$tname[3],"iid"=>$which[3]),"");?>') href="javascript:;" >+</a><?php endif; ?></h4>
                    <?php if($editTable[3] == 1): ?><div class="text-r pt-10" style="float:right;"> <a class="btn btn-primary radius" onclick=model_choise(this,'修改表结构','<?php echo U("Cimportant/editModel",array("tableName"=>$tname[3]),"");?>') href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i>修改表结构</a></div>
                </div><?php endif; ?>
            <?php if($addTable[3] == 1): ?><div class="text-r pt-10" style="float:right;"> <a class="btn btn-primary radius" onclick=model_choise(this,'选择或创建表结构','<?php echo U("Cimportant/choiseModel","","");?>') href="javascript:;"><i class="Hui-iconfont">&#xe6df;</i>选择或创建表结构</a></div>
        </div><?php endif; ?>
</div>

<?php if($viewTable[3] == 1): ?><div class="cl pd-5 bg-1 bk-gray">
        <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius "><i class="Hui-iconfont"></i> 批量删除</a></span>
        <div class="text-r" style="float:right;">
            日期范围：
            <input type="text" id="logmin" class="input-text Wdate" style="width:120px;">
            -
            <input type="text"  id="logmax" class="input-text Wdate" style="width:120px;">
            <input type="text" name="" id="" placeholder=" 关键词" style="width:180px" class="input-text">

            <button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜事项</button>
        </div>
    </div>
    <table class="table table-border table-bordered table-hover table-bg table-sort">
        <thead>
        <tr class="text-c">
            <th width="30px"><input type="checkbox" /></th>
            <th width="30px">序号</th>
            <?php if(is_array($fields[3])): $i = 0; $__LIST__ = array_slice($fields[3],5,null,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$field): $mod = ($i % 2 );++$i;?><th><?php echo ($field['comment']); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
            <th>办理时间</th>
            <th>评价</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($progressings[3])): $k = 0; $__LIST__ = $progressings[3];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$progressing): $mod = ($k % 2 );++$k;?><tr class="text-c">
                <td><input type="checkbox" name="" value="<?php echo ($progressing['id']); ?>"></td>
                <td><?php echo ($k); ?></td>
                <?php if(is_array($progressing['add'])): $i = 0; $__LIST__ = $progressing['add'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$add): $mod = ($i % 2 );++$i; if(strpos($add, '/') == 10): ?><td><a href="/monitor/uploads/<?php echo ($add); ?>">下载</a></td>
                        <?php else: ?>
                        <td><?php echo ($add); ?></td><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                <td><?php echo (date("Y-m-d H:i",$progressing['processingtime'])); ?></td>
                <td></td>
                <td> <a title="修改" class="ml-5" onclick=jtzr_edit("修改","<?php echo U('Progressing/edit',array('id'=>$progressing['id'],'tableName'=>$tname));?>") href="javascript:;"><img src="/monitor/Public/admin/images/pen.png" width="12"/><a>&nbsp;
                    <a title="删除" href="javascript:;" onclick="processing_del(this,'1')" class="ml-5" style="text-decoration:none" id="<?php echo U('Progressing/delete',array('id'=>$progressing['id'],'tableName'=>$tname),'');?>"><img src="/monitor/Public/admin/images/delete.png" width="12"/></a></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
    <div class="text-r mt-20">
        <?php echo ($page); ?>
    </div>

    <div id="container4" style="min-width:700px;height:400px"></div><?php endif; endif; ?>
        </div>
        <input type="hidden" value="<?php echo ($mid); ?>" id="mid" />
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
    <script type="text/javascript" src="/monitor/Public/admin/js/common.js"></script>

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
            /*$(".page a").click(function(){
                var self = $(this);
                var url = self.attr("href").replace('index/','page/');
                $.get(url,function(data){
                    data = eval('(' + data + ')');
                    var area = self.parents($(".tabCon"));
                    console.log(data);

                });
                return false;

            })*/
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
                    area.find('.dutys').html(data.dutys);
                    area.find('.risks').html(data.risks);
                    area.find('.rlevel').html(data.rlevel);
                    area.find('.controls').html(data.controls);
                    area.find('.who').html(self.text()); //职责清单主题改变
                });
                return false;
            });
        });
        /**
         * 确定是哪个部门要修改权力
         * */
        function ql_edit(title,url){
            var mid = $(".current").attr('name');
            url += '/oid/';
            url += $("#oid").val();
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
        /*权力运行情况-删除*/
        function processing_del(obj,id){
            var url = $(obj).attr('id');
            layer.confirm('确认要删除吗？',function(index){
                $.get(url,function(data){
                    if(data==1){
                        $(obj).parents("tr").remove();
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
        /**
         * 确定是哪个监控重点要选择表结构
         * */
        function model_choise(ob,title,url){
            var iid = $(ob).parents(".important").find(".cur").attr('name');
            url += '/iid/';
            url += iid;
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

        /*饼形图*/
        $(function () {
            //根据现有数据创建饼形图
            var title=$('#container').parents('.tabCon').find('.cur').text();
            var data = $("#data1").val().split(',');
            createPie4($('#container'),title,data[0]-0,data[1]-1,data[2]-0,data[3]-0);

            //改变年份时，重新请求数据
            $("#finish").change(function(){
                var url = $("#countUrl").val();
                var whichYear = $(this).val();
                $.get(url,{
                    year:whichYear,
                    mid: $(".cur input").val()
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

    </script>
</body>
</html>