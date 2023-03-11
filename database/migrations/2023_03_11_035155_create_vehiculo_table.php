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
        Schema::create('vehiculo', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id('ID_Vehiculo');
            $table->char('Placa',50);
            $table->char('Color',20)->nullable();
            $table->string('NIV',25)->nullable();
            $table->tinyInteger('Estatus')->default(1)->comment('1 = Activo / 0 = Inactivo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculo');
    }
};
