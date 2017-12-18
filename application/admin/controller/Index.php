<?php
namespace app\admin\controller;

use think\Session;
use think\Controller;
use app\admin\controller\Base;

class Index  extends  Base
{   

    public function   __construct()
    {
        parent::__construct();
    }

	//首页
    public function index()
    {


        $nav_list  =  model('menu')->where(['flag'=>0,'status'=>0])->select();
        //pr($nav_list);die;
        $this->assign('nav_list',$nav_list);
        return view();
    }


    //欢迎页
    public function   welcome()
    {

    	return  view();
    }


}
