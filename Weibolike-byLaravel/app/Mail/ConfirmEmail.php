<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    //the data what is the view need.
    //Mailable 能进行传递的数据只能以Mailable的属性来传递
    public $user;

    //通过构造函数将实现数据的传递
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    //所有的 Mailable 类都在build方法中完成配置
    //在这个方法里，能调用from 、 subject 、 view 和 attach 来配置完成邮箱的详情
    public function build()
    {
        return $this->from('admin@homestead.com')
                    ->subject('Thanks for you sign up please check your Email')
                    ->view('emails.confirm');
    }
}
