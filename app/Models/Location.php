<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'city',
        'district',
        'address',
        'latitude',
        'longitude'
    ];

    public function missingPeople()
    {
        return $this->hasMany(MissingPerson::class, 'last_location_id');
    }

    public function sightingReports()
    {
        return $this->hasMany(Report::class, 'sighting_location_id');
    }

    public function getFullAddressAttribute()
    {
        $parts = array_filter([$this->city, $this->district, $this->address]);
        return implode(', ', $parts);
    }
}
