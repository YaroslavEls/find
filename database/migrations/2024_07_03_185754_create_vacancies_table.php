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
        Schema::create('vacancies', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('saloon_id')->constrained()->cascadeOnDelete();
            $table->foreignUlid('location_id')->constrained()->cascadeOnDelete();
            $table->string('job');
            $table->string('employment');
            $table->float('experience');
            $table->float('salary');
            $table->text('descr');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
