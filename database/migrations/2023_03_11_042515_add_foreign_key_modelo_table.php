<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //php artisan make:migration add_foreign_key_modelo_table --table=modelo
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('modelo', function (Blueprint $table) {
            $table->bigInteger('ID_Marca')->unsigned()->after('Modelo');;
            $table->foreign('ID_Marca')->references('ID_Marca')->on('marca');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('modelo', function (Blueprint $table) {
            //
        });
    }
};
