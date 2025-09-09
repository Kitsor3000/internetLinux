<?php

namespace App\Services;

use App\Models\GamePeriod;
use App\Models\Invoice;
use App\Models\Participant;
use App\Models\WeeklyBooking;

class InvoiceService
{
    public static function createInvoiceForParticipant(Participant $participant, GamePeriod $gamePeriod)
    {
        $sum = WeeklyBooking::query()
            ->where('period_id', $gamePeriod->id)
            ->where('participant_id', $participant->id)
            ->sum('fixed_price')
        ;

        return Invoice::create([
            'total_amount' => $sum,
            'participant_id' => $participant->id,
            'period_id' => $gamePeriod->id,
            'date' => now(),
            'status' => Invoice::STATUS_OPEN,
        ]);
    }

}
