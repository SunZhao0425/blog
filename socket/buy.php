<?php
/**
 * Created by PhpStorm.
 * User: hongyan
 * Date: 2019/2/1
 * Time: 16:30
 */

// 模拟秒杀

//include_once dirname(__FILE__) . '/RedisUtil.php';
include_once dirname(__FILE__) . './Redis.php';


$config = array(
    'host' => '127.0.0.1',  // redis 服务器地址
    'port' => 6379,        // redis 服务器端口号
    'timeOut' => 10,        // redis 客户端连接超时时间
    'password' => '123456'  // redis 客户端连接密码
);
$redisUtil = new RedisUtil($config);

// 此处假设有10000个用户同时来抢购商品，注意：我们的库存只有500个
// 预期情况是：500个库存都被抢光，且没有出现超卖现象

$users = 10000;

// 待秒杀的商品编号
$goodsId = 1000001;

for ($i=1; $i<=$users; $i++) {
    // 从队列左侧弹出一个元素，如果有值，说明还有剩余库存
    $rs = $redisUtil->popLeft('stock_'.$goodsId);
    $num = sprintf('%05s', $i);
    if (!$rs) {
        echo '售罄了！用户'.$num;
        echo '<br/>';
        // 输出最终抢购成功的用户数量
        echo '最终抢购人数：'.$redisUtil->getListSize('users').' 人';
        echo '<br/>';
        echo '<br/>';
        return;
    } else {
        // 将抢购成功的用户存入队列
        $redisUtil->setLeftList('users',$num);
        echo '恭喜您！用户'.$num;
    }
    echo '<br/>';
}

