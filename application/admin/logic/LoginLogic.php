<?php
namespace app\admin\logic;

use think\Controller;
use app\common\model\Admin;
use app\common\validate\AdminValidate;
use think\Cache;
use think\Session;

class LoginLogic  extends Controller
{

    /**
     * explain : 登陆验证
     * author :xiaolizi
     * date:2017-12-13
     *
     */

    //最大失败次数
    protected  $max_attempts = 5;


    public   function   loginCheck($post)
    {

            $result =  $this->validateLogin($post);

            if($result){
               $this->error($result);
            }

            //验证失败次数
            if($this->hasTooManyLoginAttempts($post['name'])){
                $this->error('失败次数过多请稍后再试');
            }

            //验证用户状态
            $admin =  Admin::get(['name'=>$post['name'],'status'=>0]);
            if(!$admin){
                $this->error('账户不存在或被禁用');
            }

            //验证密码
            if(!password_verify($post['password'],$admin['password'])){

                $this->incrementLoginAttempts();
                $this->recordLoginName($post['name']);
                $this->error('账号或密码错误');
            }

            Cache::rm('loginAttempts'); 
            Session::set('admin_info',$admin);
            $this->success('登陆成功','Index/index');

    }


    //添加失败次数
    public  function    incrementLoginAttempts()
    {
            Cache::inc('loginAttempts');
    }

    //记录登录账号
    public function      recordLoginName($name)
    {
            if(!Cache::get('loginName') ==  $name){
                Cache::set('loginName',$name);
            }

    }


    //验证失败次数是否达到限制
    public function     hasTooManyLoginAttempts($name)
    {
            $login_attempts  =  Cache::get('loginAttempts');
           
            if($login_attempts > $this->max_attempts && $name == Cache::get('loginName')){
                return true;
            }
            return   false;

    }


    //登录数据验证
    public function   validateLogin($data)
    {

            $adminVlidate   =   new  AdminValidate();

            if(!$adminVlidate->scene('login')->check($data)){

                return  $adminVlidate->getError();
            }

            return false;
    }

}
