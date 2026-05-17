<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_name',
        'country_code',
        'holiday_name',
        'holiday_date',
        'is_recurring',
        'weekend_days',
        'status',
        'notes',
    ];

    protected $casts = [
        'holiday_date' => 'date',
        'is_recurring' => 'boolean',
        'weekend_days' => 'array',
    ];

    public function timeEntries()
    {
        return $this->hasMany(TimeEntry::class);
    }
}
