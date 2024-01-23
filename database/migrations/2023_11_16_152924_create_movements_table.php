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
        Schema::create('movements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tool_id');
            $table->integer('mov_input')->default(0)->nullable();
            $table->integer('mov_exit')->default(0)->nullable();
            $table->integer('mov_total')->default(0)->nullable();
            $table->integer('val_total')->default(0)->nullable();
            //$table->boolean('mov_estado')->default(true);
            $table->foreign('tool_id')->references('id')->on('tools');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movements');
    }
};
