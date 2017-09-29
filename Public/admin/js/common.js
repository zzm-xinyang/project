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
function createPie4(ob,title,status1,status2,status3,status4){
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
                    name: '好',
                    y: status1,
                    color:'#EE7621',
                    sliced: true,
                    selected: true
                },
                {
                    name: '较好',
                    y: status2,
                    color:'#698B22',
                    sliced: true,
                    selected: true
                },
                {
                    name: '一般',
                    y: status3,
                    color:'#ff0000',
                    sliced: true,
                    selected: true
                },
                {
                    name: '差',
                    y: status4,
                    color:'#fff000',
                    sliced: true,
                    selected: true
                }
            ]
        }]
    });
}

/**
 * 后台表单验证
 */
$(function() {
    $('.skin-minimal input').iCheck({
        checkboxClass: 'icheckbox-blue',
        radioClass: 'iradio-blue',
        increaseArea: '20%'
    });

    $("#form-admin-add").Validform({
        tiptype: 2,
        callback: function (form) {
            form[0].submit();
            var index = parent.layer.getFrameIndex(window.name);
            parent.$('.btn-refresh').click();
            parent.layer.close(index);
        }
    });
});
