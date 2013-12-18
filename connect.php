<?php
$host='w.rdc.sae.sina.com.cn:3307';
$db_user=SAE_MYSQL_USER;
$db_pass=SAE_MYSQL_PASS;
$db_name='app_comboassistant';
$timezone="Asia/Shanghai";

$link=mysql_connect($host,$db_user,$db_pass) or die('Could not connect: ' . mysql_error());
mysql_select_db($db_name,$link)  or die('Could not select database');
mysql_query("SET names utf-8");
?>
