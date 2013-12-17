<?php
    include_once('connect.php');
    $result=mysql_query("select * from combo");
    $i=0;
    //$combo=array();//算是二维数组吧，$combo[0]为第一条套餐记录的详情
    while($row = mysql_fetch_array($result))
    {
               $combo[$i]=array($row['id'],$row['name'],$row['info']);//则combo[0][1]表示第一个套餐记录中的name信息
               $i++;
    }
    //print_r($combo);
    $combonum=mysql_num_rows($result);
    for($i=0;$i<$combonum;$i++)
    {
    echo " >>>>>>>>>>".$i."<br>";
    $str=$combo[$i][2];
    echo $str."<br>";
    /*
    $a=stristr($str,"基本通话费");
    echo $a."<br>";
    $b=stristr($str,"元/分钟");
    echo $b."<br>";
    $c=rtrim($a,$b);
    echo $c."<br>";
    $d=ltrim($c,"基本通话费");
    echo $d."<br>";
    */
    $a1=stristr($str,"月使用费");
    $b1=strstr($a1,"元");
    $c1=rtrim($a1,$b1);
    $month_cost1=intval(ltrim($c1,"月使用费"));
    //echo $month_cost1."<br>";
    
    $a2=stristr($str,"含");
    $b2=strstr($a2,"分钟");
    $c2=rtrim($a2,$b2);
    echo $c2."<br>";
    
    $result1 = mysql_query("update combo set monthcost= '".$month_cost1."' where id = '".$combo[$i][0]."' ");
    if(!$result1) echo mysql_error($link);
    }
  
    
?>