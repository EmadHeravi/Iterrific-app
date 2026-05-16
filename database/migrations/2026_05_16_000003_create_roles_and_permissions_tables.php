<?php

use App\Support\AppPermissions;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 100)
                ->default('member')
                ->change();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->boolean('is_system')->default(false);
            $table->timestamps();
        });

        Schema::create('role_permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('module');
            $table->boolean('can_read')->default(false);
            $table->boolean('can_write')->default(false);
            $table->timestamps();

            $table->unique(['role_id', 'module']);
        });

        $now = now();

        $roles = [
            [
                'name' => 'Administrator',
                'slug' => 'administrator',
                'description' => 'Full access to all app sections.',
                'is_system' => true,
            ],
            [
                'name' => 'Manager',
                'slug' => 'manager',
                'description' => 'Operational access for managing projects and users.',
                'is_system' => true,
            ],
            [
                'name' => 'Member',
                'slug' => 'member',
                'description' => 'Standard employee access.',
                'is_system' => true,
            ],
        ];

        foreach ($roles as $role) {
            $roleId = DB::table('roles')->insertGetId([
                ...$role,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            foreach (AppPermissions::modules() as $module => $label) {
                DB::table('role_permissions')->insert([
                    'role_id' => $roleId,
                    'module' => $module,
                    'can_read' => $this->defaultCanRead($role['slug'], $module),
                    'can_write' => $this->defaultCanWrite($role['slug'], $module),
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_permissions');
        Schema::dropIfExists('roles');

        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', [
                'administrator',
                'manager',
                'member',
            ])
                ->default('member')
                ->change();
        });
    }

    private function defaultCanRead(string $role, string $module): bool
    {
        return true;
    }

    private function defaultCanWrite(string $role, string $module): bool
    {
        if ($role === 'administrator') {
            return true;
        }

        if ($role === 'manager') {
            return in_array($module, [
                'projects',
                'user-profile',
            ], true);
        }

        return $module === 'user-profile';
    }
};
