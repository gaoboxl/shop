<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件


//打印数据
function   pr($data)
{

	echo "<pre>";
	print_r($data);

}

//打印数据
function   vr($data)
{

	echo "<pre>";
	var_dump($data);

}

//返回ajax  
function  api($status,$msg,$data=[])
{
	return   json(['status'=>$status,'msg'=>$msg,'data'=>$data]);

}