<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //php artisan make:migration add_foreign_key_entrada_salida_table --table=entrada_salida
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('entrada_salida', function (Blueprint $table) {
            $table->bigInteger('ID_Usuario')->unsigned()->after('ID_Entrada_Salida');;
            $table->foreign('ID_Usuario')->references('ID_Usuario')->on('usuario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('entrada_salida', function (Blueprint $table) {
            //
        });
    }
};
