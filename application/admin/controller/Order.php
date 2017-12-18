<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Order extends Controller
{


    //显示订单列表
    public function index()
    {

        return view();
    }

    public function   excel()
    {

         $name  ='用户预约订单';
         $header=['id','用户名','微信号','余额','添加时间'];
         $data = db('users')->field('user_id,user_name,wchat,balance,create_time')->select();
         excel($name,$header,$data);
    }
}
