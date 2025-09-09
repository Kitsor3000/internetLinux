<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property-read \App\Models\Participant|null $participant
 * @property-read \App\Models\Voting|null $voting
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vote newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vote newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vote query()
 * @mixin \Eloquent
 */
class Vote extends Model
{
    use HasFactory;

    protected $fillable = ['voting_id', 'participant_id', 'option'];

    public function voting()
    {
        return $this->belongsTo(Voting::class, 'voting_id');
    }

    public function participant()
    {
        return $this->belongsTo(Participant::class, 'participant_id');
    }
}
