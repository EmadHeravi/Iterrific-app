<?php

use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('calendars', function (Blueprint $table) {
            $table->id();
            $table->string('country_name');
            $table->string('country_code', 3);
            $table->string('holiday_name');
            $table->date('holiday_date');
            $table->boolean('is_recurring')->default(false);
            $table->json('weekend_days')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['country_code', 'holiday_date']);
        });

        Role::all()->each(function (Role $role) {
            RolePermission::firstOrCreate(
                [
                    'role_id' => $role->id,
                    'module' => 'calendars',
                ],
                [
                    'can_read' => in_array($role->slug, ['administrator', 'manager'], true),
                    'can_write' => $role->slug === 'administrator',
                ]
            );
        });
    }

    public function down(): void
    {
        RolePermission::where('module', 'calendars')->delete();

        Schema::dropIfExists('calendars');
    }
};
