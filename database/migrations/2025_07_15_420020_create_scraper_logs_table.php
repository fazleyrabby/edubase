<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scraper_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scraper_run_id')->constrained()->cascadeOnDelete();
            $table->string('log_level', 20)->default('info')->comment('debug, info, warning, error, critical');
            $table->text('message');
            $table->json('context')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->index('scraper_run_id');
            $table->index('log_level');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scraper_logs');
    }
};
