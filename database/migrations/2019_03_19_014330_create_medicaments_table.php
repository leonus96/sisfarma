<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicaments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('laboratory_id')->nullable();
            $table->unsignedBigInteger('active_principle_id')->nullable();
            $table->unsignedBigInteger('pharmacy_id');
            $table->float('cost_price');
            $table->float('public_price');
            $table->integer('stock');

            $table->foreign('pharmacy_id')->references('id')->on('laboratories');
            $table->foreign('laboratory_id')->references('id')->on('active_principles');
            $table->foreign('active_principle_id')->references('id')->on('pharmacies');
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
        Schema::dropIfExists('medicaments');
    }
}
