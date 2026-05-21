<?php

use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Role::whereIn('slug', ['administrator', 'manager', 'member'])
            ->get()
            ->each(function (Role $role) {
                RolePermission::updateOrCreate(
                    [
                        'role_id' => $role->id,
                        'module' => 'time-entry',
                    ],
                    [
                        'can_read' => true,
                        'can_write' => true,
                    ]
                );
            });
    }

    public function down(): void
    {
        Role::whereIn('slug', ['manager', 'member'])
            ->get()
            ->each(function (Role $role) {
                RolePermission::where('role_id', $role->id)
                    ->where('module', 'time-entry')
                    ->update(['can_write' => false]);
            });
    }
};
