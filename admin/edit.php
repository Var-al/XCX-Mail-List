<?php
//引入封装的数据库链接文件
include_once('config/init.php');

//先接收参数
$action = isset($_GET['action']) ? $_GET['action'] : '';


//获取名片的详细信息
if($action == "info")
{
    $msg = ['msg'=>'','result'=>false];

    $id = isset($_GET['id']) ? $_GET['id'] : 0;

    //根据id查询数据出来
    $sql = "SELECT * FROM {$pre_}person WHERE id = $id";
    $info = getOne($sql);

    if(!$info)
    {
        $msg['msg'] = '这个人不存在';
        echo json_encode($msg);
        exit;
    }else{
        $msg['msg'] = $info;
        $msg['result'] = true;
        echo json_encode($msg);
        exit;
    }
}
else if($action == "edit" && !empty($_POST))
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
    $id = isset($_POST['id']) ? $_POST['id'] : '';

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
    $sql = "SELECT * FROM {$pre_}person WHERE username = '$username' AND phone = '$phone' AND id != $id";

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
        ];

        //更新数据库
        $affectid = update("person",$data,"id = $id");

        if($affectid)
        {
            //成功修改
            $msg['msg'] = '修改名片成功';
            $msg['result'] = true;
            echo json_encode($msg);
            exit;
        }else{
            //修改失败
            $msg['msg'] = '修改名片失败';
            echo json_encode($msg);
            exit;
        }
    }

}



?>