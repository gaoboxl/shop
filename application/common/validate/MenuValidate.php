<?php

namespace app\common\validate;

use think\Validate;

class MenuValidate extends Validate
{

	
	//自定义规则
    protected $rule =   [
         'name'  =>  'require|max:25',
    ];
    
    //定义信息
    protected $message  =   [
          
    ];

     protected $scene = [
        'create'   =>  ['name','email'],
        'update'  =>  ['email'],
    ];
}
