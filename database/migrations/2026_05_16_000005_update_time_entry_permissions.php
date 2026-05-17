<?php

use App\Models\Role;
use App\Models\RolePermission;
use App\Support\AppPermissions;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        RolePermission::where('module', 'tables')
            ->update(['module' => 'time-entry']);

        RolePermission::where('module', 'virtual-reality')
            ->delete();

        RolePermission::where('module', 'rtl')
            ->delete();

        Role::all()->each(function (Role $role) {
            foreach (AppPermissions::modules() as $module => $label) {
                RolePermission::firstOrCreate(
                    [
                        'role_id' => $role->id,
                        'module' => $module,
                    ],
                    [
                        'can_read' => $this->defaultCanRead($role->slug, $module),
                        'can_write' => $this->defaultCanWrite($role->slug, $module),
                    ]
                );
            }
        });
    }

    public function down(): void
    {
        RolePermission::where('module', 'time-entry')
            ->update(['module' => 'tables']);

        RolePermission::where('module', 'approvals')
            ->delete();

        Role::all()->each(function (Role $role) {
            RolePermission::firstOrCreate(
                [
                    'role_id' => $role->id,
                    'module' => 'virtual-reality',
                ],
                [
                    'can_read' => true,
                    'can_write' => $role->slug === 'administrator',
                ]
            );

            RolePermission::firstOrCreate(
                [
                    'role_id' => $role->id,
                    'module' => 'rtl',
                ],
                [
                    'can_read' => true,
                    'can_write' => $role->slug === 'administrator',
                ]
            );
        });
    }

    private function defaultCanRead(string $role, string $module): bool
    {
        if ($role === 'member') {
            return ! in_array($module, ['approvals', 'calendars'], true);
        }

        return true;
    }

    private function defaultCanWrite(string $role, string $module): bool
    {
        return match ($role) {
            'administrator' => true,
            'manager' => in_array($module, ['time-entry', 'approvals', 'projects', 'user-profile'], true),
            'member' => in_array($module, ['time-entry', 'user-profile'], true),
            default => false,
        };
    }
};
