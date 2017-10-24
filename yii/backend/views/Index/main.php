<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gbk">
    <link type="text/css" rel="stylesheet" href="http://pic.house365.com/erbu/fgjadmin/css/365baseAdmin.css">
    <link type="text/css" rel="stylesheet" href="http://pic.house365.com/erbu/fgjadmin/css/boxy.css">
    <style>
        .cake{float:left;width:45%}
    </style>
</head>
<body>
<div class="main">
    <div class="message_pad mt10">
        <div class="message_pad_title">房管家经纪人APP下载</div>
        <div class="clearfix p10">
            <div class="pad">
                <img src="http://pic.house365.com/erbu/images/ewm/jjr-ios.png" width="200">
                <p>经纪人iPhone版下载</p>
            </div>
            <div class="pad">
                <img src="http://pic.house365.com/erbu/images/ewm/jjr-android.png" width="200">
                <p>经纪人Android版下载</p>
            </div>
            <div class="pad">
                <img src="http://pic.house365.com/erbu/images/ewm/jjr-admin-android.png" width="200">
                <p>经纪人后台Android版下载</p>
            </div>
            <div class="pad">
                <img src="http://pic.house365.com/erbu/images/ewm/pm-gbb.png" width="200">
                <p>微信扫一扫，联系产品经理</p>
            </div>
        </div>
    </div>
    <div class="pageTitle mt10">
        <div class="title"><span class="iconfont">&#xe600;</span> 数据简报： （月/周）</div>
    </div>
    <div class="clearfix mt10">
        <div class="fl w45">
            <table class="tabone">
                <tr>
                    <th>&nbsp;</th>
                    <td>本月</td>
                    <td>上月</td>
                </tr>
                <?php if($data_by_month[$month]){
                    foreach ($data_by_month[$month] as $_c => $_d) { ?>
                        <tr>
                            <th>新增项目</th>
                            <td><?=$_d['loupan_add_num']?></td>
                            <td><?=$data_by_month[$last_month][$_d['ksm_city']]['loupan_add_num']?></td>
                        </tr>
                        <tr>
                            <th>执行项目</th>
                            <td><?=$_d['loupan_run_num']?></td>
                            <td><?=$data_by_month[$last_month][$_d['ksm_city']]['loupan_run_num']?></td>
                        </tr>
                        <tr>
                            <th>新增经纪人</th>
                            <td><?=$_d['agent_add_num']?></td>
                            <td><?=$data_by_month[$last_month][$_d['ksm_city']]['agent_add_num']?></td>
                        </tr>
                        <tr>
                            <th>活跃经纪人</th>
                            <td><?=$_d['agent_act_num']?></td>
                            <td><?=$data_by_month[$last_month][$_d['ksm_city']]['agent_act_num']?></td>
                        </tr>
                        <tr>
                            <th>新增客户</th>
                            <td><?=$_d['customer_add_num']?></td>
                            <td><?=$data_by_month[$last_month][$_d['ksm_city']]['customer_add_num']?></td>
                        </tr>
                        <tr>
                            <th>新增报备</th>
                            <td><?=$_d['cp_add_num']?></td>
                            <td><?=$data_by_month[$last_month][$_d['ksm_city']]['cp_add_num']?></td>
                        </tr>
                    <?php }} ?>
            </table>
        </div>
        <div class="fr w45">
            <table class="tabone">
                <tr>
                    <th>&nbsp;</th>
                    <td>本周</td>
                    <td>上周</td>
                </tr>
                <?php if($data_by_week[$week]){
                    foreach ($data_by_week[$week] as $_c => $_d) { ?>
                        <tr>
                            <th>新增项目</th>
                            <td><?=$_d['loupan_add_num']?></td>
                            <td><?=$data_by_week[$last_week][$_d['ksw_city']]['loupan_add_num']?></td>
                        </tr>
                        <tr>
                            <th>执行项目</th>
                            <td><?=$_d['loupan_run_num']?></td>
                            <td><?=$data_by_week[$last_week][$_d['ksw_city']]['loupan_run_num']?></td>
                        </tr>
                        <tr>
                            <th>新增经纪人</th>
                            <td><?=$_d['agent_add_num']?></td>
                            <td><?=$data_by_week[$last_week][$_d['ksw_city']]['agent_add_num']?></td>
                        </tr>
                        <tr>
                            <th>活跃经纪人</th>
                            <td><?=$_d['agent_act_num']?></td>
                            <td><?=$data_by_week[$last_week][$_d['ksw_city']]['agent_act_num']?></td>
                        </tr>
                        <tr>
                            <th>新增客户</th>
                            <td><?=$_d['customer_add_num']?></td>
                            <td><?=$data_by_week[$last_week][$_d['ksw_city']]['customer_add_num']?></td>
                        </tr>
                        <tr>
                            <th>新增报备</th>
                            <td><?=$_d['cp_add_num']?></td>
                            <td><?=$data_by_week[$last_week][$_d['ksw_city']]['cp_add_num']?></td>
                        </tr>
                    <?php }} ?>
            </table>
        </div>
    </div>
    <div class="pageTitle mt10">
        <div class="title"><span class="iconfont">&#xe602;</span> 近30天数据展示</div>
    </div>
    <div class="clearfix linetab mt10">
        <button id="1" class="tabon">新增报备</button><button id="2">活跃经纪人</button><button id="3">执行项目</button>
    </div>
    <div id="container">
    </div>
    <div class="pageTitle mt10">
        <div class="title"><span class="iconfont">&#xe601;</span> 分站对比</div>
    </div>
    <div class="clearfix mt10">
        <div class="fl cake" id="cake">
        </div>
        <div class="fl cake" id="cake2">
        </div>
        <div class="fl cake" id="cake3">
        </div>
    </div>
</div>
<script src="http://pic.house365.com/static/jquery/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="/backend/web/js/jquery.boxy.js"></script>
<script type="text/javascript" src="http://pic.house365.com/static/highcharts/highcharts.js"></script>
<script src="http://pic.house365.com/erbu/fgjadmin/js/365base.js"></script>
<script>
    $(function () {
//趋势图

        $('#container').highcharts({ chart: { type: 'spline' }, title: { text: '新增报备统计' }, subtitle: { text: '' }, xAxis: { title: { text: '日期' },categories: [<?php echo $xDay ?>] }, yAxis: { title: { text: '新增报备量' }, labels: { formatter: function() { return this.value  } } }, tooltip: { crosshairs: true, shared: true }, plotOptions: { spline: { marker: { radius: 4, lineColor: '#666666', lineWidth: 1 } } }, series: [{ name: '新增报备数', marker: { symbol: 'square' }, data: [<?php echo $cpNum ?>] }] });
        $("button").click(function(){
            $("#container").html("");
            var num = $(this).attr("id");
            switch(num){
                case "1":
                    $('#container').highcharts({ chart: { type: 'spline' }, title: { text: '新增报备统计' }, subtitle: { text: '' }, xAxis: { title: { text: '日期' },categories: [<?php echo $xDay ?>] }, yAxis: { title: { text: '新增报备量' }, labels: { formatter: function() { return this.value  } } }, tooltip: { crosshairs: true, shared: true }, plotOptions: { spline: { marker: { radius: 4, lineColor: '#666666', lineWidth: 1 } } }, series: [{ name: '新增报备数', marker: { symbol: 'square' }, data: [<?php echo $cpNum ?>] }] });
                    break;
                case "2":
                    $('#container').highcharts({ chart: { type: 'spline' }, title: { text: '活跃经纪人统计' }, subtitle: { text: '' }, xAxis: { title: { text: '日期' },categories: [<?php echo $xDay ?>] }, yAxis: { title: { text: '活跃经纪人数' }, labels: { formatter: function() { return this.value } } }, tooltip: { crosshairs: true, shared: true }, plotOptions: { spline: { marker: { radius: 4, lineColor: '#666666', lineWidth: 1 } } }, series: [{ name: '活跃经纪人数', marker: { symbol: 'square' }, data: [<?php echo $actNum ?>] }] });
                    break;
                default:
                    $('#container').highcharts({ chart: { type: 'spline' }, title: { text: '执行项目统计' }, subtitle: { text: '' }, xAxis: { title: { text: '日期' },categories: [<?php echo $xDay ?>] }, yAxis: { title: { text: '执行项目数' }, labels: { formatter: function() { return this.value } } }, tooltip: { crosshairs: true, shared: true }, plotOptions: { spline: { marker: { radius: 4, lineColor: '#666666', lineWidth: 1 } } }, series: [{ name: '执行项目数', marker: { symbol: 'square' }, data: [<?php echo $runNum ?>] }] });
            }
        });
        $('#cake').highcharts({ chart: { plotBackgroundColor: null, plotBorderWidth: null, plotShadow: false }, title: { text: '新增报备' }, tooltip: { pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>' }, plotOptions: { pie: { allowPointSelect: true, cursor: 'pointer', dataLabels: { enabled: true, color: '#000000', connectorColor: '#000000', format: '<b>{point.name}</b>: {point.percentage:.1f} %' } } }, series: [{ type: 'pie', name: 'Browser share', data: [ <?php foreach($cpNumPercent as $k=>$v){echo "['{$v['city']}', {$v['per']}]".",";}?>['其他',<?=$otherCpPerc?>] ] }] });

        $('#cake2').highcharts({ chart: { plotBackgroundColor: null, plotBorderWidth: null, plotShadow: false }, title: { text: '活跃经纪人' }, tooltip: { pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>' }, plotOptions: { pie: { allowPointSelect: true, cursor: 'pointer', dataLabels: { enabled: true, color: '#000000', connectorColor: '#000000', format: '<b>{point.name}</b>: {point.percentage:.1f} %' } } }, series: [{ type: 'pie', name: 'Browser share', data: [ <?php foreach($actNumPercent as $k=>$v){echo "['{$v['city']}', {$v['per']}]".",";}?>['其他',<?=$otherActPerc?>] ] }] });

        $('#cake3').highcharts({ chart: { plotBackgroundColor: null, plotBorderWidth: null, plotShadow: false }, title: { text: '执行项目' }, tooltip: { pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>' }, plotOptions: { pie: { allowPointSelect: true, cursor: 'pointer', dataLabels: { enabled: true, color: '#000000', connectorColor: '#000000', format: '<b>{point.name}</b>: {point.percentage:.1f} %' } } }, series: [{ type: 'pie', name: 'Browser share', data: [ <?php foreach($runNumPercent as $k=>$v){echo "['{$v['city']}', {$v['per']}]".",";}?>['其他',<?=$otherRunPerc?>] ] }] });
    });
</script>
</body>
</html>