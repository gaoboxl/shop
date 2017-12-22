<?php

namespace app\common\model;

use think\Model;
use traits\model\SoftDelete;

class Goods extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $autoWriteTimestamp = true;


    public function goodsimg()
    {
         return $this->hasOne('Picture','id','img')->bind('source_img,thumb_img');
       
    }



}
