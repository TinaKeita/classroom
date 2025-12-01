<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // ja nav unique email, vari pievienot ->unique()
            // $table->string('email')->unique()->change();

            $table->string('role')
                ->default('student')
                ->after('password'); // admin / teacher / student

            $table->string('avatar')
                ->nullable()
                ->after('role');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'avatar']);
        });
    }
};

