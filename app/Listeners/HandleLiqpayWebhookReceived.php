<?php

namespace App\Listeners;

use Alyakin\LiqPayLaravel\Events\LiqpayWebhookReceived;
use App\Models\Invoice;

class HandleLiqpayWebhookReceived
{
    public function handle(LiqpayWebhookReceived $event)
    {
        if($event->dto->status === 'success') {
            Invoice::where('id', $event->dto->order_id)->update(['status' => Invoice::STATUS_PAID]);
        }
    }
}
