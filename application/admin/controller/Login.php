<?php
/**
 * Created by PhpStorm.
 * User: hongyan
 * Date: 2019/4/11
 * Time: 18:00
 */
namespace app\admin\controller;

use think\Controller;

class Login extends Controller
{
    public function index(){

        $this->view->engine->layout(false);
        return view( 'index',
            [
                'title'  => "控制台",
                'ctitle' => "首页"
            ]);
    }
}