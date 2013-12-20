<?php
	
	include_once('connect.php');
        //处理每个XML文件,写入数据库
        foreach(glob("CU1/*.xml") 
                as $xmlfile)
        {
            $fp = fopen($xmlfile, "r");  //打开文件
            $xmlparser = xml_parser_create();  //创建解析XML解析器
            $xmldata = fread($fp, filesize($xmlfile));  //读取整个文件
            fclose($fp);  //关闭文件
            //将内容解析到数组
            //$values保存内容 $index保存索引
            xml_parse_into_struct($xmlparser, $xmldata, $values, $index);
            //var_dump($values);
            //var_dump($index);
            //保存元组
            $a = array(
              "name" => "",
              "link" => "",
              "price"=> "",
            );
			//echo $values[($index["套餐名称"]['0'])]["value"];
		//print_r($index);
		//echo $values[$index["名称"]['1']]["value"];
		//echo count($index["名称"]);
		for($i = 0; $i < count($index["名称"]); $i++)
		{
			if(isset($values[($index["名称"][$i])]["value"]))
			{
				$a["name"] = $values[($index["名称"][$i])]["value"];
				$a["link"] = $values[($index["链接"][$i])]["value"];
				$a["price"] = $values[($index["价格"][$i])]["value"];
			
				$name = $a["name"];
				$link = $a["link"];
				$price= $a["price"];
				$price = ltrim($price,"￥");
			mysql_query("insert into cucombo (name,link,price) values('$name','$link','$price')");
           // mysql_query("insert into combo values('$name','$operator','$info')", $con);
           //mysql_query("update  update combo set name='$name' info='$info' ",$con);
			}
		}
        xml_parser_free($xmlparser);
        }
?>