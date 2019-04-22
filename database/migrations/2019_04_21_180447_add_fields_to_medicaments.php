<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToMedicaments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medicaments', function (Blueprint $table) {
            $table->dropColumn('descripcion');
            $table->dropColumn('unidad');
            $table->string('nombre');
            $table->unsignedBigInteger('cod_minsa')->unique()->nullable();
            $table->string('concentracion')->nullable();
            $table->string('forma_farmaceutica')->nullable();
            $table->string('forma_farmaceutica_simp')->nullable();
            $table->string('presentacion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medicaments', function (Blueprint $table) {
            $table->text('descripcion')->nullable();
            $table->string('unidad')->nullable();
            $table->dropColumn('unidad');
            $table->dropColumn('nombre');
            $table->dropColumn('cod_minsa');
            $table->dropColumn('concentracion');
            $table->dropColumn('forma_farmaceutica');
            $table->dropColumn('forma_farmaceutica_simp');
            $table->dropColumn('presentacion');
        });
    }
}
