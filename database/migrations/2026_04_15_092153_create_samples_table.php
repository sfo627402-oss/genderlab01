<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('samples', function (Blueprint $table) {
            $table->id();
            $table->string('qr_code')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Client
            $table->foreignId('species_id')->constrained()->onDelete('cascade');
            $table->string('sample_type'); // feather, blood
            $table->integer('quantity')->default(1);
            $table->string('status')->default('Pending'); // Pending, Received, Processing, Completed
            $table->boolean('is_paid')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('samples');
    }
};
