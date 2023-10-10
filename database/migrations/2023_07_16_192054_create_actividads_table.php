<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateActividadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividads', function (Blueprint $table) {
            $table->id();
			$table->string('nombre');
			$table->string('codigo')->nullable();

            // $table->unsignedBigInteger('centrotrabajo_id');
            // $table->foreign('centrotrabajo_id')
            //     ->references('id')
            //     ->on('centrotrabajos')
            //     ->onDelete('restrict'); //cascade| restrict | set null
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
        Schema::dropIfExists('actividads');
    }
}
