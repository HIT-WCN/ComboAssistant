<?php
/*
 date:2013.11.07
 author:NaQiang
 ���ܣ���html���͵��˵��ļ�����ȡ�����õ���Ϣ���浽����ca�ı�cmccbill
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

    //����filesaver�ļ����иո��ϴ����ļ���
    $aaa=$_SESSION[phonenumber].'.html';
    $billpath='./filesaver/'.$aaa;
    $html=file_get_html($billpath);
    
    $guding=$html->find('table',5)->find('td',1);//�̶��ײͷ�
    $a=$guding->plaintext;
    
    $jianmian=$html->find('table',5)->find('td',3);//����
    $b=$jianmian->plaintext.'<br>';
    
    $daifu=$html->find('table',5)->find('td',5);//����
    $c=$daifu->plaintext.'<br>';
    
    $yuyin=$html->find('table',6)->find('td',3);//����ͨ�ŷ�
    $d=$yuyin->plaintext.'<br>';
    
    $shangwang=$html->find('table',6)->find('td',5);//����������
    $e=$shangwang->plaintext.'<br>';
    
    $caixin=$shangwang=$html->find('table',6)->find('td',7);//���Ų��ŷ�
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
        echo "�����¼ʧ��";
        exit;
    }
    echo "<script>alert('�˵��洢���,�������ҳ��');location.href='analize.php'</script>";//ע��һ���ǵ�����";
    mysql_close($db);
?>