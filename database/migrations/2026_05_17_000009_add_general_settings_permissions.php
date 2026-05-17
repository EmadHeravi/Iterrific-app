<?php

use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Role::all()->each(function (Role $role) {
            RolePermission::updateOrCreate(
                [
                    'role_id' => $role->id,
                    'module' => 'general-settings',
                ],
                [
                    'can_read' => $role->slug === 'administrator',
                    'can_write' => $role->slug === 'administrator',
                ]
            );
        });
    }

    public function down(): void
    {
        RolePermission::where('module', 'general-settings')->delete();
    }
};
