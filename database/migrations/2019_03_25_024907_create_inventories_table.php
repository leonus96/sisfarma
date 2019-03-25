<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('stock');
            $table->float('precio_costo');
            $table->float('precio_publico');
            $table->unsignedBigInteger('medicament_id');
            $table->unsignedBigInteger('pharmacy_id');

            $table->foreign('medicament_id')->references('id')->on('medicaments');
            $table->foreign('pharmacy_id')->references('id')->on('pharmacies');
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
        Schema::table('inventories', function (Blueprint $table) {
            //
        });
    }
}
