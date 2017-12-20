<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\controller\Base;
use app\admin\logic\GoodsLogic;

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

        return view();
    }

    //保存数据
    public function save(Request $request)
    {
        $this->goods->create($request->param());
    }


    //编辑数据
    public function edit($id)
    {
        //
    }

    //修改数据
    public function update(Request $request, $id)
    {
        //
    }



    //删除数据
    public function delete($id)
    {
        //
    }
}
