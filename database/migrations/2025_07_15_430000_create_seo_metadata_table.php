<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seo_metadata', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->string('seoable_type');
            $table->unsignedBigInteger('seoable_id')->nullable()->comment('nullable for route-based SEO');
            $table->string('route_name')->nullable()->comment('For static pages');
            $table->string('meta_title', 200)->nullable();
            $table->string('meta_description', 500)->nullable();
            $table->string('meta_keywords', 500)->nullable();
            $table->string('og_title', 200)->nullable();
            $table->string('og_description', 500)->nullable();
            $table->string('og_image', 1000)->nullable();
            $table->string('og_type', 50)->default('website');
            $table->string('twitter_card', 50)->default('summary_large_image');
            $table->string('canonical_url', 1000)->nullable();
            $table->boolean('noindex')->default(false);
            $table->boolean('nofollow')->default(false);
            $table->string('schema_type', 100)->default('EducationalOrganization');
            $table->timestamps();

            $table->index(['seoable_type', 'seoable_id']);
            $table->unique(['seoable_type', 'seoable_id']);
            $table->index('route_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seo_metadata');
    }
};
