<?php
    include_once('connect.php');
    $result=mysql_query("select * from combo");
    $i=0;
    //$combo=array();//���Ƕ�ά����ɣ�$combo[0]Ϊ��һ���ײͼ�¼������
    while($row = mysql_fetch_array($result))
    {
               $combo[$i]=array($row['id'],$row['name'],$row['info']);//��combo[0][1]��ʾ��һ���ײͼ�¼�е�name��Ϣ
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
    $a=stristr($str,"����ͨ����");
    echo $a."<br>";
    $b=stristr($str,"Ԫ/����");
    echo $b."<br>";
    $c=rtrim($a,$b);
    echo $c."<br>";
    $d=ltrim($c,"����ͨ����");
    echo $d."<br>";
    */
    $a1=stristr($str,"��ʹ�÷�");
    $b1=strstr($a1,"Ԫ");
    $c1=rtrim($a1,$b1);
    $month_cost1=intval(ltrim($c1,"��ʹ�÷�"));
    //echo $month_cost1."<br>";
    
    $a2=stristr($str,"��");
    $b2=strstr($a2,"����");
    $c2=rtrim($a2,$b2);
    echo $c2."<br>";
    
    $result1 = mysql_query("update combo set monthcost= '".$month_cost1."' where id = '".$combo[$i][0]."' ");
    if(!$result1) echo mysql_error($link);
    }
  
    
?>