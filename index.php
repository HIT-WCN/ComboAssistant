<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=GBK">
    <link href="./css/upload.css" rel="stylesheet" type="text/css">
    <title>�˵��ϴ�</title>
</head>
<body>
    <div class="div1">
    <h1 id="title">�ײ�����</h1>
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
                            $path="filesaver/".$phonenumber.$str;//���˵�����չ��ǿת��xls�����ܲ���ȫ
                            if(move_uploaded_file($file['tmp_name'],$path)){
                            echo "<br>"."�ϴ����";
                            }
                        }
                }
            }  
        ?> 
    </form>
    </div>
</body>
</html>


