<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';

    public const STATUS_OPEN = 'open';
    public const STATUS_PENDING = 'in_progress';

    public const STATUS_PAID = 'paid';

    protected $fillable = [
        'participant_id',
        'total_amount',
        'status',
        'date',
    ];
}
