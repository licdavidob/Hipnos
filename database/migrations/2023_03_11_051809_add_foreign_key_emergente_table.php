<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //php artisan make:migration add_foreign_key_emergente_table --table=emergente
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('emergente', function (Blueprint $table) {
            $table->bigInteger('ID_Estacionamiento')->unsigned()->after('ID_Emergente');;
            $table->foreign('ID_Estacionamiento')->references('ID_Estacionamiento')->on('estacionamiento');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('emergente', function (Blueprint $table) {
            //
        });
    }
};
