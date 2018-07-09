<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Problems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('problems', function (Blueprint $table) {

            $table->increments('id');
            $table->string ('Code_prb');
            $table->text ('MessagePrb');
            $table->integer ('Serveurs_id');
            $table->integer ('Platformes_id');
            $table->string ('AttachementProb')->nullable();
            $table->timestamps();
        } ) ; }

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
