<?php
namespace app\admin\controller;


use think\Controller;
use think\log\driver\Socket;



class Index extends Controller
{
    public function index()
    {
        return view( 'index',
            [
                'title'  => "控制台",
                'ctitle' => "首页"
            ]);
    }

    public  function  main(){

        //客户端代码
        $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
        $msg1 = '你好和豆腐干';
        //转为GBK编码，处理乱码问题
        $msg = mb_convert_encoding($msg1,'GBK','UTF-8');
        $len = strlen($msg);
        socket_sendto($sock, $msg, $len, 0, '192.168.1.96', 12343);
        socket_close($sock);
    }

    public  function  socket(){
        //服务器代码
        $address ='' ;
        $port = '12341';
        //创建socket套接字
        $this->master = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP)     or die("socket_create() failed");
        socket_set_option($this->master, SOL_SOCKET, SO_REUSEADDR, 1)  or die("socket_option() failed");
        //绑定ip和端口号
        socket_bind($this->master, $address, $port)or die("socket_bind() failed");
        while (true){
            $from = '';
            $port = 0;
            socket_recvfrom($this->master,$buf,1024,0,$from,$port);
            echo $buf;
            usleep(1000);
        }
    }


}
