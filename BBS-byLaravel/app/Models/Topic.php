<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'category_id', 'excerpt', 'slug'];

    //一片文章属于一个分类
    //创建一对一的关联关系
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //一片文章有一个作者
    //创建一对一的关联关系
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeWithOrder($query, $order)
    {
        //不同的排序，使用不同的数据读取逻辑
        switch ($order){
            case 'recent' :
                $query->recent();
                break;
            default:
                $query->recentReplied();
                break;
        }
        //使用with防止N+1的问题
        return $query->with('user', 'category');
    }

    public function scopeRecentReplied($query)
    {
        //当话题有新回复时候，我们将编写逻辑来更新话题模型的 reply_count 属性
        //此时会自动触发框架对数据模型 updated_at 事件戳的更新
        return $query->orderBy('updated_at', 'desc');
    }

    public function scopeRecent($query)
    {
        //按照创建时间排序
        return $query->orderBy('created_at', 'desc');
    }

    public function link($params = [])
    {
        return route('topics.show', array_merge([$this->id, $this->slug], $params));
    }

    //关联回复模型，一片文章能有多个回复，一对多 关系
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}
