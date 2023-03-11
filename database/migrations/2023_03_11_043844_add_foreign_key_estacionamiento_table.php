<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //php artisan make:migration add_foreign_key_estacionamiento_table --table=estacionamiento
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('estacionamiento', function (Blueprint $table) {
            $table->bigInteger('ID_Tipo_Estacionamiento')->unsigned()->after('Hash');;
            $table->foreign('ID_Tipo_Estacionamiento')->references('ID_Tipo_Estacionamiento')->on('tipo_estacionamiento');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('estacionamiento', function (Blueprint $table) {
            //
        });
    }
};
