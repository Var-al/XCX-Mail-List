<?php
//引入封装的数据库链接文件
include_once('config/init.php');

//先接收参数
$action = isset($_GET['action']) ? $_GET['action'] : '';


//获取分类列表
if($action == "catelist")
{
    $sql = "SELECT * FROM {$pre_}cate";
    $catelist = getAll($sql);

    //转换成json
    echo json_encode($catelist);
    exit;
}
else if($action == "personlist")
{
    //查看所有名片信息
    $cateid = isset($_GET['cateid']) ? $_GET['cateid'] : 0;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    // 1 0,9
    // 2 10,19
    // 3 20,29
    //(page-1)10

    $where = 1;

    //按照分类来进行搜索
    if($cateid > 0)
    {
        $where = "cateid = $cateid";
    }

    //按用户名来搜索 模糊搜索

    //计算偏移量
    $limit = 10;
    $start = ($page-1)*$limit;

    $sql = "SELECT * FROM {$pre_}person WHERE $where LIMIT $start,$limit";
    $personlist = getAll($sql);

    echo json_encode($personlist);
    exit;
}



?>