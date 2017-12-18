<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Session;

class Base extends Controller
{
   

    public function __construct()
    {
        parent::__construct();

        $admin_info =  Session::get('admin_info');

        if($admin_info){
            $this->assign('admin_info',$admin_info);
        }else{
            $this->redirect('admin/login');
        }

    }




}
