<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Serveurs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serveurs', function (Blueprint $table) {

            $table->increments('id');
            $table->string ('NomServeur');
            $table->string ('Type');
            $table->string ('Version');
            $table->integer ('Platformes_id');
            $table->integer ('Type_id');
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
        //
    }
}
