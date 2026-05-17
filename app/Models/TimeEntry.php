<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'project_id',
        'entry_date',
        'hours',
        'description',
        'status',
        'is_weekend',
        'is_holiday',
        'calendar_id',
        'submitted_at',
        'reviewed_by',
        'reviewed_at',
        'review_note',
    ];

    protected $casts = [
        'entry_date' => 'date',
        'hours' => 'decimal:2',
        'is_weekend' => 'boolean',
        'is_holiday' => 'boolean',
        'submitted_at' => 'datetime',
        'reviewed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function calendar()
    {
        return $this->belongsTo(Calendar::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
