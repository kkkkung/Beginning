<?php

namespace App\Models;

class Reply extends Model
{
    protected $fillable = ['content'];

    //关联文章模型，一个回复属于一片文章，一对一 关系
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    //关联用户模型，一个回复属于一个用户，一对一 关系
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
