<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property int $period_id
 * @property int $participant_id
 * @property int $schedule_id
 * @property string $day_of_week
 * @property string $start_time
 * @property string $end_time
 * @property string $booking_type
 * @property string $fixed_price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Participant $participant
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WeeklyBooking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WeeklyBooking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WeeklyBooking query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WeeklyBooking whereBookingType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WeeklyBooking whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WeeklyBooking whereDayOfWeek($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WeeklyBooking whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WeeklyBooking whereFixedPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WeeklyBooking whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WeeklyBooking whereParticipantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WeeklyBooking wherePeriodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WeeklyBooking whereScheduleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WeeklyBooking whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WeeklyBooking whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class WeeklyBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'period_id',
        'participant_id',
        'fixed_price',
        'schedule_id',
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class, 'participant_id');
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }
}
