<?php

namespace App\Telegram\Commands;

use Alyakin\LiqPayLaravel\Contracts\LiqPayServiceInterface;
use Alyakin\LiqPayLaravel\DTO\LiqPayRequestDto;
use App\Models\Invoice;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram;
use Alyakin\LiqpayLaravel\Contracts\LiqpayServiceInterface as Liqpay;
use const _PHPStan_f2f2ddf44\__;

class PayCommand extends Command
{
    public function __construct(
        private LiqPayServiceInterface $liqpay,
    ) {
        $this->setName('pay');
        $this->setDescription(__( 'telegram.pay_description'));
        $this->setPattern('{invoiceId: \d+}');
    }

    public function handle() {
        $invoiceId = $this->argument('invoiceId');
        $invoice = Invoice::find($invoiceId);

        if (!$invoice) {
            $this->replyWithMessage([
                'text' => __('telegram.invoice_not_found'),
            ]);

            $this->triggerCommand('help');

            return;
        }


        $url = $this->liqpay->getPaymentUrl(LiqPayRequestDto::fromArray([
            'version' => 3,
            'public_key' => config('liqpay.public_key'),
            'action' => 'pay',
            'amount' => $invoice->total_amount,
            'currency' => 'UAH',
            'description' => 'Payment for invoice #'.($invoiceId),
            'language' => 'ua',
            'order_id' => $invoiceId,
            'result_url' => config('liqpay.result_url'),
            'server_url' => config('app.url').config('liqpay.server_url'),
        ]));

        $reply_markup = new Keyboard();
        $reply_markup->inline()->setSelective(true)->setOneTimeKeyboard(true);
        $reply_markup->row([Keyboard::inlineButton([
                'text' => __('telegram.pay'),
                'url' => $url,
            ]
        )]);

        $text = __('telegram.pay_invoice_text');
        $text .= PHP_EOL;
        $text .= __('telegram.after_pay') . PHP_EOL;
        $text .= '/help';

        $this
            ->replyWithMessage([
                'text' => $text,
                'reply_markup' => $reply_markup,
            ])
        ;
    }

}
