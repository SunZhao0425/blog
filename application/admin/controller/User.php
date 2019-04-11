<?php
/**
 * Created by PhpStorm.
 * User: hongyan
 * Date: 2019/4/11
 * Time: 16:42
 */
namespace app\admin\controller;

use app\admin\model\Uniprofile;
use app\admin\model\User as Umodel;

class User
{
    public $title = "用户管理" ;
    public function  __construct()
    {
        $this->Umodel = new Umodel();
    }

    public function index()
    {
        $ctitle = "用户列表";
        $alluser = $this->Umodel->select();
        print_r($alluser);die;
        return view( 'index',
            [
                'title'  => $this->title,
                'ctitle' => "首页"
            ]);
    }

    public function add(){
        $ctitle = "新增用户";
    }

    public function  update(){
        $ctitle = "更新用户信息";
    }

    public function getUser(){
        $ctitle = "用户详细信息";
    }

    public function  delete(){
        $ctitle = "删除用户";
    }
}