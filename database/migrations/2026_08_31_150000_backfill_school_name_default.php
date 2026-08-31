<?php

use App\Models\SchoolSetting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Backfill existing null/empty rows so raw DB also has a sensible default
        // (display fallback is already handled by SchoolSetting::DEFAULT_SCHOOL_NAME accessor).
        if (! Schema::hasTable('school_settings') || ! Schema::hasColumn('school_settings', 'school_name')) {
            return;
        }

        SchoolSetting::whereNull('school_name')
            ->orWhere('school_name', '')
            ->update(['school_name' => SchoolSetting::DEFAULT_SCHOOL_NAME]);
    }

    public function down(): void
    {
        // No rollback needed — we don't want to null out intentionally set names.
    }
};
