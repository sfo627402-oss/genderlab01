<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sample_id')->constrained()->onDelete('cascade');
            $table->foreignId('biologist_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('sex_result')->nullable(); // Male, Female, Inconclusive
            $table->integer('confidence_score')->nullable(); // 0-100
            $table->string('quality_check')->nullable(); // Good, Bad
            $table->text('comment')->nullable();
            $table->string('gel_image_path')->nullable();
            $table->string('pdf_report_path')->nullable();
            $table->string('status')->default('draft'); // draft, validated
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
