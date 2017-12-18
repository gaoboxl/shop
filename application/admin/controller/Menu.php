<?php
namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\logic\MenuLogic;

class Menu extends Controller
{

    protected $menu;

    public function  __construct(MenuLogic $menu)
    {
        parent::__construct();

        $this->menu =  $menu;

    }

    //菜单列表
    public function index()
    {
        $menus =  $this->menu->getList();
        $this->assign('menus',$menus);
        return view();
    }


    //添加
    public function create()
    {   
        $pid  =  input('param.pid','0');
        $this->assign('pid',$pid);

        return view();
    }



    //添加数据
    public function save(Request $request)
    {

        $this->menu->create($request->param());
    }

    

    //编辑页
    public function edit()
    {
        $id  = input('param.id');
        $menu = $this->menu->getInfo($id);

        $this->assign('menu',$menu);
        return view();
    }

    //修改数据
    public function update(Request $request)
    {
        $this->menu->update($request->param());
    }

    //删除数据
    public function delete()
    {
        $this->menu->del(input('param.id'));
    }
    
}
