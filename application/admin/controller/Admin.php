<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\logic\AdminLogic;
use app\common\model\Menu;
use app\admin\controller\Base;

class Admin extends Base
{

    protected  $admin;

    public function   __construct(AdminLogic $admin)
    {
        parent::__construct();
        $this->admin  =   $admin;
    }


    //管理员列表
    public function index()
    {
        $keywords  =  input('param.keywords','');
        $admins =  $this->admin->getByPageList($keywords);

        $this->assign('admins',$admins);
        return  view();
    }



    //保存数据
    public function save(Request $request)
    {

        $this->admin->create($request->param());
    }


    //编辑数据
    public function edit()
    {

        $admin =  $this->admin->getInfo(input('param.id'));
        return json($admin);
    }

    //删除数据
    public function delete($id)
    {
        $this->admin->del(input('param.id'));
    }


    //修改状态
    public function  status()
    {
        $this->admin->status(input('param.'));
    }


    //授权
    public function  auth()
    {

        if(Request::instance()->isPost()){

            $this->admin->setAuth(input('post.'));

        }else{

            $id =  input('param.id');
            $admin = $this->admin->getInfo($id);
            $admin['rule_id'] = explode(',',$admin['rule_id']);

            $menus = Menu::all();
            
            $this->assign('menus',$menus);
            $this->assign('admin',$admin);
        }


        return view();
    }
}
