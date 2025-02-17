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
        Schema::create('plantillas_documentos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->string('codtipodocumento');
            $table->longText(column: 'plantilla_html');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantillas_documentos');
    }
};
