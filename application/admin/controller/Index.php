<?php
namespace app\admin\controller;

class Index extends Controller
{
    public function index()
    {
//        $this->view->engine->layout("layout");
        return view("index");
    }
}
