<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property string|null $phone
 * @property string|null $telegram_username
 * @property string $joined_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Alias> $aliases
 * @property-read int|null $aliases_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Payment> $payments
 * @property-read int|null $payments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Vote> $votes
 * @property-read int|null $votes_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant whereJoinedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant whereTelegramUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Participant whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'telegram_username',
        'joined_date',
        'telegram_id',
        'telegram_allowed',
        'telegram_usage',
    ];

    protected $casts = [
        'joined_date' => 'date:Y-m-d',
    ];

    protected $appends = [
        'balance',
    ];

    public function aliases()
    {
        return $this->belongsToMany(Alias::class, 'participant_aliases', 'participant_id', 'alias_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function setJoinedDateAttribute($value): void
    {
        $this->attributes['joined_date'] = (new Carbon($value))->format('Y-m-d');
    }

    public static Participant|null $currentParticipant = null;

    public static function setCurrentParticipant(?Participant $participant): bool {
        self::$currentParticipant = $participant;

        return true;
    }

    public static function getCurrentParticipant(): ?Participant {
        return self::$currentParticipant;
    }

    public function getBalanceAttribute(): string
    {
        $minus =  Invoice
            ::query()
            ->where('participant_id', $this->id)
            ->where('status', Invoice::STATUS_OPEN)
            ->sum('total_amount')
        ;

        if ($minus > 0) {
            return ' -' . $minus;
        }

        return '0';
    }
}
