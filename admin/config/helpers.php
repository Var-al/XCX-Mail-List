<?php

// 声明头部信息 防止程序乱码
header("Content-Type:text/html;charset=utf-8");


/**
 * 获取全部数据
 */
function getAll($sql){

    // 获取全局变量$conn
    global $conn;

    // 执行sql语句
    $res = mysqli_query($conn,$sql);


    // 获取全部数据，返回一个关联数组
    $result = [];
    while($row = mysqli_fetch_assoc($res)){

        $result[] =  $row;
    }

    return $result;

}

/**
 * 获取单条数据
 */
function getOne($sql){

    global $conn;

    // 执行sql语句
    $res = mysqli_query($conn,$sql);


    // 返回一维关联数组，可以直接返回
    return @mysqli_fetch_assoc($res);

}

/** 
 * 提醒函数
 */
function showMsg($msg="",$url=""){

    // 声明头部 防止乱码
    header("Content-Type:text/html;charset=utf-8");

    if(empty($url)){

        $header = "<script>alert('$msg');history.go(-1);</script>";

    }else{

        $header = "<script>alert('$msg');location.href='$url';</script>";
    }
    
    echo $header;
    exit;

}

/**
 * 生成随机数的函数
 * length 生成的长度
*/
function randomkeys($length=5){

    $pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';
    $key = "";
    for($i=0;$i<$length;$i++){

        $key .= $pattern{mt_rand(0,35)};
    };
    return $key;
}


/**
 * 文件上传
 * $input 为表单当中的input的名字
 * $path 上传的路径地址，注意相对地址是以原调用函数的文件来定义的
 * $size 文件上传的限制大小
 * $extlist 用于判断文件是否符合文件类型的数组
*/

function uploads($input,$path="assets/uploads/",$size=123456789,$extlist=['jpg','png','jpeg','gif']){

    // 获取到上传文件的数组信息
    $file = $_FILES[$input];

    // 判断文件的error错误信息
    if($file['error'] > 0){

        switch($file['error']){

            case 1 :
                showMsg("上传文件超出了php.ini配置文件限制的大小");
            break;
            case 2 :
                showMsg("上传文件超出了表单提交设置的大小");
            break;
            case 3 :
                showMsg("网络中断，文件上传失败");
            break;
            case 4 :
                showMsg("无文件上传");
            break;
            default:
            showMsg("其他错误");
        }
    }
    
    // 判断文件是否超出我们设置的大小限制
    if($file['size'] > $size){
        showMsg("文件太大了");
        exit;
    }
    

    /**
    * 判断上传文件的类型
    */

    // 先获取上传文件的类型
    $ext = pathinfo($file['name'],PATHINFO_EXTENSION);

    // 判断上传文件类型是否在定义的$extlist数组里面
    $result = in_array($ext,$extlist);
    if(!$result){

        showMsg("属于被限制文件类型，不能上传");
        exit;
    }

    // 不能让文件名重名，所以用时间来命名
    $time = date("YmdHis");
    
    // 调用生成随机数的$random函数
    $key = randomkeys(5);

    // 组装成完整文件路径
    $path = $path.$time.$key.".".$ext;
    
    // 转码
    $path = iconv("utf-8","gbk",$path);

    // 通过上传文件临时存放地址来判断文件是否通过http post正规上传的
    if(is_uploaded_file($file['tmp_name'])){

        // 将存放在临时地址的上传文件移动到指定位置
        $result = move_uploaded_file($file["tmp_name"],$path);

        if($result){

            return $path;
        }else{

            return false;
        }
    }else{
        showMsg("非法上传");
        exit;
    }


}


/**
 * 数据库插入数据方法
 * $table 数据表的名称，用于拼接
 * $data 需要存放到数据库的一维数组
 */
function insert($table,$data){

    // 获取全局变量
    global $conn;
    global $pre_;

    // 将数据表名称拼接成完整路径
    $table = "{$pre_}$table";

    // 提取数组的索引来作为数据库字段
    // 将数组当中的索引提取到一个新的数组
    $keys = array_keys($data);

    // 将数组转化为字符串
    $str = "`".implode("`,`",$keys)."`";
    $value = "'".implode("','",$data)."'";

    // 插入数据库
    $sql = "insert into $table($str)values($value)";

  
    // 执行sql语句
    $res = mysqli_query($conn,$sql);


    // 插入成功则返回插入的主键id值，否则返回0
    return mysqli_insert_id($conn);
}

/**
 * 数据库更新方法
 * $table 表名
 * $data 更新的数组
 * $where 条件
 * 
 */
function update($table,$data,$where){
    // 获取全局变量
    global $conn;
    global $pre_;

    // 拼接上完整表名
    $table = $pre_.$table;

    $str = "";
    // foreach 循环拼接上字段
    foreach($data as $key=>$item){

        $str .= "`$key`='$item',";
    }

    // 删除两边多余的 ，字符
    $str = trim($str, ",");

    // update 数据表名 set 字段1=修改后的值1,字段2=修改后的值2 where条件 
    $sql = "update $table set $str where $where"; 


    // 执行sql语句
    mysqli_query($conn,$sql);

    // 返回影响的行数，作为判断条件
    return mysqli_affected_rows($conn);
}



//得到当前网址
function get_url(){
	$str = $_SERVER['PHP_SELF'].'?';
	if($_GET){
		foreach ($_GET as $k=>$v){  //$_GET['page']
			if($k!='page'){
				$str .= $k.'='.$v.'&';
			}
		}
	}
	return $str;
}


//分页函数
/**
 *@pargam $current	当前页
 *@pargam $count	记录总数
 *@pargam $limit	每页显示多少条
 *@pargam $size		中间显示多少条
 *@pargam $class	样式
*/
function page($current,$count,$limit,$size,$class='sabrosus'){
	$str='';
	if($count>$limit){
		$pages = ceil($count/$limit);//算出总页数
		$url = get_url();//获取当前页面的URL地址（包含参数）
		
		$str.='<div class="'.$class.'">';
		//开始
		if($current==1){
			$str.='<span class="disabled">首&nbsp;&nbsp;页</span>';
			$str.='<span class="disabled">  &lt;上一页 </span>';
		}else{
			$str.='<a href="'.$url.'page=1">首&nbsp;&nbsp;页 </a>';
			$str.='<a href="'.$url.'page='.($current-1).'">  &lt;上一页 </a>';
		}
		//中间
		//判断得出star与end
	    
		 if($current<=floor($size/2)){ //情况1
			$star=1;
			$end=$pages >$size ? $size : $pages; //看看他两谁小，取谁的
		 }else if($current>=$pages - floor($size/2)){ // 情况2
				 
			$star=$pages-$size+1<=0?1:$pages-$size+1; //避免出现负数
		
			$end=$pages;
		 }else{ //情况3
		 
			$d=floor($size/2);
			$star=$current-$d;
			$end=$current+$d;
		 }
	
		for($i=$star;$i<=$end;$i++){
			if($i==$current){
				$str.='<span class="current">'.$i.'</span>';	
			}else{
				$str.='<a href="'.$url.'page='.$i.'">'.$i.'</a>';
			}
		}
		//最后
		if($pages==$current){
			$str .='<span class="disabled">  下一页&gt; </span>';
			$str.='<span class="disabled">尾&nbsp;&nbsp;页  </span>';
		}else{
			$str.='<a href="'.$url.'page='.($current+1).'">下一页&gt; </a>';
			$str.='<a href="'.$url.'page='.$pages.'">尾&nbsp;&nbsp;页 </a>';
		}
		$str.='</div>';
	}
	
	return $str;
}



/**
 * 删除函数
 * $table  表名
 * $where 条件
 */

 function delete($table,$where){

    // 获取全局变量
    global $conn;
    global $pre_;

    // 拼接完整表名
    $table = $pre_.$table;
    

    // sql语句
    $sql = "delete from $table where $where";

    // var_dump($sql);
    // exit;

    // 执行删除
    $result = mysqli_query($conn,$sql);

    if(!$result){

        alert("找不到删除的图片");
        exit;
    }
    
    // 返回数据库受影响的行数
    return  mysqli_affected_rows($conn);
 }



/**
 * 二维数组转化一维数组
 * $arr 二维数组
 * $str 二维数组里面需要转化的值
 */
function arrChange($arr,$str){

    $res = [];
    foreach($arr as $item){

        if(isset($item[$str])){

            $res[] = $item[$str];
        }
    }

    return $res;

}
















?>
