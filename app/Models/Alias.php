<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property string $alias_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Participant> $participants
 * @property-read int|null $participants_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Payment> $payments
 * @property-read int|null $payments_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alias newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alias newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alias query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alias whereAliasName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alias whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alias whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Alias whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Alias extends Model
{
    use HasFactory;

    protected $fillable = [
        'alias_name',
    ];

    public function participants()
    {
        return $this->belongsToMany(Participant::class, 'participant_aliases', 'alias_id', 'participant_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
