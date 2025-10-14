<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissingPerson extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'last_location_id',
        'first_name',
        'last_name',
        'middle_name',
        'age',
        'gender',
        'description',
        'special_marks',
        'photo_path',
        'disappeared_at',
        'status',
        'contact_info',
        'is_urgent'
    ];

    protected $casts = [
        'disappeared_at' => 'date',
        'is_urgent' => 'boolean',
    ];

    // Зв'язок з користувачем
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Зв'язок з останньою локацією
    public function lastLocation()
    {
        return $this->belongsTo(Location::class, 'last_location_id');
    }

    // Зв'язок багато-до-багатьох з категоріями
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'missing_person_category');
    }

    // Зв'язок один-до-багатьох з звітами
    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    // Аксесор для повного імені
    public function getFullNameAttribute()
    {
        if ($this->middle_name) {
            return "{$this->last_name} {$this->first_name} {$this->middle_name}";
        }
        return "{$this->last_name} {$this->first_name}";
    }

    // Аксесор для віку з текстом
    public function getAgeWithTextAttribute()
    {
        $age = $this->age;
        $lastDigit = $age % 10;

        if ($age >= 11 && $age <= 14) {
            return "{$age} років";
        }

        switch ($lastDigit) {
            case 1:
                return "{$age} рік";
            case 2:
            case 3:
            case 4:
                return "{$age} роки";
            default:
                return "{$age} років";
        }
    }

    // Методи для перевірки статусу
    public function isMissing()
    {
        return $this->status === 'missing';
    }

    public function isFound()
    {
        return $this->status === 'found';
    }

    public function isSearchSuspended()
    {
        return $this->status === 'search_suspended';
    }

    // Scope для активних пошуків
    public function scopeActive($query)
    {
        return $query->where('status', 'missing');
    }

    // Scope для термінових випадків
    public function scopeUrgent($query)
    {
        return $query->where('is_urgent', true);
    }
}
