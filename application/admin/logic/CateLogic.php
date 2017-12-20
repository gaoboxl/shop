<?php

namespace app\admin\logic;

use think\Controller;
use app\common\model\Category;

class CateLogic  extends Controller
{
    

    //获取列表
	public function getList($keywords)
	{
		$map['name']  = array('like',"%$keywords%");
		return   Category::where($map)->paginate('10',true,['name'=>$keywords]);

	}


	//获取详情
	public function getInfo($id)
	{

		return  Category::get($id);

	}


	//添加数据
	public function   create($post)
	{

		if(!empty($post['id'])){

			$this->update($post);
		}

		$cate =  new Category;

		$cate->name =  $post['name'];

		if($cate->save()){
			$this->success('添加成功','category/index');
		}

		$this->error('添加失败');

	}


	//修改数据
	public function   update($post)
	{

		$cate = Category::get($post['id']);

		$cate->name =  $post['name'];

		if($cate->save()){
			$this->success('修改成功','category/index');
		}

		$this->error('修改失败');

	}

	//删除数据
		public  function  del($id)
		{
			if(Category::destroy($id)){
				$this->success('删除成功','category/index');
			}

			$this->error('删除成功');
		}	



}
