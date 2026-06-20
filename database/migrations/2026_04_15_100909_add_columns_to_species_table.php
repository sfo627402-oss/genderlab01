<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('species', function (Blueprint $table) {
            $table->string('primer_set')->nullable(); // Jeu d'amorces
            $table->boolean('is_local')->default(false); // Espèce locale ou pas
        });
    }

    public function down(): void
    {
        Schema::table('species', function (Blueprint $table) {
            $table->dropColumn(['primer_set', 'is_local']);
        });
    }
};
