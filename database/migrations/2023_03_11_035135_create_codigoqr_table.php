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
        Schema::create('codigoqr', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id('ID_CodigoQR');
            $table->char('Nombre', 50);
            $table->char('Tipo', 10);
            $table->char('Ruta_Local', 100);
            $table->string('Ruta_Publica', 255);
            $table->timestamps();
            $table->tinyInteger('Estatus')->default(1)->comment('1 = Activo / 0 = Inactivo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('codigoqr');
    }
};
