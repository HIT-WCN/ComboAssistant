<?php
    include_once('connect.php');
    $result=mysql_query("select * from combo"); if(!$result) echo mysql_errno();
    $i=0;
    while($row = mysql_fetch_array($result))
    {
               $combo[$i]=array($row['id']/*0*/,$row['name']/*1*/,$row['info']/*2*/,$row['monthcost']/*3*/,
                                $row['talktime']/*4*/,$row['talkprice']/*5*/,$row['net']/*6*/,$row['netprice']/*7*/);//��combo[0][1]��ʾ��һ���ײͼ�¼�е�name��Ϣ
               $i++;
    }
    $combonum=mysql_num_rows($result);
    /*��ȡ��ҳ������*/
    $consumption=$_POST['consumption'];
    $talktime=$_POST['talktime'];
    $net=$_POST['net'];
    //echo $consumption."<br>".$talktime."<br>".$net;
    //���ײ�����$outside_combo_cost[$i]��ʵ���¾����ѱȽ�
    $standard_message_price=floatval(0.10);
    //echo "<br>".$standard_talk_price."<br>".$standard_net_price."<br>".$standard_message_price."<br>";   
 
    
    //���ԣ�����ÿ���ײͰ����û��������軨��
    $outside_combo_cost=array();//���󳬳��ײ��ṩ��Χ������ݳ�������Ʒ�
    $total_cost=array();//�ײͰ��·���+�����ײͷ���
    for($j=0;$j<$combonum;$j++)
    {
        $outside_combo_cost[$j]=0;
        $total_cost[$i]=0;
    }
    
    for($i=0;$i<$combonum;$i++)
    {
        
        if($talktime>$combo[$i][4])
        {
                $outside_combo_cost[$i]=floatval($outside_combo_cost[$i]+($talktime-$combo[$i][4])*$combo[$i][5]);       
        }
        
        if($net>$combo[$i][6])
        {
                $outside_combo_cost[$i]=floatval($outside_combo_cost[$i]+($net-$combo[$i][6]*$combo[$i][7]));
        }
        $total_cost[$i]=$outside_combo_cost[$i]+$combo[$i][3];
    }
    ?>
    <p>��������Ϊ��</p>
        <table class="table-bordered">
            <tr class="success">
            <td><p>�¾�����</p></td>
            <td><p>��ͨ��ʱ��</p></td>
            <td><p>��������</p></td>
            </tr>
            
            <tr class="warning">
            <td><?php echo $consumption."Ԫ"?></td>
            <td><?php echo $talktime."����"?></td>
            <td><?php echo $net."M"?></td>
            </tr>
        
        </table>
    <p>Ϊ��ѡ����ײ�����:</p>
    <table class="table  table-hover table-bordered">
    <tr class="success">
    <td width="10px"><p>���</p></td>  <td><p>�ײ�����</p></td> <td><p>��ϸ��Ϣ</p></td>    <td><p>�ײ�Ԥ�ƻ���</p></td>
    </tr>
    <?php
    $count=0;
    for($i=0;$i<$combonum;$i++)
    {
        for($j=$i+1;$j<$combonum;$j++)
        {
            if($total_cost[$j] <= $total_cost[$i])
            {
                $temp3=$total_cost[$i];
                $temp1=$combo[$i][1];
                $temp2=$combo[$i][2];
                
                $total_cost[$i]=$total_cost[$j];
                $combo[$i][1]=$combo[$j][1];
                $combo[$i][2]=$combo[$j][2];
                
                $total_cost[$j]=$temp3;
                $combo[$j][1]=$temp1;
                $combo[$j][2]=$temp2;
            }
        }
    }
    for($i=0;$i<$combonum;$i++)
    {
        
    ?>  
            <tr class="warning">
            <td><?php echo ++$count;?></td>
            <td><?php echo $combo[$i][1];?></td>
            <td><?php echo $combo[$i][2];?></td>
            <td><?php echo $total_cost[$i];?></td>
            </tr>
   
   
   
    <?php        
        
    }
    ?>
    </table>