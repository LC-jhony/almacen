<?php

use App\Enums\Template;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Font;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->boolean('show_logo')->default(false);
            $table->string('logo')->nullable();
            $table->string('header')->nullable();
            $table->string('subheader')->nullable();
            $table->text('terms')->nullable();
            $table->text('footer')->nullable();
            $table->string('accent_color')->default('#4F46E5');
            $table->string('font')->default(Font::DEFAULT);
            $table->string('template')->default(Template::DEFAULT);
            $table->unsignedBigInteger('loan_id');
            $table->unsignedBigInteger('asiggment_id');
            $table->enum('type', ['Prestamo', 'Valorizacion', 'Diario']);
            $table->string('path');
            $table->foreign('loan_id')->references('id')->on('loans')->onDelete('cascade');
            $table->foreign('asiggment_id')->references('id')->on('asiggments')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
