<?php

namespace app\admin\logic;

use think\Controller;
use app\common\model\Admin;

class AdminLogic  extends  Controller
{
    
    	//获取分页列表
		public function  getByPageList($keywords)
		{
			$map['name']   =  array('like',"%$keywords%");
			return Admin::where($map)->paginate(12,true,[
			    'name'   => $keywords,
			]);

		}


		//获取详情
		public function   getInfo($id)
		{

			return Admin::get($id);
		}


		//添加数据
		public function  create($post)
		{

			if(isset($post['admin_id']) && !empty($post['admin_id'])){
				$this->update($post);
			}

			$admin  = new Admin;

			$admin->name = $post['name'];
			$admin->password = password_hash($post['password'], PASSWORD_DEFAULT);

			if($admin->save()){
				$this->success('添加成功','admin/index');
			}

			$this->error('添加失败');
		}


		//修改数据
		public function  update($post)
		{
			
			$admin =  Admin::get($post['admin_id']);
			$admin->name =  $post['name'];

			if($admin->save()){
				$this->success('修改成功','admin/index');
			}

			$this->error('修改失败');
		}


		//删除数据
		public  function  del($id)
		{
			if(Admin::destroy($id)){
				$this->success('删除成功','admin/index');
			}

			$this->error('删除成功');
		}	


		public function  status($get)
		{

			$admin =  Admin::get($get['id']);
			$admin->status = $get['status']==1?0:'1';

			if($admin->save()){
				$this->success('操作成功','admin/index');
			}

			$this->error('操作失败');

		}


		//管理员授权
		public  function setAuth($post)
		{
			$admin =  Admin::get($post['id']);
			$admin->rule_id = implode(',',$post['rule_id']);
			

			if($admin->save()){
				$this->success('操作成功','admin/index');
			}

			$this->error('操作失败');
		}

}
