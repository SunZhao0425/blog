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

    }

    public  function  socket(){

        $address = '192.168.1.96';
        $port = '6640';
        $this->master = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)     or die("socket_create() failed");
        socket_set_option($this->master, SOL_SOCKET, SO_REUSEADDR, 1)  or die("socket_option() failed");
        socket_bind($this->master, $address, $port)                    or die("socket_bind() failed");
        socket_listen($this->master,20)                                or die("socket_listen() failed");

        print_r($this->master);die;
    }


}
