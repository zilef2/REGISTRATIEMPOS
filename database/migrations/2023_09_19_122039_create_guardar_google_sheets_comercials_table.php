<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateGuardarGoogleSheetsComercialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guardar_google_sheets_comercials', function (Blueprint $table) {
            $table->id();
			$table->string('Grupo')->default('No se especifico');
			$table->integer('HayTiemposEstimados')->default(0);

            $table->string('Nombre_tablero')->nullable();
            $table->string('Item')->nullable();
            $table->string('avance')->nullable();
            $table->string('Tiempo_estimado_Ing_mec')->nullable();
            $table->string('Tiempo_estimado_Ing_elec')->nullable();
            $table->string('Tiempo_estimado_corte')->nullable();
            $table->string('Tiempo_estimado_doblez')->nullable();
            $table->string('Tiempo_estimado_soldadura')->nullable();
            $table->string('Tiempo_estimado_pulida')->nullable();
            $table->string('Tiempo_estimado_ensamble')->nullable();
            $table->string('Tiempo_estimado_cableado')->nullable();
            $table->string('Tiempo_estimado_cobre')->nullable();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null'); //restrict | set null

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guardar_google_sheets_comercials');
    }
}
