<?php

namespace App\Telegram\Commands\Data;

use App\Models\Invoice;
use App\Models\Participant;
use Telegram\Bot\Commands\Command;
use const _PHPStan_f2f2ddf44\__;

class TransactionsCommand extends Command
{

    public function __construct()
    {
        $this->setName('transactions');
        $this->setDescription(__( 'telegram.transactions_description'));;
    }
    public function handle()
    {
        $participant = Participant::getCurrentParticipant();

        if (!$participant) {
            return;
        }

        $invoicesQuery = Invoice::query()
            ->where('participant_id', $participant->id)
            ->whereIn('status', [Invoice::STATUS_PENDING, Invoice::STATUS_PAID])
            ->where('date', '>', new \DateTime('-4 months'))
        ;

        $invoices = $invoicesQuery->get();

        $text = __('telegram.paid_transactions') . PHP_EOL;

        if(count($invoices) != 0) {
            foreach ($invoices as $invoice) {
                $text .= $invoice->id . __('common.date') . ' - ' . $invoice->total_amount . ' ' . __('common.status') . PHP_EOL;
            }
        } else {
            $text .= __('telegram.no_transactions_or_was_more_than_4_months');
        }

        $this->replyWithMessage([
            'text' => $text,
        ]);

        $this->triggerCommand('help');
    }
}
