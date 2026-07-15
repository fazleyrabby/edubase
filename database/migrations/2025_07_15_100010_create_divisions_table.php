<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('divisions', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('country_id')->constrained()->restrictOnDelete();
            $table->string('name');
            $table->string('slug');
            $table->string('bn_name')->nullable()->comment('Bangla name');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['country_id', 'slug']);
            $table->index('country_id');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('divisions');
    }
};
