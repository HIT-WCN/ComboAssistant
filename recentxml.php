<?php
        set_time_limit(10000);  //允许处理时间
        //连接数据库
        $con = mysql_connect('localhost', 'root', 'root') or 
            die ("connect failed" . mysql_error());
        mysql_select_db("ca") or die(mysql_error());
        mysql_query("set names utf8");
        $operator="CMCC";

        //处理每个XML文件,写入数据库
        foreach(glob("C:\\Users\\NqQiang\\DataScraperWorks\\cmcc_combo_info\\*.xml") 
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
              "info" => "",
            );
			//echo $values[($index["套餐名称"]['0'])]["value"];
		//print_r($index);

		if(isset($values[($index["套餐名称"]['0'])]["value"]))
		{
			$a["name"] = $values[($index["套餐名称"]['0'])]["value"];
			$a["info"] = $values[($index["套餐详情"]['0'])]["value"];
			
			$name = $a["name"];
			$info = $a["info"];
           

			mysql_query("insert into combo (name,info) values('$name','$info')", $con);
           // mysql_query("insert into combo values('$name','$operator','$info')", $con);
           //mysql_query("update  update combo set name='$name' info='$info' ",$con);
		}
        xml_parser_free($xmlparser);
        }
?>