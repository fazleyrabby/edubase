<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comparison_cache', function (Blueprint $table) {
            $table->id();
            $table->char('cache_hash', 64)->unique();
            $table->json('institute_ids');
            $table->json('comparison_data');
            $table->unsignedInteger('hit_count')->default(0);
            $table->timestamp('expires_at');
            $table->timestamps();

            $table->index('expires_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comparison_cache');
    }
};
