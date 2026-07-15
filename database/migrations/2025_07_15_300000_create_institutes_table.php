<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('institutes', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();

            // Identity
            $table->string('name', 500);
            $table->string('short_name', 200)->nullable();
            $table->string('slug', 500)->unique();
            $table->string('institute_code', 100)->unique()->nullable()->comment('External/EIIN code');
            $table->unsignedSmallInteger('established_year')->nullable();
            $table->text('description')->nullable();
            $table->string('motto', 500)->nullable();

            // Classification
            $table->foreignId('institute_type_id')->constrained()->restrictOnDelete();
            $table->foreignId('primary_category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('religious_orientation', 50)->default('not_applicable');
            $table->string('methodology', 100)->nullable();
            $table->string('gender', 20)->default('co_education');

            // Location
            $table->foreignId('country_id')->constrained()->restrictOnDelete();
            $table->foreignId('division_id')->constrained()->restrictOnDelete();
            $table->foreignId('district_id')->constrained()->restrictOnDelete();
            $table->foreignId('upazila_id')->constrained()->restrictOnDelete();
            $table->foreignId('area_id')->constrained()->restrictOnDelete();
            $table->string('full_address', 1000)->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('google_maps_url', 1000)->nullable();
            $table->string('nearby_landmark', 500)->nullable();

            // Status & Publication
            $table->string('status', 20)->default('draft')->comment('draft, pending_review, verified, published, archived');
            $table->timestamp('published_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();

            // Verification
            $table->string('verification_status', 30)->default('estimated');
            $table->string('source_url', 1000)->nullable();
            $table->string('source_type', 50)->nullable();

            // SEO
            $table->string('meta_title', 200)->nullable();
            $table->string('meta_description', 500)->nullable();
            $table->string('meta_keywords', 500)->nullable();

            // Counters & Denormalized
            $table->unsignedBigInteger('view_count')->default(0);
            $table->unsignedBigInteger('comparison_count')->default(0);
            $table->unsignedInteger('fee_record_count')->default(0);
            $table->decimal('estimated_monthly_fee', 12, 2)->default(0.00);
            $table->string('logo_url', 1000)->nullable();
            $table->unsignedTinyInteger('profile_completeness')->default(0);

            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('slug');
            $table->index('status');
            $table->index('institute_type_id');
            $table->index('primary_category_id');
            $table->index('country_id');
            $table->index('division_id');
            $table->index('district_id');
            $table->index('upazila_id');
            $table->index('area_id');
            $table->index('gender');
            $table->index('religious_orientation');
            $table->index('methodology');
            $table->index('published_at');
            $table->index('verification_status');
            $table->index('estimated_monthly_fee');
            $table->index(['status', 'institute_type_id', 'primary_category_id', 'district_id'], 'idx_search');
            $table->index(['latitude', 'longitude'], 'idx_coords');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('institutes');
    }
};
