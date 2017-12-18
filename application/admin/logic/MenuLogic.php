<?php
namespace app\admin\logic;

use think\Controller;
use app\common\model\Menu;
//use app\common\validate\MenuValidate;

class MenuLogic  extends  Controller
{


     //获取列表
    public  function  getList($data=[],$pid=0,$nbsp=0)
    {

        $list  =  Menu::where('pid',$pid)->select(); 
        $nbsp+=2;
        if($list){

             foreach ($list as $val) {
                $val['name'] =  str_repeat('&emsp;',$nbsp).'|--'.$val['name'];
                $data [] = $val;
                $data =  $this->getList($data,$val['id'],$nbsp);
             }
        }
      
        return $data;
    }
    

    //获取详情
    public function  getInfo($id)
    {

    	return  Menu::get($id);

	}



    //添加数据
    public function  create($post)
    {
    	$menu  = new menu;

    	$menu->name =  $post['name'];
    	$menu->url  =  $post['url'];
    	$menu->icon =  isset($post['icon'])?$post['icon']:''; 
    	$menu->flag =  isset($post['flag'])? 0 : 1;  
    	$menu->pid  =  isset($post['pid'])?$post['pid']:0; 	

    	if($menu->save()){
    		$this->success('添加成功','menu/index');
    	}

    		$this->error('添加失败');

    }



    //修改数据
    public  function  update($post)
    {

    	$menu  = Menu::get($post['id']);

    	$menu->name =  $post['name'];
    	$menu->url  =  $post['url'];
    	$menu->icon =  isset($post['icon'])?$post['icon']:''; 
    	$menu->flag =  isset($post['flag'])? 0 : 1;  
    	$menu->pid  =  isset($post['pid'])?$post['pid']:0; 	

    	if($menu->save()){
    		$this->success('修改成功','menu/index');
    	}

    		$this->error('修改失败');
    }



    //删除数据
    public function   del($id)
    {

    	if(Menu::destroy($id)){
    		$this->success('删除成功','menu/index');
    	}

    	$this->error('删除失败');

    }
}
