<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property-read \App\Models\Schedule|null $schedule
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HallBooking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HallBooking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HallBooking query()
 * @mixin \Eloquent
 */
class HallBooking extends Model
{
    use HasFactory;

    protected $fillable = ['schedule_id', 'booking_type', 'total_cost', 'is_full_booking'];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }
}
