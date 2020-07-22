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
else if($action == "add" && !empty($_POST))
{
    $msg = [
        'msg'=>'',
        'result'=>false
    ];
    //判断关键词为add 并且 post的数据不能为空
    //插入名片
    //如果 人名 和 手机号 同时 存在的话 就说明这个人已经存在了，不能添加
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';

    if(empty($username))
    {
        $msg['msg'] = '用户名不能为空';
        echo json_encode($msg);
        exit;
    }

    if(empty($phone))
    {
        $msg['msg'] = '手机号码不能为空';
        echo json_encode($msg);
        exit;
    }

    //判断是否存在
    $sql = "SELECT * FROM {$pre_}person WHERE username = '$username' AND phone = '$phone'";

    //执行sql语句
    $person = getOne($sql);

    if($person)
    {
        //存在
        $msg['msg'] = '该用户已存在，请重新输入';
        echo json_encode($msg);
        exit;
    }
    else{
        //不存在，插入数据库
        $data = [
            'username'=>$username,
            'phone'=>$phone,
            'content'=>$_POST['content'],
            'cateid'=>$_POST['cateid'],
            'createtime'=>time()
        ];

        //插入数据库
        $insertid = insert("person",$data);

        if($insertid)
        {
            //成功添加
            $msg['msg'] = '添加名片成功';
            $msg['result'] = true;
            echo json_encode($msg);
            exit;
        }else{
            //添加失败
            $msg['msg'] = '添加名片失败';
            echo json_encode($msg);
            exit;
        }
    }

}



?>