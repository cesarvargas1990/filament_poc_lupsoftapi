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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            // Datos personales
            $table->string('nombre');
            $table->string('numero_documento')->unique();
            $table->integer('tipo_documento_id');
            $table->string('email')->nullable();
            $table->string('cobrador')->nullable();
            $table->date('fecha_expedicion')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('tipo_documento')->nullable();
            $table->integer('empresa_id')->nullable();
            

            // Datos de contacto
            $table->string('ciudad')->nullable();
            $table->string('telefono')->nullable();
            $table->string('celular')->nullable();
            $table->string('dir_casa')->nullable();
            $table->string('dir_trabajo')->nullable();

            // Referencias
            $table->string('referencia_1')->nullable();
            $table->string('referencia_2')->nullable();

            // Firma cliente
            $table->text('firma_cliente')->nullable();

            // Archivos
            $table->string('cedula')->nullable();
            $table->string('foto')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
