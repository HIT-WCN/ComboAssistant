<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk" />
<title>Home</title>
<link href="http://www.see-source.com/bootstrap/css/bootstrap.css" rel="stylesheet">

<script src="http://www.see-source.com/bootstrap/js/jquery.js" type="text/javascript"></script>
<script src="http://www.see-source.com/bootstrap/js/bootstrap-tab.js"  type="text/javascript"></script>
<script src="http://www.see-source.com/bootstrap/js/bootstrap-button.js"  type="text/javascript"></script>
<!-- <script src="http://www.see-source.com/bootstrap/js/bootstrap-.js"  type="text/javascript"></script> -->
</head>

<body style="width:500px; margin:auto;">
  <div><h1>�ײ�����</h1></div>
  
  <!--��ǩҳ-->
  <div>
      <!--ҳ����-->
      <ul class="nav nav-tabs">
         <li class="active"><a href="#upload_bill" data-toggle="tab" >�ϴ��˵�</a></li>
         <li class=""><a href="#input_bill" data-toggle="tab" >�ֶ�����</a></li>
      </ul>
      
       <!--ҳ1-->
      <div class="tab-content">
         <div class="tab-pane active" id="upload_bill">
            <form name="send" method="post" action="readhtml.php" enctype="multipart/form-data">
            �ֻ����룺<input type="text" name="phonenumber" ><br/>
             �˵�����: <input type="text" name="year">��
                <select name="month">
                <option value="1" selected="selected">1</option>
                <option value="2" >2</option>
                <option value="3" >3</option>
                <option value="4" >4</option>
                <option value="5" >5</option>
                <option value="6" >6</option>
                <option value="7" >7</option>
                <option value="8" >8</option>
                <option value="9" >9</option>
                <option value="10" >10</option>
                <option value="11" >11</option>
                <option value="12" >12</option>
                </select> ��<br>
                �ϴ��˵���<input type="file" name="myfile" />
                <input type="hidden" name="MAX_FILE_SIZE" value="10241024"/>
                <input type="submit" name="upload" value="�ϴ�"/>
                <?php
                    if(isset($_POST['upload'])){
                        if(!is_dir("filesaver")){
                            mkdir("filesaver");
                        }
                        $file=$_FILES['myfile'];
                        if($_FILES['myfile']['error']>0){
                            echo '�ϴ�����';
                            switch($_FILES['myfile']['error']){
                                case 1:
                                echo '���ϴ�С��8M���ļ�';//case:2 echo '������Ԥ���ķ�Χ';break;
                                break;
                                case 3:
                                echo 'ֻ�ϴ��˲����ļ�';
                                break;
                                case 4:
                                echo 'û���ϴ��κ��ļ�';
                                break;
                            }
                        }else{
                                if(is_uploaded_file($_FILES['myfile']['tmp_name'])){
                                    $phonenumber=trim($_POST['phonenumber']);
                                    //$str=substr($file['name'],-4,4);
                                    $str='.html';
                                    $path="filesaver/".$phonenumber.$str;//���ֻ��Ż���΢���˺�������
                                    if(move_uploaded_file($file['tmp_name'],$path)){
                                    echo "<br>"."�ϴ����";
                                    }
                                }
                        }
                    }  
                ?> 
            </form>
         </div>
         
         <!--ҳ2-->
         <div class="tab-pane" id="input_bill">
            <form name="input_bill" method="post" action="">
                �¾����ѣ�   <input type="text" name="consumption" /> Ԫ<br />
                ��ͨ��ʱ���� <input type="text" name="talktime"/> ����<br />
                ����������   <input type="text" name="net"/> M<br />
                �ײ����ͣ�   <input type="radio" name="combotype" value="radiobutton" checked>���౾��ͨ�� 
                             <input type="radio" name="combotype" value="radiobutton">���೤;���� 
                             <input type="radio" name="combotype" value="radiobutton">������������<br> 
            </form>
         </div>
         
        
        
  </div><!--ҳ���ݽ���-->
  </div><!--��ǩҳ����-->
</body>
</html>