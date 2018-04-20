<?php

namespace App\Listeners;

use App\Events\TransactionLogEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\TransactionLog;
use Auth;

class TransactionLogListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TransactionLog  $event
     * @return void
     */
    public function handle(TransactionLogEvent $event)
    {
        $translog = new TransactionLog;
        $translog->transaction_code = $event->transactionCode;
        $translog->transaction_details = $event->transaction;
        $translog->url = $event->url;
        $translog->user_id=1;// Auth::User()->id;
        $translog->save();
        
    }
}
