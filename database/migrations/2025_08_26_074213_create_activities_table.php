<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('activity_name');
            $table->json('activity_image')->nullable(); // multiple images stored as JSON
            $table->longText('activity_details')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->integer('position')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('activities');
    }
};
