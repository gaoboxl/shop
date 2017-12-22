<?php
namespace app\api\controller;

//header('content-type:application:json;charset=utf8');
header('Access-Control-Allow-Origin:*');  //允许所有来源访问
header('Access-Control-Allow-Methods:GET');  //允许请求方式
//header('Access-Control-Allow-Headers:x-requested-with,content-type');

class Index
{



    public function user()
    {
        $users =  model('Admin')->limit(5)->select();
        return api(200,'获取成功',$users);
    }


    public  function  menu()
    {

    	$menus  =  model('Menu')->limit(5)->select();
    	return  api(200,'获取成功',$menus);
    }

}
