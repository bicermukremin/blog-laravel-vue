<?php

namespace App\Observers;

use App\Models\Reply;
use App\Notifications\ReplyNotification;
use Illuminate\Notifications\Notifiable;
use App\Notifications\CommentReplyNotification;

class ReplyObserve
{
     use Notifiable;
    /**
     * Handle the Reply "created" event.
     *
     * @param  \App\Models\Reply  $reply
     * @return void
     */
    public function created(Reply $reply)
    {
       /*  $comment= $reply->comment;
       $user1=$comment->user;
       $user2=auth()->user();
       
       $user1->notify(new CommentReplyNotification($reply));
       $user2->notify(new ReplyNotification($comment)); */
       
        
    }

    /**
     * Handle the Reply "updated" event.
     *
     * @param  \App\Models\Reply  $reply
     * @return void
     */
    public function updated(Reply $reply)
    {
        //
    }

    /**
     * Handle the Reply "deleted" event.
     *
     * @param  \App\Models\Reply  $reply
     * @return void
     */
    public function deleted(Reply $reply)
    {
        //
    }

    /**
     * Handle the Reply "restored" event.
     *
     * @param  \App\Models\Reply  $reply
     * @return void
     */
    public function restored(Reply $reply)
    {
        //
    }

    /**
     * Handle the Reply "force deleted" event.
     *
     * @param  \App\Models\Reply  $reply
     * @return void
     */
    public function forceDeleted(Reply $reply)
    {
        //
    }
}