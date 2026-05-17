<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('time_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('project_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->date('entry_date');
            $table->decimal('hours', 5, 2);
            $table->text('description')->nullable();
            $table->enum('status', ['draft', 'submitted', 'approved', 'declined'])
                ->default('draft');
            $table->boolean('is_weekend')
                ->default(false);
            $table->boolean('is_holiday')
                ->default(false);
            $table->foreignId('calendar_id')
                ->nullable()
                ->constrained('calendars')
                ->nullOnDelete();
            $table->timestamp('submitted_at')
                ->nullable();
            $table->foreignId('reviewed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamp('reviewed_at')
                ->nullable();
            $table->text('review_note')
                ->nullable();
            $table->timestamps();

            $table->index(['user_id', 'entry_date']);
            $table->index(['project_id', 'entry_date']);
            $table->index(['status', 'entry_date']);
            $table->index('reviewed_by');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('time_entries');
    }
};
