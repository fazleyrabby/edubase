<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fee_histories', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('fee_structure_id')->constrained()->cascadeOnDelete();
            $table->foreignId('institute_id')->constrained()->cascadeOnDelete();
            $table->foreignId('fee_type_id')->constrained()->restrictOnDelete();

            $table->decimal('previous_amount', 12, 2)->nullable();
            $table->decimal('new_amount', 12, 2);
            $table->decimal('percentage_change', 8, 2)->nullable();

            $table->date('effective_date');
            $table->string('academic_session', 50)->nullable();
            $table->text('change_reason')->nullable();

            $table->string('verification_status', 30)->default('estimated');
            $table->string('source_url', 1000)->nullable();
            $table->string('source_type', 50)->nullable();
            $table->unsignedBigInteger('scraper_run_id')->nullable();

            $table->foreignId('changed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamp('created_at')->useCurrent();

            $table->index('fee_structure_id');
            $table->index('institute_id');
            $table->index('effective_date');
            $table->index('scraper_run_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fee_histories');
    }
};
