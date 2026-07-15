<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scraper_runs', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('scraper_source_id')->constrained()->cascadeOnDelete();
            $table->string('status', 20)->default('pending')->comment('pending, running, completed, failed, partial');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();
            $table->unsignedInteger('items_processed')->default(0);
            $table->unsignedInteger('items_changed')->default(0);
            $table->unsignedInteger('items_failed')->default(0);
            $table->text('error_message')->nullable();
            $table->longText('raw_payload')->nullable()->comment('Stored raw response for debugging');
            $table->timestamps();

            $table->index('scraper_source_id');
            $table->index('status');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scraper_runs');
    }
};
