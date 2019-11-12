<?php

namespace App\Observers;

use App\Handlers\BaiduTranslate;
use App\Models\Topic;
use App\Jobs\TranslateSlug;
use Illuminate\Support\Facades\DB;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    public function creating(Topic $topic)
    {
        //
    }

    public function updating(Topic $topic)
    {
        //
    }

    public function saving(Topic $topic)
    {
        //使用Purifier插件定义的user_topic_body规则过滤掉危险的数据
        //以防 XSS
        $topic->body = clean($topic->body, 'user_topic_body');

        //使用（helpers.php）自定义的 make_excerpt 函数从$topic->body收集信息并赋值给excerpt
        $topic->excerpt = make_excerpt($topic->body);

    }

    public function saved(Topic $topic)
    {
        //如 slug 字段无内容，即使用翻译器对 title 进行翻译
        if (!$topic->slug){

            // 推送任务到队列
            dispatch(new TranslateSlug($topic));
        }
    }

    public function deleted(Topic $topic)
    {
        if ($reply = DB::table('relies')->where('topic_id', $topic->id)) {
            $reply->delete();
        }
    }

}