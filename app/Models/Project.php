<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company_name',
        'primary_contact_name',
        'primary_contact_email',
        'primary_contact_phone',
        'approval_manager_name',
        'approval_manager_email',
        'approval_manager_phone',
        'status',
        'description',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('active')
            ->withTimestamps();
    }

    public function timeEntries()
    {
        return $this->hasMany(TimeEntry::class);
    }
}
