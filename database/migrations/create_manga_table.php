<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('manga', function (Blueprint $table) {
            $table->uuid('manga_id');
            $table->string('title');
            $table->string('link');
            $table->boolean('comments');
            $table->date('publish_date');
            $table->date('last_sync');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
