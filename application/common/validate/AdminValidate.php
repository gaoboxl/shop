<?php

namespace app\common\validate;

use think\Validate;

class AdminValidate extends Validate
{

	
	protected $rule = [
		
        'name'     =>  'require|max:25|token',
        'password' =>  'require|max:18',
    ];
    
    protected $message = [

        'name.require'  		=>  '用户名不能为空',
        'name.max'				=>  '用户名格式不正确',
        'name.token'			=>  '非法提交',
        'password.require'      =>  '密码不能为空',
        'password.between'		=>  '密码格式不正确',
    ];
    
    protected $scene = [
        'register'   =>  ['name','email'],
        'login'  	 =>  ['name','password'],
    ];




}
