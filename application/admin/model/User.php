<?php
/**
 * Created by PhpStorm.
 * User: hongyan
 * Date: 2019/4/11
 * Time: 17:34
 */

namespace app\admin\model;

use think\Model;

class User extends Model
{
    //自定义初始化
    protected function initialize()
    {
        //需要调用`Model`的`initialize`方法
        parent::initialize();
        //TODO:自定义的初始化
    }
}