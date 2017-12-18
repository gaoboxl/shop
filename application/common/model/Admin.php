<?php

namespace app\common\model;

use think\Model;
use traits\model\SoftDelete;

class Admin extends Model
{
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    protected $autoWriteTimestamp = true;
    protected $readonly   = ['name'];  //只读字段
}
