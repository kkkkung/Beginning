<?php

namespace App\Observers;

use App\Models\Reply;
use App\Notifications\TopicReplied;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{
    public function creating(Reply $reply)
    {
        $reply->content = clean($reply->content, 'user_topic_body');
    }

    public function created(Reply $reply)
    {
        //如果保存的数据为空就删除该回复，否则该回复对应的话题回复计数值+1
        if (empty($reply->content)){
            $reply->delete();
            return null;
        }else{
            $reply->topic->increment('reply_count', 1);
        }

        //通知作者话题被回复了
        $reply->topic->user->notify(new TopicReplied($reply));

    }

    public function deleted(Reply $reply)
    {
        $reply->topic->decrement('reply_count', 1);
    }
}