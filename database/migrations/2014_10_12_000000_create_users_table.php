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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            
            $table->string('email')->unique();
            $table->string('password', 64);
            $table->string('name');
            $table->string('lastname', 64);
            $table->date('birthdate');

            // se bisogna aggiungere dei campi per la registrazione degli utenti, andare in http\controllers\auth per aggiungerli anche li e fare validazioni altrimenti il frontend non comunicherà con il backend.
            // i campi di default sono email/nome/password
            
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
            $table->rememberToken();
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