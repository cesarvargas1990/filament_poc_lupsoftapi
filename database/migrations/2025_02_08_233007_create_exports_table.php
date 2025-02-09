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
        {
            Schema::create('exports', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete(); // Usuario que realizó la exportación
                $table->string('exporter'); // Clase del exportador utilizado
                $table->string('file_name')->nullable(); 
                $table->integer('total_rows')->default(0); // Cantidad de registros exportados
                $table->string('file_disk')->default('local'); // Disco donde se almacena el archivo exportado
                $table->string('file_path')->nullable(); // Ruta del archivo exportado
                $table->string(column: 'processed_rows')->nullable(); 
                $table->string(column: 'successful_rows')->nullable(); 
                $table->timestamp(column: 'completed_at')->nullable(); 
                $table->timestamps(); // created_at y updated_at
            });
        }
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exports');
    }
};
