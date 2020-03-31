<?php
include_once("Connet.php");
if(!isset($_POST['search'])||trim($_POST['search']==''))
{
    echo"输入不得为空！";
    echo"<br>";
}
else
{
    echo "关键字：";
    echo $_POST['search'];
    echo"<br>";
    echo"<br>";
$sql="SELECT * from web WHERE webAbout LIKE '%$_POST[search]%'";
if($result=$link->query($sql))
{
    $num=0;
    while($row=$result->fetch_row())
    {
        printf("编号：%d   网址：%s   ",$row[0],$row[1]);
        echo"<br>";
        printf("关于：%s  ",$row[2]);
        echo"<br>";
        printf("时间：%s  ",$row[3]);
        echo"<br>";
        echo "<a href=$row[1] ><input type='button' value='进入' ></a>";
        echo"<br>";
       //echo" <iframe src=$row[1] width='400' height='400'></iframe>";
        echo("<br>");
        $num+=1;
    }
    if($num==0)
    {
        printf("资料库没有相关资料！");
        echo "<br>";
    }
    $result->close();
}
}

mysqli_close($link);
echo "<a href='search.html'><input type='button' value='返回查询' ></a>";
echo("<br>");
echo("<br>");
echo "<a href='index.html'><input type='button' value='返回初始页面' ></a>";
//echo("<input type='button' onclick='btn1()' value='点击跳转'>");

/*echo("<script type='text/javascript'>

window.location.replace('http://localhost/project/');

</script>");*/
//header("Location:https://www.baidu.com");
?>