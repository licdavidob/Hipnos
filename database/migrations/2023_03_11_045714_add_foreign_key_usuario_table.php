<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    //php artisan make:migration add_foreign_key_usuario_table --table=usuario
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('usuario', function (Blueprint $table) {
            $table->bigInteger('ID_Tipo_Usuario')->unsigned()->after('Ap_Materno');;
            $table->foreign('ID_Tipo_Usuario')->references('ID_Tipo_Usuario')->on('tipo_usuario');

            $table->bigInteger('ID_Permiso')->unsigned()->after('ID_Tipo_Usuario');;
            $table->foreign('ID_Permiso')->references('ID_Permiso')->on('permiso');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuario', function (Blueprint $table) {
            //
        });
    }
};
