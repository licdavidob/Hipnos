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
        Schema::create('entrada_salida', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id('ID_Entrada_Salida');
            $table->date('Fecha_Ingreso');
            $table->date('Fecha_Egreso');
            $table->tinyInteger('Estatus')->default(1)->comment('1 = Activo / 0 = Inactivo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrada_salida');
    }
};
