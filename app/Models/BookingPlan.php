<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property int $schedule_id
 * @property int $participant_id
 * @property string $planned_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Participant $participant
 * @property-read \App\Models\Schedule $schedule
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookingPlan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookingPlan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookingPlan query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookingPlan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookingPlan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookingPlan whereParticipantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookingPlan wherePlannedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookingPlan whereScheduleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BookingPlan whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class BookingPlan extends Model
{
    use HasFactory;

    protected $table = 'booking_plan';

    protected $fillable = [
        'schedule_id',
        'participant_id',
        'planned_date',
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }
}
