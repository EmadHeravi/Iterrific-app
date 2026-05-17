<?php

namespace App\Models;

use App\Services\MicrosoftGraphMailer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\URL;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmailContract
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
        'avatar_path',

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

    public function sendEmailVerificationNotification(): void
    {
        $expiresIn = (int) config('auth.verification.expire', 60);
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes($expiresIn),
            [
                'id' => $this->getKey(),
                'hash' => sha1($this->getEmailForVerification()),
            ]
        );

        $html = view('emails.verify-email', [
            'expiresIn' => $expiresIn,
            'user' => $this,
            'verificationUrl' => $verificationUrl,
        ])->render();

        app(MicrosoftGraphMailer::class)->send(
            $this->getEmailForVerification(),
            'Confirm your ITerrific email address',
            $html
        );
    }

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

    public function timeEntries()
    {
        return $this->hasMany(TimeEntry::class);
    }

    public function reviewedTimeEntries()
    {
        return $this->hasMany(TimeEntry::class, 'reviewed_by');
    }

    public function managedEmployees()
    {
        return $this->belongsToMany(
            self::class,
            'manager_employee_assignments',
            'manager_id',
            'employee_id'
        )
            ->withPivot('active')
            ->withTimestamps();
    }

    public function employeeManagers()
    {
        return $this->belongsToMany(
            self::class,
            'manager_employee_assignments',
            'employee_id',
            'manager_id'
        )
            ->withPivot('active')
            ->withTimestamps();
    }

    public function managesEmployee(int $employeeId): bool
    {
        return $this->managedEmployees()
            ->where('users.id', $employeeId)
            ->wherePivot('active', true)
            ->exists();
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
        $permissionUser = $this->permissionPreviewUser();

        if ($permissionUser->id !== $this->id) {
            return $permissionUser->hasDirectPermission($module, $action);
        }

        return $this->hasDirectPermission($module, $action);
    }

    private function hasDirectPermission(string $module, string $action): bool
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

    private function permissionPreviewUser(): self
    {
        if ($this->role !== 'administrator') {
            return $this;
        }

        $previewUserId = session('permission_preview_user_id');

        if (! $previewUserId || (int) $previewUserId === (int) $this->id) {
            return $this;
        }

        return self::find($previewUserId) ?: $this;
    }

}
