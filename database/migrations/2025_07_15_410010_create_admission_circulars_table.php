<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admission_circulars', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('institute_id')->constrained()->cascadeOnDelete();
            $table->foreignId('admission_session_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title', 500)->nullable();

            $table->string('admission_status', 20)->default('closed')->comment('upcoming, open, closing_soon, closed, waitlist');

            $table->date('application_start_date')->nullable();
            $table->date('application_end_date')->nullable();
            $table->boolean('admission_test_required')->default(false);
            $table->date('admission_test_date')->nullable();
            $table->boolean('interview_required')->default(false);
            $table->boolean('online_application_available')->default(false);
            $table->string('application_url', 1000)->nullable();

            $table->text('documents_required')->nullable();
            $table->text('eligibility_criteria')->nullable();
            $table->string('contact_info', 1000)->nullable();

            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();

            $table->string('source_url', 1000)->nullable();
            $table->unsignedBigInteger('scraper_run_id')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('institute_id');
            $table->index('admission_status');
            $table->index(['application_start_date', 'application_end_date'], 'idx_dates');
            $table->index('is_published');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admission_circulars');
    }
};
