<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('institute_media', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('institute_id')->constrained()->cascadeOnDelete();
            $table->string('media_type', 20)->comment('logo, cover, gallery, document, circular');
            $table->string('file_path', 1000);
            $table->string('file_name', 500)->nullable();
            $table->unsignedInteger('file_size')->nullable();
            $table->string('mime_type', 100)->nullable();
            $table->string('disk', 50)->default('public');
            $table->string('title', 500)->nullable();
            $table->string('alt_text', 500)->nullable();
            $table->text('caption')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();

            $table->index(['institute_id', 'media_type']);
            $table->index('is_featured');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('institute_media');
    }
};
