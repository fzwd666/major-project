<?php
include_once("Connet.php");
/*$link = mysqli_connect("127.0.0.1", "1234","","webdata");//IP，账户名字，密码，资料库；

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;*/

//$sql="INSERT INTO web (web) values".$_POST["web"].")";//写入资料库

// 检查 URL   
if(!isset($_POST['web']) || $_POST['web'] == ''){    
    echo "输入不能为空！";   
    echo("<br>");
    echo "<a href='input.html'><input type='button' value='返回新增' ></a>";
echo("<br>");
echo("<br>");
echo "<a href='index.html'><input type='button' value='返回初始页面' ></a>";
    exit;   
 }   

    
    
 /* 取得 URL 页面数据 */   
 // 初始化 CURL   
 $ch = curl_init();   
    
 // 设置 URL    
 curl_setopt($ch, CURLOPT_URL, $_POST['web']);    
 // 让 curl_exec() 获取的信息以数据流的形式返回，而不是直接输出。   
 curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);   
 // 在发起连接前等待的时间，如果设置为0，则不等待   
 curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 0);   
 // 设置 CURL 最长执行的秒数   
 curl_setopt ($ch, CURLOPT_TIMEOUT, 30);   
// 防止乱码
 curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept-Encoding: gzip, deflate'));
 curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate'); 


 // 尝试取得文件内容   
 $store = curl_exec ($ch);   
    
    
 // 检查文件是否正确取得   
 if (curl_errno($ch)){   
    echo "无法取得 URL 数据"; 
    echo("<br>");
    echo "<a href='input.html'><input type='button' value='返回新增' ></a>";
echo("<br>");
echo("<br>");
echo "<a href='index.html'><input type='button' value='返回初始页面' ></a>";  
    //echo curl_error($ch);/*显示错误信息*/   
    exit;   
 }   
  
 // 关闭 CURL   
 curl_close($ch);   
    
    
 // 解析 HTML 的 <head> 区段   
 preg_match("/<head.*>(.*)<\/head>/smUi",$store, $htmlHeaders);   
 if(!count($htmlHeaders)){   
    echo "无法解析数据中的 <head> 区段";   
    echo("<br>");
    echo "<a href='input.html'><input type='button' value='返回新增' ></a>";
echo("<br>");
echo("<br>");
echo "<a href='index.html'><input type='button' value='返回初始页面' ></a>";
    exit;   
 } 

     
 // 取得 <head> 中 meta 设置的编码格式   
 if(preg_match("/<meta[^>]*http-equiv[^>]*charset=(.*)(\"|')/Ui",$htmlHeaders[1], $results)){   
    $charset =  $results[1];   
 }else{    
    $charset = "None";   
 }   
    
 // 取得 <title> 中的文字    
 if(preg_match("/<title>(.*)<\/title>/Ui",$htmlHeaders[1], $htmlTitles)){   
    if(!count($htmlTitles)){   
        echo "无法解析 <title> 的内容";  
        echo("<br>");
    echo "<a href='input.html'><input type='button' value='返回新增' ></a>";
echo("<br>");
echo("<br>");
echo "<a href='index.html'><input type='button' value='返回初始页面' ></a>"; 
        exit;   
    }   
       
    // 将  <title> 的文字编码格式转成 UTF-8   
    if($charset == "None"){   
        $title=$htmlTitles[1];   
    }else{   
        $title=iconv($charset, "UTF-8", $htmlTitles[1]);   
    }   
    echo $title; 
    echo("<br>");
    $etime=date('Y-m-d h:i:s', time());//获取程序执行结束的时间
    echo $etime;
    $sql="INSERT INTO web (web,webAbout,webtime) values (?,?,?)";
    $stmt=$link->prepare($sql);
    $stmt->bind_param('sss',$_POST['web'],$title,$etime);
    if(!$stmt->execute())
    {
        echo"ERROR:".$stmt->errorInfo();

    }
    //$sql="INSERT INTO web (web,webAbout,webtime) values ('$_POST[web]','$title','$etime') ";
    //$link->query($sql);  
 } 



//


/*if(!mysqli_query($link,$sql))//版本原因，反转
{
    die('Error: ' . mysqli_error());
}*/
echo"<br>";
echo "1 record added";
echo("<br>");
mysqli_close($link);
echo "<a href='input.html'><input type='button' value='返回新增' ></a>";
echo("<br>");
echo("<br>");
echo "<a href='index.html'><input type='button' value='返回初始页面' ></a>";
?>