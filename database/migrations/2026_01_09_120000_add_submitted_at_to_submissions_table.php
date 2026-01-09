<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->timestamp('submitted_at')->nullable()->after('file_path');
        });

        // Backfill submitted_at for existing submissions that already have a file
        DB::table('submissions')
            ->whereNotNull('file_path')
            ->whereNull('submitted_at')
            ->update(['submitted_at' => DB::raw('created_at')]);
    }

    public function down(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->dropColumn('submitted_at');
        });
    }
};
