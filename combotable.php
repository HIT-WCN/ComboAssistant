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
    $type1="��ʹ�÷�";
    $a1=stristr($str,"��ʹ�÷�");
    //echo $a1."<br>";
    $b1=strstr($a1,"Ԫ");
    // echo $b1."<br>";
    $c1=rtrim($a1,$b1);
    //echo $c1."<br>";
    $month_cost1=intval(ltrim($c1,$type1));
    echo $month_cost1."<br>"; 
    
    $result1 = mysql_query("update combo set monthcost= '".$month_cost1."' where id = '".$combo[$i][0]."' ");
    if(!$result1) echo mysql_error($link);
    }
  
    
?>