<?php
namespace app\admin\logic;

use think\Controller;
use app\common\model\Project;

class ProjectLogic  extends  Controller
{
		//返回列表数据
   		public function   getList($keywords)
   		{
   			$map['name'] = array('like',"%$keywords");
   			return Project::where($map)->paginate(12,true,[
			    'name'   => $keywords,
			]);

   		}

   		public  function  getInfo($id)
   		{
   			return  Project::get($id);
   		}

   		public function  create($post)
   		{
   			 $pro = new Project;

   			 $pro->name = $post['name'];
   			 $pro->num  = $post['num'];
   			 $pro->price =  $post['price'];

   			 if($pro->save()){

   			 	$this->success('添加成功','project/index');
   			 }

   			 $this->error('添加失败');
   		}

   		public function  update($post)
   		{

   			 $pro =  Project::get($post['id']);

   			 $pro->name = $post['name'];
   			 $pro->num  = $post['num'];
   			 $pro->price =  $post['price'];

   			 if($pro->save()){
   			 	$this->success('修改成功','project/index');
   			 }

   			 $this->error('修改失败');
   		}

   		public function  del($id)
   		{
   			if(Project::destroy($id)){
				$this->success('删除成功','project/index');
			}
			$this->error('删除成功');
   		}

}
