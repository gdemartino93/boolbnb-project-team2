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
        Schema::table('apartments', function (Blueprint $table) {

            $table->foreignId('user_id')
                ->constrained();
        });

        Schema::table('messages', function(Blueprint $table) {

            $table -> foreignId('apartment_id')
                   -> constrained();
        });

        Schema::table('additional_service_apartment', function (Blueprint $table) {

            $table->foreignId('additional_service_id')
                ->constrained();
            
            $table->foreignId('apartment_id')
                ->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apartments', function (Blueprint $table) {

            $table->dropForeign('apartments_user_id_foreign');
            $table->dropColumn('user_id');
        });

        Schema::table('messages', function (Blueprint $table) {

            $table->dropForeign('messages_apartment_id_foreign');
            $table->dropColumn('apartment_id');

        });

        Schema::table('additional_service_apartment', function(Blueprint $table) {

            $table -> dropForeign('additional_service_apartment_additional_service_id_foreign');
            $table -> dropForeign('additional_service_apartment_apartment_id_foreign');
        });
    }
};