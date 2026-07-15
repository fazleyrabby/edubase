<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('institute_shifts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained()->cascadeOnDelete();
            $table->string('shift_name', 20)->comment('morning, day, evening, single');
            $table->time('time_start')->nullable();
            $table->time('time_end')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['institute_id', 'shift_name']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('institute_shifts');
    }
};
