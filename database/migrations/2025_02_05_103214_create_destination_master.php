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
        Schema::create('destination_master', function (Blueprint $table) {
            $table->id();
            $table->string("destination_name",255)->nullable(false)->index("index_destination");
            $table->text("destination_details")->nullable(true);
            $table->text("destination_image")->nullable(false);
            $table->string('destination_slug', 255)->nullable(false);
            $table->integer("position")->nullable(true)->index("index_position");
            $table->tinyInteger("status")->nullable(false)->default("1");
            $table->bigInteger("created_by")->nullable(true);
            $table->bigInteger("updated_by")->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destination_master');
    }
};
