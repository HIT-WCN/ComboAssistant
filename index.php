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
  <div><h1>套餐助手</h1></div>
  
  <!--标签页-->
  <div>
      <!--页导航-->
      <ul class="nav nav-tabs">
         <li class="active"><a href="#upload_bill" data-toggle="tab" >上传账单</a></li>
         <li class=""><a href="#input_bill" data-toggle="tab" >手动输入</a></li>
      </ul>
      
       <!--页1-->
      <div class="tab-content">
         <div class="tab-pane active" id="upload_bill">
            <form name="send" method="post" action="readhtml.php" enctype="multipart/form-data">
            手机号码：<input type="text" name="phonenumber" ><br/>
             账单日期: <input type="text" name="year">年
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
                </select> 月<br>
                上传账单：<input type="file" name="myfile" />
                <input type="hidden" name="MAX_FILE_SIZE" value="10241024"/>
                <input type="submit" name="upload" value="上传"/>
                <?php
                    if(isset($_POST['upload'])){
                        if(!is_dir("filesaver")){
                            mkdir("filesaver");
                        }
                        $file=$_FILES['myfile'];
                        if($_FILES['myfile']['error']>0){
                            echo '上传错误';
                            switch($_FILES['myfile']['error']){
                                case 1:
                                echo '请上传小于8M的文件';//case:2 echo '超出表单预定的范围';break;
                                break;
                                case 3:
                                echo '只上传了部分文件';
                                break;
                                case 4:
                                echo '没有上传任何文件';
                                break;
                            }
                        }else{
                                if(is_uploaded_file($_FILES['myfile']['tmp_name'])){
                                    $phonenumber=trim($_POST['phonenumber']);
                                    //$str=substr($file['name'],-4,4);
                                    $str='.html';
                                    $path="filesaver/".$phonenumber.$str;//把手机号换成微博账号以区分
                                    if(move_uploaded_file($file['tmp_name'],$path)){
                                    echo "<br>"."上传完成";
                                    }
                                }
                        }
                    }  
                ?> 
            </form>
         </div>
         
         <!--页2-->
         <div class="tab-pane" id="input_bill">
            <form name="input_bill" method="post" action="">
                月均消费：   <input type="text" name="consumption" /> 元<br />
                月通话时长： <input type="text" name="talktime"/> 分钟<br />
                上网流量：   <input type="text" name="net"/> M<br />
                套餐类型：   <input type="radio" name="combotype" value="radiobutton" checked>更多本地通话 
                             <input type="radio" name="combotype" value="radiobutton">更多长途漫游 
                             <input type="radio" name="combotype" value="radiobutton">更多上网流量<br> 
            </form>
         </div>
         
        
        
  </div><!--页内容结束-->
  </div><!--标签页结束-->
</body>
</html>