<?php
include_once('connect.php');
$result=mysql_query("select * from cmccbill");
    //$result=mysql_query("select * from cmccbill where username=session('username')");
    $value=array();
    $name=array();
    while($row = mysql_fetch_array($result)){
        $value[0]=intval($row['guding']);
        $value[1]=intval($row['jianmian']);
        $value[2]=intval($row['daifu']);
        $value[3]=intval($row['yuyin']);
        $value[4]=intval($row['shangwang']);
        $value[5]=intval($row['caixin']);
    }
    $name[0]="固定套餐";
    $name[1]="减免金额";
    $name[2]="代付金额";
    $name[3]="语音通话费";
    $name[4]="上网流量费";
    $name[5]="短信彩信费";
    for($i=0;$i<6;$i++){
    $arrs[$i]=array(
        $name[$i],$value[$i]
    );
    }
    //print_r($arrs);
    $data = json_encode($arrs); 
   // print_r($data); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>移动账单饼状图</title>
<link rel="stylesheet" type="text/css" href="../css/main.css" />
<style type="text/css">
.demo{width:600px; margin:10px auto}
.myclass{border:1px solid #000; background:#ccc; color:#fff}
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="js/highcharts.js"></script>
<script type="text/javascript" src="js/modules/exporting.js"></script>
<script type="text/javascript">
var chart;
$(function() {
	chart = new Highcharts.Chart({
        chart: {
            renderTo: 'chart_pie',  //饼状图关联html元素id值
			defaultSeriesType: 'pie', //默认图表类型为饼状图
			plotBackgroundColor: '#ffc',  //设置图表区背景色
            plotShadow: true   //设置阴影
        },
        title: {
            text: '搜索引擎统计分析'  //图表标题
        },
		credits: {
			text: 'helloweba.com'
		},
        tooltip: {
            formatter: function() { //鼠标滑向图像提示框的格式化提示信息
                return '<b>' + this.point.name + '</b>: ' + twoDecimal(this.percentage) + ' %';
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true, //允许选中，点击选中的扇形区可以分离出来显示
                cursor: 'pointer',  //当鼠标指向扇形区时变为手型（可点击）
				//showInLegend: true,  //如果要显示图例，可将该项设置为true
                dataLabels: {
                    enabled: true,  //设置数据标签可见，即显示每个扇形区对应的数据
                    color: '#000000',  //数据显示颜色
                    connectorColor: '#999',  //设置数据域扇形区的连接线的颜色
					style:{
						fontSize: '12px'  //数据显示的大小
					},
                    formatter: function() { //格式化数据
                        return '<b>' + this.point.name + '</b>: ' + twoDecimal(this.percentage) + ' %';
					    //return '<b>' + this.point.name + '</b>: ' + this.y ;
                    }
                }
            }
        },
        series: [{ //数据列
            name: 'search engine',
			data: <?php echo $data;?> //核心数据列来源于php读取的数据并解析成JSON
        }]
    });
});
//保留2位小数
function twoDecimal(x) {
    var f_x = parseFloat(x);
    if (isNaN(f_x)) {
        alert('错误的参数');
        return false;
    }
    var f_x = Math.round(x * 100) / 100;
    var s_x = f_x.toString();
    var pos_decimal = s_x.indexOf('.');
    if (pos_decimal < 0) {
        pos_decimal = s_x.length;
        s_x += '.';
    }
    while (s_x.length <= pos_decimal + 2) {
        s_x += '0';
    }
    return s_x;
}
</script>
</head>
<div id="chart_pie" class="demo"></div>

<body>

<br/>

</body>
</html>
