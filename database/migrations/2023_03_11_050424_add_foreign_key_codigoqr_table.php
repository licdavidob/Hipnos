<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //php artisan make:migration add_foreign_key_codigoqr_table --table=codigoqr
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('codigoqr', function (Blueprint $table) {
            $table->bigInteger('ID_Usuario')->unsigned()->after('ID_CodigoQR');;
            $table->foreign('ID_Usuario')->references('ID_Usuario')->on('usuario');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('codigoqr', function (Blueprint $table) {
            //
        });
    }
};
