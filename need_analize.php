<?php
    include_once('connect.php');
    $result=mysql_query("select * from combo"); if(!$result) echo mysql_errno();
    $i=0;
    while($row = mysql_fetch_array($result))
    {
               $combo[$i]=array($row['id']/*0*/,$row['name']/*1*/,$row['info']/*2*/,$row['monthcost']/*3*/,
                                $row['talktime']/*4*/,$row['talkprice']/*5*/,$row['net']/*6*/,$row['netprice']/*7*/
                                ,$row['link']);//则combo[0][1]表示第一个套餐记录中的name信息
               $i++;
    }
    $combonum=mysql_num_rows($result);
    /*获取主页表单数据*/
    $consumption=$_POST['consumption'];
    $talktime=$_POST['talktime'];
    $net=$_POST['net'];
    $mincost=$consumption*0.8;
    $maxcost=$consumption*1.2;
    $standard_message_price=floatval(0.10);
    //echo "<br>".$standard_talk_price."<br>".$standard_net_price."<br>".$standard_message_price."<br>";   
 
    
    //策略：计算每种套餐按照用户需求所需花费
    $outside_combo_cost=array();//需求超出套餐提供范围，则根据超出规则计费
    $total_cost=array();//套餐包月费用+超出套餐费用
    for($j=0;$j<$combonum;$j++)
    {
        $outside_combo_cost[$j]=0;
        $total_cost[$j]=0;
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
    <div style="margin: 0 10px 10px 0px;">
    <p>您的需求为：</p>
        <table class="table-bordered ">
            <tr class="success">
            <td><p>月均消费</p></td>
            <td><p>月通话时长</p></td>
            <td><p>上网流量</p></td>
            </tr>
            
            <tr class="warning">
            <td><?php echo $consumption."元"?></td>
            <td><?php echo $talktime."分钟"?></td>
            <td><?php echo $net."M"?></td>
            </tr>
        
        </table>
    </div >   
    <div style="margin-top: 30px;;">
    <table class="table  table-hover table-bordered" >
    <p>移动套餐</p>
    <tr class="success">
    <td style="width: auto;"><p>序号</p></td>  <td><p>套餐名称</p></td> <td><p style="text-align: center;">详细信息</p></td>    <td><p>套餐预计花费</p></td>
    <td><p>链接</p></td>
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
                $temp4=$combo[$i][8];
                
                $total_cost[$i]=$total_cost[$j];
                $combo[$i][1]=$combo[$j][1];
                $combo[$i][2]=$combo[$j][2];
                $combo[$i][8]=$combo[$j][8];
                
                $total_cost[$j]=$temp3;
                $combo[$j][1]=$temp1;
                $combo[$j][2]=$temp2;
                $combo[$j][8]=$temp4;
            }
        }
    }
    for($i=0;$i<7;$i++)
    {
        
    ?>  
            <tr class="warning">
            <td><?php echo ++$count;?></td>
            <td><?php echo $combo[$i][1];?></td>
            <td><?php echo $combo[$i][2];?></td>
            <td><?php echo $total_cost[$i];?></td>
            <td style="vertical-align: middle;"><a href="<?php echo  $combo[$i][8]?>" target="_blank"><img src="image/car.png" /></a></td>
            </tr>
   
   
   
    <?php        
        
    }
    ?>
	<script src="http://tjs.sjs.sinajs.cn/open/thirdpart/js/frame/appclient.js" type="text/javascript" charset="utf-8"></script>
    </table>
    
    </div>
    <div style="width:8cm; height:3cm;border:0 solid; position: absolute; left: 330px; top:350px;">
    <p style="text-align: center;">提示信息</p>
    <p style="margin-left: 20px;">
    <?php if($total_cost[0]>$consumption)
            echo "您目前使用的套餐已经很好，以下我们只是给出参考";
         else 
            echo "您目前话费够买房子了，还有更好的套餐供你选择呦";
    ?>
    </p>
    </div>
    <!--div>
    <iframe src="http://s.10010.com/SearchApp/chseFeeSetList/init" width="500" height="800" ></iframe>
    </div-->
    <div>
    <p>联通套餐</p>
    <table class="table  table-hover table-bordered">
    <?php
        $result2=mysql_query("select * from cucombo"); if(!$result2) echo mysql_errno();
        $m=0;
        while($row2 = mysql_fetch_array($result2))
        {
                   $cucombo[$m]=array($row2['name']/*0*/,$row2['link']/*1*/,$row2['price']/*2*/);
                   $m++;
        }
        $combonum2=mysql_num_rows($result2);
        for($m=0;$m<$combonum2;$m++)
        {
            if($cucombo[$m][2]<$maxcost)
            {
        ?>
            <tr class="warning">
                <td><?php echo $cucombo[$m][0];?></td>
                <td> <a href="<?php echo $cucombo[$m][1];?>" target="_blank"><img src="image/car.png"/></a></td>    
            </tr>  
        <?php
            }    
        }
        ?>
    
    
    </table>
    </div>