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
        Schema::create('usuario', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id('ID_Usuario');
            $table->char('Nombre',50);
            $table->char('Ap_Paterno',50);
            $table->char('Ap_Materno',50)->nullable();
            $table->char('Telefono',15)->unique()->nullable();
            $table->string('Email',50)->unique()->nullable();
            $table->tinyInteger('Estatus')->default(1)->comment('1 = Activo / 0 = Inactivo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
