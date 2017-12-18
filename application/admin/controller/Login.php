<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Session;
use app\admin\logic\LoginLogic;

class Login extends Controller
{

    protected  $login;


    //初始化控制器
    public function   __construct(LoginLogic $login)
    {

        $this->login =  $login;

    }

    //登陆页展示
    public function index()
    {
       return view();
    }


    //登陆处理
    public function login(Request $request)
    {  
        if(Request::instance()->isPost()){

            $this->login->loginCheck($request->param());
         }
    }



    //退出登录
    public function  logout()
    {

        Session::clear();
        $this->redirect('login/index');
    }


}
