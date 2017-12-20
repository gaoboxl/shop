<?php
namespace app\admin\controller;

use think\Session;
use think\Controller;
use app\admin\controller\Base;
use app\admin\logic\MenuLogic;

class Index  extends  Base
{   

    public function   __construct()
    {
        parent::__construct();
    }

	//首页
    public function index()
    {

        $nav_list =  MenuLogic::navList();

        $this->assign('nav_list',$nav_list);
        return view();
    }


    //欢迎页
    public function   welcome()
    {

    	return  view();
    }


}
