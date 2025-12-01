<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();                                // id
            $table->foreignId('classroom_id')            // classroom_id
                  ->constrained('classrooms')
                  ->onDelete('cascade');
            $table->string('title');                     // title
            $table->text('description');                 // description
            $table->string('file_path')->nullable();     // file_path (nullable)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};

