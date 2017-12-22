<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\controller\Base;
use app\admin\logic\GoodsLogic;
use app\common\model\Category;
use app\common\model\Project;

class Goods extends Base
{

    protected  $goods;


    public function __construct(GoodsLogic $goods)
    {
        parent::__construct();
        $this->goods =  $goods;
    }

    //商品列表
    public function index()
    {   

        $keywords  =  input('param.keywords','');
        $goods =  $this->goods->getList($keywords);
        
        $this->assign('keywords',$keywords);
        $this->assign('goods_list',$goods);        
        return view();
    }



    //添加页
    public function create()
    {
        $category =  Category::all();
        $project  =  Project::all();

        $this->assign('category',$category);
        $this->assign('project',$project);
        return view();
    }

    //保存数据
    public function save(Request $request)
    {
        $this->goods->create($request->param());
    }


    //编辑数据
    public function edit()
    {

        $category =  Category::all();
        $goods  =  $this->goods->getInfo(input('param.id'));
        $goods['pro_id'] =  explode(',',$goods['pro_id']);
        $project  =  Project::all();  
        
        $this->assign('project',$project);
        $this->assign('category',$category);
        $this->assign('goods',$goods);
        return view();
    }

    //修改数据
    public function update(Request $request)
    {
        $this->goods->update($request->param());
    }



    //删除数据
    public function delete()
    {
        $this->goods->del(input('param.id'));
    }
}
