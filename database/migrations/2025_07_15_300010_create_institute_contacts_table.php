<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('institute_contacts', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('institute_id')->constrained()->cascadeOnDelete();
            $table->string('contact_type', 20)->comment('phone, email, website, fax, other');
            $table->string('contact_value', 500);
            $table->string('label', 200)->nullable();
            $table->boolean('is_primary')->default(false);
            $table->boolean('is_public')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index('institute_id');
            $table->index('contact_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('institute_contacts');
    }
};
