<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();                                // id
            $table->foreignId('assignment_id')           // assignment_id
                  ->constrained('assignments')
                  ->onDelete('cascade');
            $table->foreignId('student_id')              // student_id
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->string('file_path');                 // file_path
            $table->text('comment')->nullable();         // comment
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};

