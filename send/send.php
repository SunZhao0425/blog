<?php
/**
 * Created by PhpStorm.
 * User: hongyan
 * Date: 2019/2/1
 * Time: 18:16
 */

    header('Content-Type:text/event-stream');//通知浏览器开启事件推送功能
    header('Cache-Control:no-cache');//告诉浏览器当前页面不进行缓存

    //$time = date('r');
    //echo "data: The server time is: {$time}\n\n";

    $mysqli = new MySQLi('127.0.0.1','root','123456','lbxr');
    $sql = "select * from `eq_status` where sn='192.1.0.11' order by id DESC limit 1,1 ";
    $result = $mysqli->query($sql);
    while($row = $result->fetch_assoc()){
        $time = $row['id'];
        echo "data: The server time is: {$time}\n\n";
    }

    ob_flush();//刷新
    flush();//刷新
?>