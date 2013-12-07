<?php
/*
 date:2013.11.07
 author:NaQiang
 功能：从html类型的账单文件中提取出有用的信息，存到数据ca的表cmccbill
*/
    session_start();
    header('Content-Type:text/html;charset=GBK');
    require_once('./simple_html_dom/simple_html_dom.php');
    include "index.php";
    $phonenumber=trim($_POST['phonenumber']);
    $year=trim($_POST['year']);
    $month=$_POST['month'];
    $_SESSION[phonenumber]=$phonenumber;
    $_SESSION[year]=$year;
    $_SESSION[month]=$month;

    //查找filesaver文件夹中刚刚上传的文件名
    $aaa=$_SESSION[phonenumber].'.html';
    $billpath='./filesaver/'.$aaa;
    $html=file_get_html($billpath);
    
    $guding=$html->find('table',5)->find('td',1);//固定套餐费
    $a=$guding->plaintext;
    
    $jianmian=$html->find('table',5)->find('td',3);//减免
    $b=$jianmian->plaintext.'<br>';
    
    $daifu=$html->find('table',5)->find('td',5);//代付
    $c=$daifu->plaintext.'<br>';
    
    $yuyin=$html->find('table',6)->find('td',3);//语音通信费
    $d=$yuyin->plaintext.'<br>';
    
    $shangwang=$html->find('table',6)->find('td',5);//上网流量费
    $e=$shangwang->plaintext.'<br>';
    
    $caixin=$shangwang=$html->find('table',6)->find('td',7);//短信彩信费
    $f=$caixin->plaintext.'<br>';
    
    $total=$a+$b+$c+$d+$e+$f;
    
    $db = mysql_connect('localhost', 'root', 'root') or die('Could not connect: ' . mysql_error());
    mysql_select_db('ca') or die('Could not select database');
    
    $sql="INSERT into cmccbill(phonenumber,year,month,guding, jianmian,daifu,yuyin,shangwang,caixin,total) VALUES";
    $sql.="('$_SESSION[phonenumber]','$year','$month','$a','$b','$c','$d','$e','$f','$total')";
    $insert=mysql_query($sql);
    if(!$insert){
        //mysql_free_result($insert);
        mysql_close($db);
        echo "插入记录失败";
        exit;
    }
    echo "<script>alert('账单存储完成,进入分析页面');location.href='analize.php'</script>";//注意一定是单引号";
    mysql_close($db);
?>