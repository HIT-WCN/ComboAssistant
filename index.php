<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=GBK">
    <link href="./css/upload.css" rel="stylesheet" type="text/css">
    <title>账单上传</title>
</head>
<body>
    <div class="div1">
    <h1 id="title">套餐助手</h1>
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
                            $path="filesaver/".$phonenumber.$str;//把账单的扩展名强转成xls，可能不安全
                            if(move_uploaded_file($file['tmp_name'],$path)){
                            echo "<br>"."上传完成";
                            }
                        }
                }
            }  
        ?> 
    </form>
    </div>
</body>
</html>


