<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\logic\ProjectLogic;
use app\admin\controller\Base;

class Project extends Base
{


    protected  $project;

    public function __construct(ProjectLogic $project){
        parent::__construct();
        $this->pro =  $project;
    }

    //项目列表
    public function index()
    {   
        $keywords = input('param.keywords','');
        $projects =  $this->pro->getList($keywords);
        $this->assign('projects',$projects);
        $this->assign('kwywords',$keywords);
        return  view();
    }

    //添加页
    public function create()
    {
        return   view();
    }

    //保存数据
    public function save(Request $request)
    {
        $this->pro->create($request->param());
    }

    
    //编辑页
    public function edit()
    {
        $project =  $this->pro->getInfo(input('param.id'));
        $this->assign('project',$project);
        return view();
    }

    //修改数据
    public function update(Request $request)
    {
        $this->pro->update($request->param());
    }

    //删除数据
    public function delete()
    {
        $this->pro->del(input('param.id'));
    }
}
