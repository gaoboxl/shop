<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\controller\Base;
use app\admin\logic\CateLogic;


class Category extends Base
{


    protected  $cate;


    public function  __construct(CateLogic $cate)
    {
        parent::__construct();
        $this->cate = $cate;
    }


    //分类列表
    public function index()
    {
        $keywords  =   input('get.keywords','');
        $categorys =   $this->cate->getList($keywords);

        $this->assign('keywords',$keywords);
        $this->assign('categorys',$categorys);
        return  view();
    }

   
    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $this->cate->create($request->param());
    }



    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit()
    {

        $category  =  $this->cate->getInfo(input('param.id'));
        return  json($category);
    }


    //删除数据
    public function delete()
    {
        $this->cate->del(input('param.id'));
    }
}
