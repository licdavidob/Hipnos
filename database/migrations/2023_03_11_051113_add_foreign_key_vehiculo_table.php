<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //php artisan make:migration add_foreign_key_vehiculo_table --table=vehiculo
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('vehiculo', function (Blueprint $table) {
            $table->bigInteger('ID_Usuario')->unsigned()->after('ID_Vehiculo');;
            $table->foreign('ID_Usuario')->references('ID_Usuario')->on('usuario');

            $table->bigInteger('ID_Modelo')->unsigned()->after('ID_Usuario');;
            $table->foreign('ID_Modelo')->references('ID_Modelo')->on('modelo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehiculo', function (Blueprint $table) {
            //
        });
    }
};
