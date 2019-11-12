<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //定义可组合赋值的属性
    protected $fillable = ['content'];


    public function user()
    {
        //一对多反向关联
        return $this->belongsTo(User::class);
    }
}
