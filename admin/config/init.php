<?php

//建立连接
$conn = mysqli_connect("localhost","root","root");

if(!$conn)
{
    echo "连接数据库失败";
    exit;
}

//连接数据库
mysqli_select_db($conn,"company");

//设置数据库编码
mysqli_query($conn,"SET NAMES UTF8");

//定义一个数据库表前缀
$pre_ = "pre_";

//引入辅助函数
include_once('helpers.php');
?>