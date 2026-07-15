<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scraper_sources', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('institute_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name', 500);
            $table->string('source_type', 20)->comment('website, pdf, rss, api, manual');
            $table->string('adapter_class', 500)->comment('FQCN of adapter');
            $table->string('base_url', 1000)->nullable();
            $table->json('config')->nullable()->comment('Adapter-specific configuration');
            $table->string('trust_level', 20)->default('review_required')->comment('trusted, review_required, untrusted');
            $table->string('schedule_frequency', 20)->default('weekly')->comment('hourly, daily, weekly, monthly, manual');
            $table->timestamp('last_successful_run_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('institute_id');
            $table->index('is_active');
            $table->index(['schedule_frequency', 'last_successful_run_at'], 'idx_schedule');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scraper_sources');
    }
};
