<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;
// 注册路由到index模块的News控制器的read操作
Route::get('/','index/index/index');
Route::get('admin','admin/Index/index');
Route::get('admin/welcome','admin/Index/welcome');
Route::get('admin/login','admin/Login/index');
Route::post('admin/login/login','admin/Login/login');
Route::get('admin/logout','admin/Login/logout');
Route::get('admin/order','admin/Order/index');
Route::get('admin/order/excel','admin/Order/excel');