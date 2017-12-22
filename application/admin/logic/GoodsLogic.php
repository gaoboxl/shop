<?php

namespace app\admin\logic;

use think\Controller;
use app\common\model\Goods;

class GoodsLogic  extends  Controller
{
    
   		//获取列表
		public function  getList($keywords)
		{
			$map ['goods_name']  = array('like',"%$keywords%");

			return   Goods::where($map)->paginate(12,true,['goods_name'=>$keywords]);

		}


		//获取数据详情
		public function getInfo($id){

			return  Goods::get($id,'goodsimg');

		}

		//添加数据
		public function create($post)
		{

			$goods = new Goods;

			$goods->goods_name = $post['goods_name'];
			$goods->price   =   $post['price'];
			$goods->original_price =  $post['original_price'];
			$goods->desc    =  isset($post['desc'])?$post['desc']:'';
			$goods->status  =  isset($post['status'])? 0 : 1;
			$goods->cat_id  =  $post['cat_id'];
			$goods->content =  isset($post['content'])?$post['content']:'';
			$goods->img     =  $post['img'];
			$goods->pro_id     =  implode(',',$post['pro_id']);

			if($goods->save()){
				$this->success('添加成功','goods/index');
			}

			$this->error('添加失败');

		}


		//修改数据
		public function   update($post)
		{

			$goods  =  Goods::get($post['id']);

			$goods->goods_name = $post['goods_name'];
			$goods->price   =   $post['price'];
			$goods->original_price =  $post['original_price'];
			$goods->desc    =  isset($post['desc'])?$post['desc']:'';
			$goods->status  =  isset($post['status'])? 0 : 1;
			$goods->cat_id  =  $post['cat_id'];
			$goods->content =  isset($post['content'])?$post['content']:'';
			$goods->img     =  $post['img'];
			$goods->pro_id     =  implode(',',$post['pro_id']);
			
			if($goods->save()){
				$this->success('修改成功','goods/index');
			}

			$this->error('修改失败');


		}



		//删除数据
		public function   del($id)
		{
			if(Goods::destroy($id)){
				$this->success('删除成功','goods/index');
			}

			$this->error('删除失败');
		}



}
