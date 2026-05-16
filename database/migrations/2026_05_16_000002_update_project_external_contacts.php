<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('primary_contact_name')
                ->nullable()
                ->after('company_name');
            $table->string('primary_contact_email')
                ->nullable()
                ->after('primary_contact_name');
            $table->string('primary_contact_phone')
                ->nullable()
                ->after('primary_contact_email');
            $table->string('approval_manager_name')
                ->nullable()
                ->after('primary_contact_phone');
            $table->string('approval_manager_email')
                ->nullable()
                ->after('approval_manager_name');
            $table->string('approval_manager_phone')
                ->nullable()
                ->after('approval_manager_email');
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->dropConstrainedForeignId('primary_contact_id');
            $table->dropConstrainedForeignId('approval_manager_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->foreignId('primary_contact_id')
                ->nullable()
                ->after('company_name')
                ->constrained('users')
                ->nullOnDelete();
            $table->foreignId('approval_manager_id')
                ->nullable()
                ->after('primary_contact_id')
                ->constrained('users')
                ->nullOnDelete();
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'primary_contact_name',
                'primary_contact_email',
                'primary_contact_phone',
                'approval_manager_name',
                'approval_manager_email',
                'approval_manager_phone',
            ]);
        });
    }
};
