<?php

declare(strict_types=1);

namespace App\Models;

use App\Enum\GamePeriodStatusEnum;
use App\Services\InvoiceService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property string $start_date
 * @property string $end_date
 * @property int $duration_weeks
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GamePeriod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GamePeriod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GamePeriod query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GamePeriod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GamePeriod whereDurationWeeks($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GamePeriod whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GamePeriod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GamePeriod whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GamePeriod whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class GamePeriod extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'duration_weeks',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date:Y-m-d ',
        'end_date' => 'date:Y-m-d',
    ];

    public function setStartDateAttribute($value): void
    {
        $this->attributes['start_date'] = (new Carbon($value))->format('Y-m-d');
    }

    public function setEndDateAttribute($value): void
    {
        $this->attributes['end_date'] = (new Carbon($value))->format('Y-m-d');
    }

    public static function boot()
    {
        parent::boot();

        static::updated(function ($model) {
            if ($model->status == GamePeriodStatusEnum::PLAYING->value) {
                \Log::info('GamePeriod updated to playing');
                self::query()
                    ->where('id', '!=', $model->id)
                    ->where(['status'=> GamePeriodStatusEnum::PLAYING])
                    ->update(['status' => GamePeriodStatusEnum::FINISHED])
                ;

                $participantsIdsWithBookings = WeeklyBooking::query()->where('period_id', $model->id)->select('participant_id')->groupBy('participant_id')->get()->pluck('participant_id')->toArray();;

                foreach ($participantsIdsWithBookings as $participantId) {
                    $participant = Participant::find($participantId);

                    $invoice = InvoiceService::createInvoiceForParticipant($participant, $model);

                    \Log::info(json_encode($invoice));
                }
            }
        });
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
