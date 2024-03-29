<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('description')->nullable();
            $table->tinyInteger('room_number')->unsigned();
            $table->tinyInteger('bed_number')->unsigned();
            $table->tinyInteger('bath_number')->unsigned();
            $table->smallInteger('square_meters')->unsigned();
            $table->string('address', 81);
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('img') ->nullable();
            $table->boolean('visible')->default(true);
            $table ->smallInteger('views_count') -> default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }
};