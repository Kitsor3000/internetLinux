<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property string $question
 * @property string $start_date
 * @property string $end_date
 * @property int $is_active
 * @property string $voting_type
 * @property string $related_class
 * @property int|null $related_class_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\GamePeriod|null $gamePeriod
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Vote> $votes
 * @property-read int|null $votes_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voting query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voting whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voting whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voting whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voting whereRelatedClass($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voting whereRelatedClassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voting whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voting whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Voting whereVotingType($value)
 * @mixin \Eloquent
 */
class Voting extends Model
{
    use HasFactory;

    protected $fillable = [
        'period_id',
        'question',
        'start_date', 'end_date', 'is_active'
    ];

    public function gamePeriod()
    {
        return $this->belongsTo(GamePeriod::class, 'period_id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
