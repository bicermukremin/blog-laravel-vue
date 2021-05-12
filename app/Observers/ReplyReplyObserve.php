<?php

namespace App\Observers;

use App\Models\ReplyReply;

class ReplyReplyObserve
{
    /**
     * Handle the ReplyReply "created" event.
     *
     * @param  \App\Models\ReplyReply  $replyReply
     * @return void
     */
    public function created(ReplyReply $replyReply)
    {
        //
    }

    /**
     * Handle the ReplyReply "updated" event.
     *
     * @param  \App\Models\ReplyReply  $replyReply
     * @return void
     */
    public function updated(ReplyReply $replyReply)
    {
        //
    }

    /**
     * Handle the ReplyReply "deleted" event.
     *
     * @param  \App\Models\ReplyReply  $replyReply
     * @return void
     */
    public function deleted(ReplyReply $replyReply)
    {
        //
    }

    /**
     * Handle the ReplyReply "restored" event.
     *
     * @param  \App\Models\ReplyReply  $replyReply
     * @return void
     */
    public function restored(ReplyReply $replyReply)
    {
        //
    }

    /**
     * Handle the ReplyReply "force deleted" event.
     *
     * @param  \App\Models\ReplyReply  $replyReply
     * @return void
     */
    public function forceDeleted(ReplyReply $replyReply)
    {
        //
    }
}
