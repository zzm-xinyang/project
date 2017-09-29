/**
 * 控制开始日期和结束日期
 */
$(function(){
    parent.layer.closeAll();
    $("#logmin").datepicker({
        dateFormat: "yy-mm-dd",
        onSelect:function(dateText,inst){
            $("#logmax").datepicker("option","minDate",dateText);
        }
    });
    $("#logmax").datepicker({
        dateFormat: "yy-mm-dd",
        onSelect:function(dateText,inst){
            $("#logmin").datepicker("option","maxDate",dateText);
        }
    });
});
