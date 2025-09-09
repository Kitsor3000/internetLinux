<?php

namespace App\Console\Commands;

use Alyakin\LiqPayLaravel\Contracts\LiqPayServiceInterface as Liqpay;
use Alyakin\LiqPayLaravel\DTO\LiqPayRequestDto;
use App\Models\Invoice;
use Illuminate\Console\Command;

class GetPaymentUrl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-payment-url';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $invoice = Invoice::find(1);;
        $invoiceId = $invoice->id;

        $liqpay = app(Liqpay::class);

        $url = $liqpay->getPaymentUrl(LiqPayRequestDto::fromArray([
            'version' => 3,
            'public_key' => config('liqpay.public_key'),
            'action' => 'pay',
            'amount' => $invoice->total_amount,
            'currency' => 'UAH',
            'description' => 'Payment for invoice #'.($invoiceId),
            'language' => 'ua',
            'order_id' => 'ORDER-'.$invoiceId,
            'result_url' => config('liqpay.result_url'),
            'server_url' => config('app.url').config('liqpay.server_url'),
        ]));

        $this->info($url);
    }
}
