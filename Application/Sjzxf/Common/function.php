<?php
	header("Content-Type:text/html; charset=utf-8");
	//分页样式函数
	function bootstrap_page_style($page_html){
        if ($page_html) {
            $page_show = str_replace('<div>','<nav><ul class="pagination">',$page_html);
            $page_show = str_replace('</div>','</ul></nav>',$page_show);
            $page_show = str_replace('<span class="current">','<li class="active"><a>',$page_show);
            $page_show = str_replace('</span>','</a></li>',$page_show);
            $page_show = str_replace(array('<a class="num"','<a class="prev"','<a class="next"','<a class="end"','<a class="first"'),'<li><a',$page_show);
            $page_show = str_replace('</a>','</a></li>',$page_show);
        }
        return $page_show;
    }
    //根据日期获取星期几
    function wk($date) {
        //强制转换日期格式
        $date_str=date('Y-m-d',strtotime($date));   
        //封装成数组
        $arr=explode("-", $date_str);        
        //参数赋值
        //年
        $year=$arr[0];        
        //月，输出2位整型，不够2位右对齐
        $month=sprintf('%02d',$arr[1]);        
        //日，输出2位整型，不够2位右对齐
        $day=sprintf('%02d',$arr[2]);        
        //时分秒默认赋值为0；
        $hour = $minute = $second = 0;          
        //转换成时间戳
        $strap = mktime($hour,$minute,$second,$month,$day,$year);        
        //获取数字型星期几
        $number_wk=date("w",$strap);        
        //自定义星期数组
        $weekArr=array("星期日","星期一","星期二","星期三","星期四","星期五","星期六");       
        //获取数字对应的星期
        return $weekArr[$number_wk];
    }

?>