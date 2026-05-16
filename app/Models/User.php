<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * |--------------------------------------------------------------------------
     * | Mass Assignable Fields
     * |--------------------------------------------------------------------------
     */

    protected $fillable = [

        /*
        |--------------------------------------------------------------------------
        | Authentication
        |--------------------------------------------------------------------------
        */

        'first_name',
        'last_name',
        'email',
        'password',

        /*
        |--------------------------------------------------------------------------
        | Roles & Types
        |--------------------------------------------------------------------------
        */

        'role',
        'user_type',
        'employee_id',

        /*
        |--------------------------------------------------------------------------
        | Company Information
        |--------------------------------------------------------------------------
        */

        'company_name',
        'company_registration_number',
        'vat_number',

        /*
        |--------------------------------------------------------------------------
        | Personal Address
        |--------------------------------------------------------------------------
        */

        'personal_address',
        'personal_postal_code',
        'personal_city',
        'personal_country',

        /*
        |--------------------------------------------------------------------------
        | Business Address
        |--------------------------------------------------------------------------
        */

        'business_address',
        'business_postal_code',
        'business_city',
        'business_country',

        /*
        |--------------------------------------------------------------------------
        | Banking
        |--------------------------------------------------------------------------
        */

        'bank_name',
        'bank_account_holder',
        'iban',

        /*
        |--------------------------------------------------------------------------
        | Phone
        |--------------------------------------------------------------------------
        */

        'phone_country_code',
        'phone_number',

        /*
        |--------------------------------------------------------------------------
        | Profile
        |--------------------------------------------------------------------------
        */

        'about',

    ];

    /**
     * |--------------------------------------------------------------------------
     * | Hidden Fields
     * |--------------------------------------------------------------------------
     */

    protected $hidden = [

        'password',
        'remember_token',

    ];

    /**
     * |--------------------------------------------------------------------------
     * | Casts
     * |--------------------------------------------------------------------------
     */

    protected $casts = [

        'email_verified_at' => 'datetime',

    ];

    /**
     * |--------------------------------------------------------------------------
     * | Automatically Hash Password
     * |--------------------------------------------------------------------------
     */

    public function setPasswordAttribute($password)
    {
        if (!empty($password)) {

            $this->attributes['password'] = bcrypt($password);

        }
    }

    /**
     * |--------------------------------------------------------------------------
     * | Full Name Helper
     * |--------------------------------------------------------------------------
     */

    public function getFullNameAttribute()
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class)
            ->withPivot('active')
            ->withTimestamps();
    }

    public function roleDefinition()
    {
        return $this->belongsTo(Role::class, 'role', 'slug');
    }

    public function canRead(string $module): bool
    {
        return $this->hasPermission($module, 'read');
    }

    public function canWrite(string $module): bool
    {
        return $this->hasPermission($module, 'write');
    }

    private function hasPermission(string $module, string $action): bool
    {
        if ($this->role === 'administrator') {
            return true;
        }

        $role = $this->roleDefinition()
            ->with('permissions')
            ->first();

        if (! $role) {
            return false;
        }

        $permission = $role->permissions
            ->firstWhere('module', $module);

        if (! $permission) {
            return false;
        }

        return $action === 'write'
            ? $permission->can_write
            : $permission->can_read;
    }

}
