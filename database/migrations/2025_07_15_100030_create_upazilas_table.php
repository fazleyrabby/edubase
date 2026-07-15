<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('upazilas', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('district_id')->constrained()->restrictOnDelete();
            $table->string('name');
            $table->string('slug');
            $table->string('bn_name')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['district_id', 'slug']);
            $table->index('district_id');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('upazilas');
    }
};
