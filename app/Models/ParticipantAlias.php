<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 *
 *
 * @property int $alias_id
 * @property int $participant_id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ParticipantAlias newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ParticipantAlias newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ParticipantAlias query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ParticipantAlias whereAliasId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ParticipantAlias whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ParticipantAlias whereParticipantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ParticipantAlias whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ParticipantAlias extends Pivot
{
    protected $table = 'participant_aliases';

    public $timestamps = false;
}
