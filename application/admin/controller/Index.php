<?php
namespace app\admin\controller;


class Index
{
    public function index()
    {
        return view( 'index',
            [
                'title'  => "控制台",
                'ctitle' => "首页"
            ]);
    }
}
