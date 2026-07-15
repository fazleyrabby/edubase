<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fee_structures', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('institute_id')->constrained()->cascadeOnDelete();
            $table->foreignId('fee_type_id')->constrained()->restrictOnDelete();
            $table->string('academic_session', 50);

            // Amount
            $table->decimal('amount', 12, 2);
            $table->string('currency', 3)->default('BDT');
            $table->string('frequency', 20)->default('one_time')->comment('one_time, monthly, quarterly, half_yearly, yearly, per_unit');
            $table->string('unit_label', 100)->nullable();
            $table->boolean('is_negotiable')->default(false);

            // Applicability
            $table->string('grade_range_start', 50)->default('all');
            $table->string('grade_range_end', 50)->default('all');

            // Verification & Moderation
            $table->string('verification_status', 30)->default('estimated');
            $table->string('moderation_status', 30)->default('pending_review')->comment('pending_review, approved, rejected, needs_revision');
            $table->decimal('confidence_score', 3, 2)->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('verified_at')->nullable();
            $table->string('source_url', 1000)->nullable();
            $table->string('source_type', 50)->nullable();
            $table->text('source_notes')->nullable();

            // Publication
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();

            // Scraper
            $table->unsignedBigInteger('scraper_run_id')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('institute_id');
            $table->index('fee_type_id');
            $table->index('academic_session');
            $table->index('verification_status');
            $table->index('moderation_status');
            $table->index(['grade_range_start', 'grade_range_end'], 'idx_level');
            $table->index('scraper_run_id');
            $table->index('is_published');
            $table->unique(['institute_id', 'fee_type_id', 'academic_session', 'grade_range_start', 'moderation_status'], 'uq_fee_uniqueness');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fee_structures');
    }
};
