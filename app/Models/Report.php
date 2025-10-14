<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'missing_person_id',
        'user_id',
        'reporter_name',
        'reporter_phone',
        'sighting_details',
        'sighting_location_id',
        'sighting_time',
        'status',
        'admin_notes'
    ];

    protected $casts = [
        'sighting_time' => 'datetime',
    ];

    // Зв'язок з зниклою особою
    public function missingPerson()
    {
        return $this->belongsTo(MissingPerson::class);
    }

    // Зв'язок з користувачем
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Зв'язок з локацією появи
    public function sightingLocation()
    {
        return $this->belongsTo(Location::class, 'sighting_location_id');
    }

    // Методи для перевірки статусу звіту
    public function isNew()
    {
        return $this->status === 'new';
    }

    public function isVerified()
    {
        return $this->status === 'verified';
    }

    public function isFalseAlarm()
    {
        return $this->status === 'false_alarm';
    }

    // Scope для перевірених звітів
    public function scopeVerified($query)
    {
        return $query->where('status', 'verified');
    }
}
