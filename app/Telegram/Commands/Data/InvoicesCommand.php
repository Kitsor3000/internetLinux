<?php

namespace App\Telegram\Commands\Data;

use App\Models\Invoice;
use App\Models\Participant;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;
use const _PHPStan_f2f2ddf44\__;

class InvoicesCommand extends Command
{

    public function __construct()
    {
        $this->setName('invoices');
        $this->setDescription(__( 'telegram.invoices_description'));
    }

    public function handle()
    {
        $participant = Participant::getCurrentParticipant();

        $invoicesQuery = Invoice::query()
            ->where('participant_id', $participant->id)
            ->whereIn('status', [Invoice::STATUS_OPEN])
        ;

        $invoices = $invoicesQuery->get();

        $text = __('telegram.paid_transactions') . PHP_EOL;
        $keyboard = Keyboard::make()
            ->setResizeKeyboard(true)
            ->setOneTimeKeyboard(true)
        ;

        if(count($invoices) != 0) {
            foreach ($invoices as $invoice) {
                $text .= $invoice->id .  ' - ' . __('common.date') . ' - ' . $invoice->total_amount . ' ' . PHP_EOL;

                $keyboard->row([
                    Keyboard::button([
                        'text' => '/pay ' . $invoice->id . ' ' . __('telegram.pay_invoice') . ' - ' . $invoice->total_amount,
                    ])
                ]);
            }

            $this->replyWithMessage([
                'text' => $text,
                'reply_markup' => $keyboard,
            ]);
        } else {
            $text .= __('telegram.no_transactions');

            $this->replyWithMessage([
                'text' => $text,
            ]);
        }


    }
}
