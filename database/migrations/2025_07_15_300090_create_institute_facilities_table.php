<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('institute_facilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institute_id')->constrained()->cascadeOnDelete();
            $table->foreignId('facility_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_available')->default(true);
            $table->text('description')->nullable();
            $table->timestamps();

            $table->unique(['institute_id', 'facility_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('institute_facilities');
    }
};
