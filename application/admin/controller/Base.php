<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Session;
use app\admin\logic\MenuLogic;

class Base extends Controller
{
   

    public function __construct()
    {
        parent::__construct();

        $this->isAuth();
        $admin_info =  Session::get('admin_info');

        if($admin_info){
            $this->assign('admin_info',$admin_info);
        }else{
            $this->redirect('login/index');
        }

    }


    //是否授权
    public function   isAuth()
    {

        $auth_list    =  MenuLogic::getByRule();
        $request =  Request::instance();
        $url     =  $request->module().'/'.$request->controller().'/'.$request->action();
        $tourist  = ['admin/index/index','admin/index/welcome'];
     
        if(!in_array(strtolower($url),$tourist)){

            if(!in_array(strtolower($url),$auth_list)){

                $this->error('您没有权限,请联系管理员！');
            } 
        }

        

    }


}
