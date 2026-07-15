<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('institute_social_links', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('institute_id')->constrained()->cascadeOnDelete();
            $table->string('platform', 50)->comment('facebook, youtube, instagram, linkedin, twitter, whatsapp, telegram, other');
            $table->string('url', 1000);
            $table->string('label', 200)->nullable();
            $table->boolean('is_public')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index('institute_id');
            $table->index('platform');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('institute_social_links');
    }
};
